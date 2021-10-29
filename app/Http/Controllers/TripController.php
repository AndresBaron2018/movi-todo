<?php

namespace App\Http\Controllers;

use App\Trip;
use App\Vehicle;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TripController extends Controller
{
    public function index(Request $request)
    {
        $role = '';
        $users = User::where('id', '=', auth()->user()->id)->has('roles')->with('roles')->get();
        foreach ($users as $user) {
            foreach ($user->roles as $roles) {
                $role = $roles->name;
            }
        }

        if ($role == 'admin') {
            $trips = Trip::get();
            $vehicles = Vehicle::get();
            $persons = User::get();
            return view('driver.index', compact('trips', 'vehicles', 'persons'));
        } else {
            // $trips = Trip::with('user')->get();
            // dd($trips);
            $trips = Trip::where('driver', '=', auth()->user()->id)->get();
            $vehicles = Vehicle::where('driver', '=', auth()->user()->id)->get();
            $persons = User::where('id', '=', auth()->user()->id)->get();
            return view('driver.index', compact('trips', 'vehicles', 'persons'));
        }



        // $trips = Trip::with('user')->get();
        // $vehicles = Vehicle::get();
        // // dd($trips);
        // return view('driver.index', compact('trips', 'vehicles'));
    }

    public function store(Request $request)
    {

        $trip = new Trip([
            'driver' => auth()->user()->id,
        ] + $request->all());
        $trip->save();

        return response()->json([
            'user' => $trip,
            'saved' => true
        ]);
    }

    public function update(Request $request, Trip $trip)
    {
        $trip->update($request->all());

        return response()->json([
            'trip' => $trip,
            'saved' => true
        ]);
    }

    public function destroy($id)
    {
        Trip::where('id', $id)->delete();
        return back()->with('status', 'It was successfully deleted');
    }
}
