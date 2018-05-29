<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Member;
use App\Friend;

class ProfileController extends Controller
{
    /**
     * Shows the profile for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function showProfile($id) {
        $member = Member::findOrFail($id);

        $isOwner = Auth::check() ? ($id == Auth::user()->id) : false;

        $friends = [];

        $tags = DB::select('SELECT * FROM member_tags WHERE id_member = ?', [$id]);

        foreach (Friend::where('id_member', $id)->get() as $friend) {
            array_push($friends, $friend->friend);
        }

        return view('pages.profile', ['member' => $member, 'isOwner' => $isOwner, 'friends' => $friends, 'tags' => $tags]);
    }
}
