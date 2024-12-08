<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\Water;
use App\Models\FluidType;

class WaterController extends Controller
{
    
    public function water_form() {
        
        return view('water_form');

    }

    public function water_store(Request $request) {

        $user_id = Auth::user()->id;

        $newFluidEntry = new Water();

        $validated = $request->validate([
            "fluid-type" => 'required|numeric|min:1|max:4|exists:fluid_type,id',
            "water-amount" => 'required|numeric|min:0|max:15',
            "water-when" => 'required|date'
        ]);

        $newFluidEntry->user_id = $user_id;
        $newFluidEntry->fluid_id = $request->input("fluid-type");
        $newFluidEntry->amount = $request->input("water-amount");


        $fluid_when = strtotime($request->input("water-when"));

        $newFluidEntry->time_taken = date('Y-m-d H:i:s', $fluid_when);

        $newFluidEntry->save();
        $newFluidEntry->touch();

        return redirect()->route('nutrition_mainMenu');

    }

}
