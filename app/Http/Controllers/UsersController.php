<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

class UsersController extends Controller
{
    public function show($id)
    {
    	$user = User::find($id);
    	return view('usersettings', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
    	$user = User::find($id);
    	$user->username = $request->input('username');
    	$user->save();
    	return redirect('users/'.$user->id);
    }
}
