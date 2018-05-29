<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MyEventsController extends Controller
{
    /**
     * Shows the my events for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function showMyEvents() {
        if(Auth::check()){
            $id = Auth::user()->id;

            $currDate = date("Y-m-d H:i:s");

            DB::beginTransaction();

            $createdEvents = DB::select("SELECT event.id, event.title, event.date, event.location, event.description, event.image, event.visibility,
            (SELECT COUNT(*) FROM event_member WHERE id_event=event.id AND status='Going') AS num_going
            FROM event, event_member
            WHERE event.id=event_member.id_event AND role='Owner' AND id_member=?
            ORDER BY date ASC;", [$id]);

            $goingEvents = DB::select("SELECT event.id, event.title, event.date, event.location, event.description, event.image, event.visibility,
            (SELECT COUNT(*) FROM event_member WHERE id_event=event.id AND status='Going') AS num_going
            FROM event, event_member
            WHERE event.id=event_member.id_event AND status='Going' AND date>? AND id_member=?
            ORDER BY date ASC;", [$currDate, $id]);

            $invitedEvents = DB::select("SELECT event.id, event.title, event.date, event.location, event.description, event.image, event.visibility,
            (SELECT COUNT(*) FROM event_member WHERE id_event=event.id AND status='Going') AS num_going
            FROM event, event_invitation LEFT JOIN notification ON event_invitation.id_notification=notification.id
            WHERE date>? AND notification.id_member=? AND event_invitation.id_event=event.id
            ORDER BY date ASC;", [$currDate, $id]);

            $pastEvents = DB::select("SELECT event.id, event.title, event.date, event.location, event.description, event.image, event.visibility,
            (SELECT COUNT(*) FROM event_member WHERE id_event=event.id AND status='Going') AS num_going
            FROM event, event_member
            WHERE event.id=event_member.id_event AND date<? AND id_member=?
            ORDER BY date DESC;", [$currDate, $id]);

            DB::commit();
            
            return view('pages.myevents', ['id' => $id, 'createdEvents' => $createdEvents, 'goingEvents' => $goingEvents, 
                'invitedEvents' => $invitedEvents, 'pastEvents' => $pastEvents]);
        }

        return view('auth.login', []);
    }
}