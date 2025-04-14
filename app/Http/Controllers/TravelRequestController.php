<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TravelRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = TravelRequest::where('user_id', auth()->id());

        if ($status = request('status')) {
            $query->where('status', $status);
        }
        if ($dest = request('destination')) {
            $query->where('destination', 'like', "%$dest%");
        }
        if ($from = request('from')) {
            $query->where('departure_date', '>=', $from);
        }
        if ($to = request('to')) {
            $query->where('return_date', '<=', $to);
        }

        return response()->json($query->get());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'requester_name' => 'required|string',
            'destination' => 'required|string',
            'departure_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:departure_date',
        ]);

        $validated['user_id'] = auth()->id();

        $request = TravelRequest::create($validated);

        return response()->json($request, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, string $id)
    {
        $request->status = $validated['status'];
        $request->save();

        $request->user->notify(new TravelRequestStatusChanged($request));
    }
    

}
