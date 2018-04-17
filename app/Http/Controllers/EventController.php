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

      $this->authorize('show', $event);

      return view('pages.event', ['event' => $event]);
    }

    /**
     * Shows all events.
     *
     * @return Response
     */
    public function showList()
    {

      $events = Event::findAll();

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

      $this->authorize('create', $event);

      $event->title = $request->input('eventName');
      $event->description = $request->input('description');
      $event->visibility = $request->input('visibility');
      $event->date = $request->input('date');
      $event->location = $request->input('location');
      $event->picture = $request->input('picture');


      $event->save();

      return $event;
    }

    public function delete(Request $request, $id)
    {
      $event = Event::find($id);

      $this->authorize('delete', $event);
      $event->delete();

      return $event;
    }
}
