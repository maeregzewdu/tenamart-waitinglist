<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\WaitingList;
use App\Models\User;
use Illuminate\Validation\Rule;
use TCPDF;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('dashboard');
    }

    public function general(Request $request)
    {
        $totalWaitingList = WaitingList::count();
        $totalAdmin = User::count();
        $topSource = DB::table('waiting_lists')
        ->select('signup_source', DB::raw('COUNT(*) as count'))
        ->groupBy('signup_source')
        ->orderByDesc('count')
        ->first();
        $recentActivity = WaitingList::orderBy('created_at', 'desc')->limit(5)->get();

        Log::info("Reached general method");

        return response()->json([
            'total_waiting_list' => $totalWaitingList,
            'total_admin' => $totalAdmin,
            'top_source' => $topSource,
            'recent_activity' => $recentActivity,
        ]);
    }

    public function index()
    {
        $waitingList = WaitingList::orderBy('created_at', 'desc')->paginate(10);
        $total = WaitingList::count();

        return response()->json([
            'waiting_list' => $waitingList,
            'total' => $total
        ]);
    }

    public function update(Request $request, WaitingList $waitingList)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('waiting_lists', 'email')->ignore($waitingList->id),
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('waiting_lists', 'phone')->ignore($waitingList->id),
            ],
            'signup_source' => 'nullable|string'
        ]);

        $waitingList->update($validated);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Waiting list entry updated successfully', 'data' => $waitingList]);
        }
    
        return redirect()->back()->with('success', 'Waiting list entry updated successfully');

    }

    public function destroy(Request $request, WaitingList $waitingList)
    {
        $waitingList->delete();
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Entry deleted successfully']);
        }

        return redirect()->back()->with('success', 'Entry deleted successfully');
    }

    public function stats(Request $request)
    {
        $timeRange = $request->query('time_range');
        $signupSource = $request->query('signup_source');

        if ($timeRange) {
            switch ($timeRange) {
                case 'today':
                    $startDate = now()->startOfDay();
                    $endDate = now()->endOfDay();
                    break;
                case 'last_3_days':
                    $startDate = now()->subDays(3)->startOfDay();
                    $endDate = now()->endOfDay();
                    break;
                case 'last_7_days':
                    $startDate = now()->subDays(7)->startOfDay(); // ✅ Fixed bug here
                    $endDate = now()->endOfDay();
                    break;
                case 'last_30_days':
                    $startDate = now()->subDays(30)->startOfDay();
                    $endDate = now()->endOfDay();
                    break;
                case 'all':
                    $firstRecord = WaitingList::min('created_at');
                    $startDate = $firstRecord ? Carbon::parse($firstRecord)->startOfDay() : now()->startOfDay();
                    $endDate = now()->endOfDay();
                    break;
                default:
                    $firstRecord = WaitingList::min('created_at');
                    $startDate = $firstRecord ? Carbon::parse($firstRecord)->startOfDay() : now()->startOfDay();
                    $endDate = now()->endOfDay();
                    break;
            }
        } else {
            $startDate = $request->query('start_date')
                ? Carbon::parse($request->query('start_date'))->startOfDay()
                : WaitingList::min('created_at') ?? now()->startOfDay();

            $endDate = $request->query('end_date')
                ? Carbon::parse($request->query('end_date'))->endOfDay()
                : now()->endOfDay();
        }

        $baseQuery = WaitingList::whereBetween('created_at', [$startDate, $endDate]);

        if ($signupSource) {
            $baseQuery->where('signup_source', $signupSource);
        }

        $todayStart = now()->startOfDay();
        $weekStart = now()->startOfWeek();
        $weekEnd = now()->endOfWeek();

        $total = (clone $baseQuery)->count();
        $today = (clone $baseQuery)->whereDate('created_at', $todayStart)->count();
        $thisWeek = (clone $baseQuery)->whereBetween('created_at', [$weekStart, $weekEnd])->count();

        $trend = (clone $baseQuery)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $topSources = (clone $baseQuery)
            ->select('signup_source', DB::raw('COUNT(*) as total'))
            ->groupBy('signup_source')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $topSource = $topSources->first();

        return response()->json([
            'filters' => [
                'time_range' => $timeRange ?? 'custom',
                'start_date' => Carbon::parse($startDate)->toDateString(),
                'end_date' => Carbon::parse($endDate)->toDateString(),
                'signup_source' => $signupSource ?? 'all',
            ],
            'stats' => [
                'total' => $total,
                'today' => $today,
                'this_week' => $thisWeek,
                'top_source' => $topSource,
            ],
            'trend' => $trend,
            'top_sources' => $topSources,
        ]);
    }

    public function exportStatsPdf(Request $request)
    {
        $stats = $this->stats($request)->getData(true); 
    
        $pdf = new TCPDF;
        $pdf->SetTitle('Statistics Report');
        $pdf->AddPage();
        $html = view('stats_pdf', compact('stats'))->render();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('statistics.pdf');
    }
}
