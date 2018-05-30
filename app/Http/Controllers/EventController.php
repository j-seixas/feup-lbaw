<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Event;
use App\Member;

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
      path, m.name, m.image AS profile_pic, (SELECT count(*) FROM text_comment WHERE c.id = id_parent) AS num_comments, 
      (SELECT count(*) FROM liked WHERE c.id=id_comment) AS num_likes, (SELECT count(*) FROM option WHERE c.id=id_comment) AS num_options 
      FROM comment c
      LEFT JOIN member m ON id_member = m.id
      LEFT JOIN text_comment tc ON tc.id_comment = c.id
      LEFT JOIN file fc ON fc.id_comment = c.id
      LEFT JOIN poll pc ON pc.id_comment = c.id
      WHERE id_event=? AND id_parent ISNULL
      ORDER BY c.id DESC;', [$id]);

      $subComments = DB::select('SELECT c.id, id_member, id_event, date, id_parent, tc.text AS text, 
      m.name, m.image AS profile_pic, (SELECT count(*) FROM liked WHERE c.id=id_comment) AS num_likes FROM comment c
      LEFT JOIN member m ON id_member = m.id
      LEFT JOIN text_comment tc ON tc.id_comment = c.id
      WHERE id_event=? AND id_parent NOTNULL
      ORDER BY c.id DESC;', [$id]);

      $pollComments = DB::select('SELECT option.id, poll.id_comment, option_text, (SELECT count(*) FROM vote WHERE id_option=option.id) AS num_votes, t.total_votes
      FROM comment LEFT JOIN poll ON comment.id=poll.id_comment
      LEFT JOIN option ON poll.id_comment=option.id_comment 
      INNER JOIN (SELECT poll.id_comment, sum((SELECT count(*) FROM vote WHERE id_option=option.id) ) AS total_votes
        FROM poll LEFT JOIN option ON poll.id_comment=option.id_comment 
        GROUP BY poll.id_comment ORDER BY poll.id_comment) t ON poll.id_comment=t.id_comment
      WHERE comment.id_event=?
      ORDER BY poll.id_comment;', [$id]); 

      $i = 0;
      for($i = 0; $i < sizeof($comments); $i++){
        $comments[$i]->liked = false;
      }
      for($i = 0; $i < sizeof($subComments); $i++){
        $subComments[$i]->liked = false;
      }

      if(Auth::check()){
        $idUser = Auth::user()->id;
        
        $likedComments = DB::select('SELECT comment.id 
        FROM comment, liked 
        WHERE id_comment=comment.id AND id_event=? AND liked.id_member=?
        ORDER BY comment DESC;', [$id, $idUser]);

        $j = 0;
        for($i = 0; $i < sizeof($comments); $i++){
          if($j >= sizeof($likedComments))
            break;
          if($comments[$i]->id == $likedComments[$j]->id){
            $comments[$i]->liked = true;
            $j++;

          } else if($comments[$i]->id < $likedComments[$j]->id)
            $j++;
        }

        $j = 0;
        for($i = 0; $i < sizeof($subComments); $i++){
          if($j >= sizeof($likedComments))
            break;
          if($subComments[$i]->id == $likedComments[$j]->id){
            $subComments[$i]->liked = true;
            $j++;

          } else if($subComments[$i]->id < $likedComments[$j]->id)
            $j++;
        }
      } 
      
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
        
        else if($comments[$i]->id < $subComments[$j]->id_parent)
          $j++;
      }

      $j = 0;
      for($i = 0; $i < sizeof($comments); $i++){
        $comments[$i]->poll_options = array();
      }

      for($i = 0; $i < sizeof($comments); $i++){
        if($j >= sizeof($pollComments))
          break;
        if($comments[$i]->id == $pollComments[$j]->id_comment){
          array_push($comments[$i]->poll_options, $pollComments[$j]);
          $i--;
          $j++;
        }
        
        else if($comments[$i]->id < $pollComments[$j]->id_comment)
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

      $isOwner = Auth::check() ? ($idOwner == Auth::user()->id || Member::find(Auth::user()->id)->admin) : false;
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

      $isOwner = Auth::check() ? ($idOwner == Auth::user()->id || Member::find(Auth::user()->id)->admin) : false;
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

    public function like(Request $request){
      $user = Auth::user()->id;
      $comment = $request->input('idComment');
      $liked = $request->input('liked');

      if($liked == 'false'){
        DB::table('liked')->where('id_comment', $comment)->where('id_member', $user)->delete();
        $liked = FALSE;
      } else {
        if(!DB::table('liked')->where('id_comment', $comment)->where('id_member', $user)->exists()) {
          DB::table('liked')->insert(array('id_member' => $user, 'id_comment' => $comment));
        }
        $liked = TRUE;
      }

      $likes = DB::select("SELECT count(*) AS likes
      FROM comment, liked 
      WHERE id_comment=comment.id AND id_comment=?", [$comment]);

      return response()->json(['idComment' => $comment, 'likes' => $likes[0]->likes, 'liked' => $liked]);
    }

    public function addComment(Request $request, $id) {
      if (!$request->input('text')) {
        return response('Bad Request', 400);
      }

      $comment = DB::table('comment')->insertGetId(['id_member' => Auth::user()->id, 'id_event' => intval($id), 'date' => 'now']); 

      DB::table('text_comment')->insert(['id_comment' => $comment, 'text' => $request->input('text')]);

      $member = Member::find(Auth::user()->id);

      return response()->json(['id_member' => Auth::user()->id, 'id_event' => intval($id), 'text' => $request->input('text'), 'id_comment' => $comment, 'profile_pic' => $member->image ? Storage::url($member->image) : asset('img/person_placeholder.png'), 'name' => $member->name]);
    }
}
