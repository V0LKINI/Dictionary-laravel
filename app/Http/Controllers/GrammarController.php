<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordRequest;
use App\Models\Word;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class GrammarController extends Controller
{
    public function main()
    {
        $user = Auth::user();
        return view('grammar/main', compact('user'));
    }

}
