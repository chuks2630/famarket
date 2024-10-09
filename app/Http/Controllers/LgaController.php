<?php

namespace App\Http\Controllers;
use App\Models\Lga;
use Illuminate\Http\Request;

class LgaController extends Controller
{
    //
    public function fetchLga(Request $request){
       
         // Retrieve the passed 'id' from the request
         $stateId = $request->input('id');

         // Fetch options filtered by category ID (or another condition)
         $lgas = Lga::where('state_id', $stateId)->get();
 
         // Return the options as a JSON response
         return response()->json($lgas);
    }
}
