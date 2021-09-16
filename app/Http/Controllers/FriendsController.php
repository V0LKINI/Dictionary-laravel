<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    public function delete(Request $request)
    {
        $user = Auth::user();
//        $friend_id = $request->friend_id;
    }
}
