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
    public function show($id) {
        $member = Member::findOrFail($id);
        $isOwner = Auth::check() ? ($id == Auth::user()->id) : false;
        $friends = [];
        $tags = DB::select('SELECT * FROM member_tags WHERE id_member = ?', [$id]);
        $country = DB::select('SELECT country.name FROM country, member WHERE member.id = ? AND member.id_country = country.id', [$id]);
        if ($country != null)
            $country = $country[0];
        foreach (Friend::where('id_member', $id)->get() as $friend) {
            array_push($friends, $friend->friend);
        }

        return view('pages.profile', ['member' => $member, 'isOwner' => $isOwner, 'friends' => $friends, 'auth' => Auth::user(), 'tags' => $tags, 'country' => $country]);
    }

    public function edit(Request $request, $id){
        if ($id != Auth::user()->id)
        return response('Forbidden', 403); // TODO check admin

        $memberName = $request->input('memberName');
        $memberDescription = $request->input('memberDescription');
        $memberCountry = $request->input('memberCountry');
        DB::table('member')->where('id', $id)->update(['name' => $memberName, 'description' => $memberDescription, 'id_country' => $memberCountry]);

        $nameCountry = DB::table('country')->select('name')->where('id', $memberCountry)->get();
        return response()->json(['memberName' => $memberName, 'memberDescription' => $memberDescription, 'memberCountry' => $nameCountry[0]->name]);

    }

    public function delete(Request $request, $id) {
        $member = Member::find($id);
  
        $isOwner = Auth::check() ? ($id == Auth::user()->id) : false;
  
        if($isOwner) {
          $member->delete();
          return response('OK' , 200);
        }
        
        return response('Bad Request', 400);
      }
}
