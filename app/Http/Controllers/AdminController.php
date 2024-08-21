<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return response()->json($appointments);
    }

    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return response()->json($appointment);
    }

    public function update(AdminRequest $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());

        return response()->json(['message'=>'Görüş uğurla yeniləndi','appointment'=>$appointment]);
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return response()->json(['message'=>'Görüş uğurla silindi']);
    }
}
