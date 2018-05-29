<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request) {
        $query = $request->input('query');
        $type = $request->input('type') ? $request->input('type') : 'event';
        $events = DB::select('SELECT DISTINCT event.id, event.title, event.date, event.location, event.description, event.image, event.visibility, 
        (SELECT COUNT(*) FROM event_member WHERE id_event=event.id AND status=\'Going\' GROUP BY id_event) AS participants 
        FROM event, event_member 
        WHERE to_tsvector(\'english\', title || \' \' || location) @@ plainto_tsquery(\'english\', ?) AND event.id=event_member.id_event 
        AND visibility = \'Public\'', [$query]);
        $members = DB::select('SELECT * FROM member WHERE to_tsvector(\'english\', name) @@ plainto_tsquery(\'english\', ?)', [$query]);
        return view('pages.search', ['query' => $query, 'type' => $type, 'events' => $events, 'members' => $members]);
    }
}