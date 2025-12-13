<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\City;
class DashboardController extends Controller
{
   public function dashboard()
{

    return view('admin.dashboard');
}

    public function get_state(Request $request)
    {
        $city = City::find($request->id);

        if ($city) {
            return response()->json(['status' => 'success', 'message' => $city->state_id], 200);
        }

        return response()->json(['status' => 'error', 'message' => 'City not found'], 404);
    }
}
