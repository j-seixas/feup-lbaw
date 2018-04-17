<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Event;

class EventController extends Controller
{
    /**
     * Shows the event for a given id.
     *
     * @param  int  $id
     * @return Response-
     */
    public function show($id)
    {
      $event = Event::find($id);

      //$this->authorize('show', $event);

      $idOwner = DB::select('SELECT id_member FROM event_member WHERE role = ? AND id_event = ?', ['Owner', $id])[0]->id_member;

      $eventTags = DB::select('select name_tag from event_tags where id_event = ?', [$id]);

      $participants = DB::select('select count(*) from event_member where id_event = ? AND status = ?', [$id, 'Going'])[0]->count;
      
      $isOwner = Auth::check() ? ($idOwner == Auth::user()->id) : false;

      return view('pages.event', ['event' => $event, 'isOwner' => $isOwner, 'eventTags' => $eventTags, 'participants' => $participants]);
    }

    /**
     * Shows all events.
     *
     * @return Response
     */
    public function showList()
    {
      if (Auth::check()) {
        $events = Event::where('visibility', 'Public')->inRandomOrder()->take(6)->get();
      } else {
        $events = Event::where('visibility', 'Public')->inRandomOrder()->take(3)->get();
      }
      return view('pages.events', ['events' => $events]);
    }

    public function showCreateForm()
    {
      if (Auth::check()) {
        return view('pages.createEvent');
      } else {
        return redirect('login');
      }
      
    }

    /**
     * Creates a new event.
     *
     * @return event The event created.
     */
    public function create(Request $request)
    {
      $event = new Event();

      //$this->authorize('create', $event);

      $event->title = $request->input('eventName');
      $event->description = $request->input('eventDescription');
      $event->visibility = $request->input('eventPrivacy');
      $event->date = $request->input('eventDate');
      $event->location = $request->input('eventLocation');
      //$event->picture = $request->input('picture');

      $event->save();

      DB::insert('insert into event_member (id_event, id_member, role) values (?, ?, ?)', [$event->id, Auth::user()->id, 'Owner']);

      return redirect()->route('event',['id' => $event->id]);
    }

    public function delete(Request $request, $id)
    {
      $event = Event::find($id);

      $this->authorize('delete', $event);
      $event->delete();

      return $event;
    }
}
