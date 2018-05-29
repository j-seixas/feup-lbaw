<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
{
    /**
     * Returns a list of countries
     *
     * @return Response
     */
    public function list() {
        $countries = DB::select("SELECT * FROM country");
        return response()->json($countries);
    }
}