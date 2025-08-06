<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\WaitingList;
use App\Exports\WaitingListExport;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function index()
    {
        $waitingList = WaitingList::orderBy('created_at', 'desc')->paginate(10);
        return response()->json($waitingList);
    }

    public function show(WaitingList $waitingList)
    {
        return response()->json($waitingList);
    }

    public function update(Request $request, WaitingList $waitingList)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('waiting_lists', 'email')->ignore($waitingListId),
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('waiting_lists', 'phone')->ignore($waitingListId),
            ],
            'signup_source' => 'nullable|string'
        ]);

        $waitingList->update($validated);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Waiting list entry updated successfully', 'data' => $waitingList]);
        }
    
        return redirect()->back()->with('success', 'Waiting list entry updated successfully');

    }

    public function destroy(WaitingList $waitingList)
    {
        $waitingList->softDelete();
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Entry deleted successfully']);
        }

        return redirect()->back()->with('success', 'Entry deleted successfully');
    }

    public function stats(Request $request)
    {
        $timeRange = $request->query('time_range');

        if ($timeRange) {
            switch ($timeRange) {
                case 'last_7_days':
                    $startDate = now()->subDays(7)->startOfDay();
                    $endDate = now()->endOfDay();
                    break;
                case 'last_30_days':
                    $startDate = now()->subDays(30)->startOfDay();
                    $endDate = now()->endOfDay();
                    break;
                case 'last_year':
                    $startDate = now()->subYear()->startOfDay();
                    $endDate = now()->endOfDay();
                    break;
                case 'ytd':
                    $startDate = now()->startOfYear();
                    $endDate = now()->endOfDay();
                    break;
                case 'all':
                    $startDate = WaitingList::min('created_at') ?? now();
                    $endDate = now()->endOfDay();
                    break;
                default:
                    $startDate = now()->subDays(30)->startOfDay();
                    $endDate = now()->endOfDay();
                    break;
            }
        } else {
            $startDate = $request->query('start_date')
                ? Carbon::parse($request->query('start_date'))->startOfDay()
                : now()->subDays(30)->startOfDay();

            $endDate = $request->query('end_date')
                ? Carbon::parse($request->query('end_date'))->endOfDay()
                : now()->endOfDay();
        }

        $signupSource = $request->query('signup_source');

        $baseQuery = WaitingList::whereBetween('created_at', [$startDate, $endDate]);

        if ($signupSource) {
            $baseQuery->where('signup_source', $signupSource);
        }

        $total = (clone $baseQuery)->count();
        $today = (clone $baseQuery)->whereDate('created_at', today())->count();
        $thisWeek = (clone $baseQuery)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

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

        $perPage = $request->query('per_page', 10);
        $waitingListData = $baseQuery
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->appends($request->query());

        return response()->json([
            'filters' => [
                'time_range' => $timeRange ?? 'custom',
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'signup_source' => $signupSource ?? 'all',
            ],
            'stats' => [
                'total' => $total,
                'today' => $today,
                'this_week' => $thisWeek,
            ],
            'trend' => $trend,
            'top_sources' => $topSources,
            'waiting_list' => $waitingListData,
        ]);
    }

}
