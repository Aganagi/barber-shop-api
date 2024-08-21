<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Appointment::all();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        $appointment = Appointment::create([
            'name'=>$request->name,
            'date'=>$request->date,
            'time'=>$request->time
        ]);
        return response()->json($appointment, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
