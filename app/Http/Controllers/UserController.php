<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserAlias;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user){
        return new UserAlias($user);
    }
}
