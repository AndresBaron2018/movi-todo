<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class employeeLiquidationController extends Controller
{
    public function employeeLiquidation()
    {
        return view('driver.employeeLiquidation.index');
    }

    public function bringUserByDocumentNumber($identification_card)
    {
        if (User::where('identification_card', $identification_card)->first()) {
            $user = User::with('trip')->where('identification_card', $identification_card)->get();
            return $user->toJson();
        } else {
            return 'Usuario no encontrado';
        }
    }

    // public function bringUserByDocumentNumber($identification_card)
    // {
    //     return self::whereHas('users', function ($query) use ($identification_card) {
    //         $query->where($identification_card);
    //     })->first();
    // }
}
