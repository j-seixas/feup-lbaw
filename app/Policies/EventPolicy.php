<?php

namespace App\Policies;

use App\Member;
use App\Event;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class EventPolicy
{
    use HandlesAuthorization;

    public function show(Member $member, Event $event)
    {
      // TODO check if user is in private event, else let everyone see
      return $event->visibility == 'Public';
    }

    public function list(Member $member)
    {
      // Any member can list its own events
      return Auth::check();
    }

    public function create(Member $member)
    {
      // Any member can create a new event
      return Auth::check();
    }

    public function delete(Member $member, Event $event)
    {
      // Only a event owner can delete it
      return $member->id == $event->id_member;
    }
}
