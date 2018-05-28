<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request) {
        $query = $request->input('query');
        $events = DB::select('SELECT * FROM event WHERE to_tsvector(\'english\', title || \' \' || location) @@ to_tsquery(\'english\', ?) AND visibility = \'Public\'', [$query]);
        return view('pages.search', ['events' => $events]);
    }
}