<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WaitingList;
use App\Http\Requests\WaitingListRequest;
use App\Exports\WaitingListExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;

class WaitingListController extends Controller
{
    public function store(WaitingListRequest $request)
    {
        $validated = $request->validated();

        $exists = WaitingList::where('email', $validated['email'])
                ->orWhere('phone', $validated['phone'])
                ->exists();

        if ($exists) {
            $message = 'You are already on the waiting list!';
    
            if ($request->wantsJson()) {
                return response()->json(['message' => $message], 409); // 409 Conflict
            }
    
            return redirect()->back()->with('success', $message);
        }

        WaitingList::create($validated);

        $message = 'You are now on the waiting list!';

        if ($request->wantsJson()) {
            return response()->json(['message' => $message], 201);
        }

        return redirect()->back()->with('success', $message);
    }

    public function show(WaitingList $waitingList)
    {
        return response()->json($waitingList);
    }

    public function update(WaitingList $waitingList, Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'nullable',
                'email',
                Rule::unique('waiting_lists', 'email')->ignore($waitingList->id),
            ],
            'phone' => [
                'required',
                'string',
                Rule::unique('waiting_lists', 'phone')->ignore($waitingList->id),
            ],
            'signup_source' => ['nullable', 'string', 'max:255'],
        ]);

        $waitingList->update($validated);

        $message = 'Waiting list entry updated.';

        if($request->wantsJson()) {
            return response()->json([
                'message' => $message,
                'waiting_list' => $waitingList->fresh()
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function delete(WaitingList $waitingList, Request $request)
    {
        $waitingList->delete();

        $message = 'Waiting list deleted successfully!';

        if($request->wantsJson()) {
            return response()->json(['message' => $message]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function export()
    {
        return Excel::download(new WaitingListExport, 'waiting-list-' . now()->format('Y-m-d') . '.xlsx');
    }
}
