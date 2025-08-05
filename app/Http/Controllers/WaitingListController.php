<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WaitingList;
use App\Http\Requests\WaitingListRequest;

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
}
