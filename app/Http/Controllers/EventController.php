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
      $event = event::find($id);

      $this->authorize('show', $event);

      return view('pages.event', ['event' => $event]);
    }

    /**
     * Shows all events.
     *
     * @return Response
     */
    public function list()
    {
      $this->authorize('list', event::class);

      $events = Auth::user()->events()->orderBy('id')->get();

      return view('pages.events', ['events' => $events]);
    }

    /**
     * Creates a new event.
     *
     * @return event The event created.
     */
    public function create(Request $request)
    {
      $event = new event();

      $this->authorize('create', $event);

      $event->name = $request->input('name');
      $event->user_id = Auth::user()->id;
      $event->save();

      return $event;
    }

    public function delete(Request $request, $id)
    {
      $event = event::find($id);

      $this->authorize('delete', $event);
      $event->delete();

      return $event;
    }
}
