<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Event;
use App\EventMember;

class EventMemberController extends Controller
{
  



    /**
     * Creates a new eventMember.
     *
     * @return eventMember The eventMember created.
     */
    public function create()
    {
      $event_member = new EventMember();

      $event_member->id_event = $event->id;
      $event_member->id_member = Auth::user()->id;
      $event_member->role = 'Owner';

      $event_member->save();

      return $event_member;
    }

    public function delete($id)
    {
      $event_member = EventMember::find($id);


      $event_member->delete();
      return;
      
    }

    public function editStatus(Request $request, $id)
    {

      $id_event = $id;

      $id_member_event = DB::select('SELECT id FROM event_member WHERE id_member = ? AND id_event = ?', [Auth::user()->id, $id_event])[0]->id;
      
      $event_member = EventMember::findOrFail($id_member_event);

      $event_member->status = $request->input('attendance');

      $event_member->save();

      return $event_member;
    }
}
