<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordRequest;
use App\Models\Word;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class MainController extends Controller
{
    public function main()
    {
        $user = Auth::user();
        return view('main', compact('user'));
    }

    public function admin()
    {
        $allUsers = User::get();
        $user = Auth::user();
        return view('admin/main', compact('allUsers', 'user'));
    }

}
