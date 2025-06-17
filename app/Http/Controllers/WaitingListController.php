<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WaitingList;

class WaitingListController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        // Check if email already exists
        if (WaitingList::where('email', $validated['email'])
            ->orWhere('phone', $validated['phone'])
            ->exists()) {
            if($request->wantsJson()) {
                return response()->json(['message' => 'You are already on the waiting list!']);
            }
            return redirect()->back()->with('success', 'You are already on the waiting list!');
        }

        // Create new entry if email doesn't exist
        WaitingList::create($validated);

        if($request->wantsJson()) {
            return response()->json(['message' => 'You are now on the waiting list!']);
        }

        return redirect()->back()->with('success', 'You are now on the waiting list!');
    }
}
