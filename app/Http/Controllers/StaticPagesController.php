<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StaticPagesController extends Controller
{
    /**
     * Shows the faq page.
     *
     * @param  int  $id
     * @return Response-
     */
    public function showFAQ()
    {
      return view('pages.faq');
    }

    /**
     * Shows the contacts page.
     *
     * @param  int  $id
     * @return Response-
     */
    public function showContacts()
    {
      return view('pages.contacts');
    }

    /**
     * Shows the about page.
     *
     * @param  int  $id
     * @return Response-
     */
    public function showAbout()
    {
      return view('pages.about');
    }

    /**
     * Shows the privacy page.
     *
     * @param  int  $id
     * @return Response-
     */
    public function showPrivacy()
    {
      return view('pages.privacy');
    }

    /**
     * Shows the team page.
     *
     * @param  int  $id
     * @return Response-
     */
    public function showTeam()
    {
      return view('pages.team');
    }

    /**
     * Shows the terms page.
     *
     * @param  int  $id
     * @return Response-
     */
    public function showTerms()
    {
      return view('pages.terms');
    }
}
