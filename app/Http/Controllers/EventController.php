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
      $event = Event::findOrFail($id);

      //$this->authorize('show', $event);

      $idOwner = DB::select('SELECT id_member FROM event_member WHERE role = ? AND id_event = ?', ['Owner', $id])[0]->id_member;

      $eventTags = DB::select('select name_tag from event_tags where id_event = ?', [$id]);

      $participants = DB::select('select count(*) from event_member where id_event = ? AND status = ?', [$id, 'Going'])[0]->count;

      $interested = DB::select('select count(*) from event_member where id_event = ? AND status = ?', [$id, 'Interested'])[0]->count;
      
      $isOwner = Auth::check() ? ($idOwner == Auth::user()->id) : false;

      if (Auth::check()) {
        $statusList = DB::select('SELECT status FROM event_member WHERE id_event = ? AND id_member = ?', [$id, Auth::user()->id]);
        $roleList = DB::select('SELECT role FROM event_member WHERE id_event = ? AND id_member = ?', [$id, Auth::user()->id]);
      }

      $status = null;
      $role = null;

      if(!empty($statusList)) {
        $status = $statusList[0]->status;
      }
      if(!empty($roleList)){
        $role = $roleList[0]->role;
      }

      $comments = DB::select('SELECT c.id, id_member, id_event, date, id_parent, concat(tc.text::text, fc.text::text, pc.text::text) AS text, 
      path, m.name, m.image AS profile_pic, (select count(*) from text_comment where c.id = id_parent) as num_comments, 
      (select count(*) from liked where c.id=id_comment) as num_likes FROM comment c
      LEFT JOIN member m ON id_member = m.id
      LEFT JOIN text_comment tc ON tc.id_comment = c.id
      LEFT JOIN file fc ON fc.id_comment = c.id
      LEFT JOIN poll pc ON pc.id_comment = c.id
      WHERE id_event=? AND id_parent ISNULL
      ORDER BY c.id;', [$id]);

      $subComments = DB::select('SELECT c.id, id_member, id_event, date, id_parent, tc.text AS text, 
      m.name, m.image AS profile_pic, (select count(*) from liked where c.id=id_comment) as num_likes FROM comment c
      LEFT JOIN member m ON id_member = m.id
      LEFT JOIN text_comment tc ON tc.id_comment = c.id
      WHERE id_event=? AND id_parent NOTNULL
      ORDER BY c.id;', [$id]);
      
      $i = 0;
      $j = 0;
      for($i = 0; $i < sizeof($comments); $i++){
        $comments[$i]->sub_comments = array();
      }

      for($i = 0; $i < sizeof($comments); $i++){
        if($j >= sizeof($subComments))
          break;
        if($comments[$i]->id == $subComments[$j]->id_parent){
          array_push($comments[$i]->sub_comments, $subComments[$j]);
          $i--;
          $j++;
        }
        
        else if($comments[$i]->id > $subComments[$j]->id_parent)
          $j++;
      }

      return view('pages.event', ['event' => $event, 'isOwner' => $isOwner, 'eventTags' => $eventTags, 'participants' => $participants, 
      'interested' => $interested, 'status' => $status, 'role' => $role, 'comments' => $comments]);
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
        return view('pages.eventForm', ['edit' => false]);
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
      if (!Auth::check()) {
        return redirect()->route('login');
      }
      
      $event = new Event();

      $event->title = $request->input('eventName');
      $event->description = $request->input('eventDescription');
      $event->visibility = $request->input('eventPrivacy');
      $date = new \DateTime($request->input('eventDate'));
      $time = new \DateTime($request->input('eventTime'));
      $merge = new \DateTime($date->format('Y-m-d').' '.$time->format('H:i:s'));
      $event->image = $request->hasFile('eventPicture') ? $request->file('eventPicture')->store('public') : null;
      $event->date = $merge->format('Y-m-d H:i:s');
      $event->location = $request->input('eventLocation');

      $event->save();

      $event_member = EventMemberController::createOwner($event);

      return redirect()->route('event',['id' => $event->id]);
    }

    public function delete(Request $request, $id)
    {
      $event = Event::find($id);


      $idOwner = DB::select('SELECT id_member FROM event_member WHERE role = ? AND id_event = ?', ['Owner', $id])[0]->id_member;

      $isOwner = Auth::check() ? ($idOwner == Auth::user()->id) : false;
      //$this->authorize('delete', $event);

      if($isOwner) {
        $event->delete();
        return response('OK' , 200);
      }
      

      return response('Bad Request', 400);
    }

    public function showEditForm($id) {
      $event = Event::findOrFail($id);

      $idOwner = DB::select('SELECT id_member FROM event_member WHERE role = ? AND id_event = ?', ['Owner', $id])[0]->id_member;

      $isOwner = Auth::check() ? ($idOwner == Auth::user()->id) : false;
      //$this->authorize('delete', $event);

      if($isOwner) {
        return view('pages.eventForm', ['event' => $event, 'edit' => true]);
      } else {
        return redirect()->route('event',['id' => $event->id]);
      }
    }

    public function edit(Request $request, $id)
    {
      $event = Event::findOrFail($id);

      $event->title = $request->input('eventName');
      $event->description = $request->input('eventDescription');
      $event->visibility = $request->input('eventPrivacy');
      $date = new \DateTime($request->input('eventDate'));
      $time = new \DateTime($request->input('eventTime'));
      $merge = new \DateTime($date->format('Y-m-d').' '.$time->format('H:i:s'));
      $event->image = $request->hasFile('eventPicture') ? $request->file('eventPicture')->store('public') : $event->image;
      $event->date = $merge->format('Y-m-d H:i:s');
      $event->location = $request->input('eventLocation');

      $event->save();

      return redirect()->route('event',['id' => $id]);
    }
}
