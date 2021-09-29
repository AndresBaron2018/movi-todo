<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\User;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = User::get();
        $vehicles = Vehicle::with('user')->get();
        return view('vehicle.index', compact('vehicles', 'users'));
    }

    public function store(Request $request)
    {
        $vehicle = new Vehicle($request->all());
        $vehicle->save();

        return response()->json([
            'vehicle' => $vehicle,
            'saved' => true
        ]);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $vehicle->update($request->all());

        return response()->json([
            'user' => $vehicle,
            'saved' => true
        ]);
    }

    public function destroy($id)
    {
        Vehicle::where('id', $id)->delete();
        return back()->with('status', 'It was successfully deleted');
    }
}
