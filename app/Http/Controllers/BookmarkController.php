<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function bookmark($plece_id)
    {
        auth()->user()->bookmarks()->toggle($plece_id);
        return back();
    }
    public function getByUser()
    {
        $bookmarks = auth()->user()->bookmarks;
        return view('user_bookmarks', compact('bookmarks'));
    }
}
