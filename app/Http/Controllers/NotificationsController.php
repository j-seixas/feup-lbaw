<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    /**
     * Shows the notifications.
     *
     * @return Response
     */
    public function showNotifications() {
        if(Auth::check()){
            $id = Auth::user()->id;

            $notifNotSeen = DB::select("SELECT n.id, n.id_member, seen, hidden, ei.id_event as id_event_invite, concat(ei.title::character varying(128), ec.title::character varying(128)) as title, 
            fr.id_member as id_friend, fr.name as friend_name, ec.id_event as id_event_change, ec.change, ec.location, ec.date, em.status
            FROM notification n  
            LEFT JOIN (SELECT e.id_notification, e.id_event, ev.title FROM event_invitation e, event ev WHERE e.id_event=ev.id) ei ON n.id=ei.id_notification
            LEFT JOIN (SELECT f.id_notification, f.id_member, m.name FROM friend_request f, member m WHERE m.id=f.id_member) fr ON fr.id_notification=n.id
            LEFT JOIN (SELECT e.id_notification, e.id_event, e.change, ev.title, ev.location, ev.date FROM event_change e, event ev WHERE e.id_event=ev.id) ec ON n.id=ec.id_notification
            LEFT JOIN event_member em ON em.id_event=ec.id_event AND em.id_member=n.id_member
            WHERE seen='false' AND hidden='false' AND n.id_member=?
            ORDER BY id DESC", [$id]);

            $notifSeen = DB::select("SELECT n.id, n.id_member, seen, hidden, ei.id_event as id_event_invite, concat(ei.title::character varying(128), ec.title::character varying(128)) as title, 
            fr.id_member as id_friend, fr.name as friend_name, ec.id_event as id_event_change, ec.change, ec.location, ec.date, em.status
            FROM notification n  
            LEFT JOIN (SELECT e.id_notification, e.id_event, ev.title FROM event_invitation e, event ev WHERE e.id_event=ev.id) ei ON n.id=ei.id_notification
            LEFT JOIN (SELECT f.id_notification, f.id_member, m.name FROM friend_request f, member m WHERE m.id=f.id_member) fr ON fr.id_notification=n.id
            LEFT JOIN (SELECT e.id_notification, e.id_event, e.change, ev.title, ev.location, ev.date FROM event_change e, event ev WHERE e.id_event=ev.id) ec ON n.id=ec.id_notification
            LEFT JOIN event_member em ON em.id_event=ec.id_event AND em.id_member=n.id_member
            WHERE seen='true' AND hidden='false' AND n.id_member=?
            ORDER BY id DESC", [$id]);
            
            return view('pages.notifications', ['notifNotSeen' => $notifNotSeen, 'notifSeen' => $notifSeen]);
        }

        return view('auth.login', []);
    }
}