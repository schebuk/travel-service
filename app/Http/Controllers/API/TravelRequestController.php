<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequestRequest;
use App\Models\TravelRequest;
use App\Notifications\TravelStatusUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TravelRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = TravelRequest::where('user_id', Auth::id());

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->destination) {
            $query->where('destination', 'like', '%' . $request->destination . '%');
        }

        if ($request->filled(['start_date', 'end_date'])) {
            $query->whereBetween('departure_date', [$request->start_date, $request->end_date]);
        }

        return response()->json($query->get());
    }

    public function store(TravelRequestRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $travelRequest = TravelRequest::create($data);

        return response()->json($travelRequest, 201);
    }

    public function show($id)
    {
        $request = TravelRequest::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($request);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:aprovado,cancelado']);

        $travelRequest = TravelRequest::findOrFail($id);

        if ($travelRequest->user_id === Auth::id()) {
            return response()->json(['error' => 'Usuário não pode alterar o próprio status'], 403);
        }

        if ($travelRequest->status === 'aprovado' && $request->status === 'cancelado') {
        }

        $travelRequest->status = $request->status;
        $travelRequest->save();

        $travelRequest->user->notify(new TravelStatusUpdated($travelRequest));

        return response()->json($travelRequest);
    }
}
