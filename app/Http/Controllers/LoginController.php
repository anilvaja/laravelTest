<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $useInfo = User::where('name',$request->post('email'))
                        ->orWhere('name',$request->post('email'))
                        ->where('password',($request->post('password')));
        if($useInfo->get()->toArray())
        {
            return json_encode(['success'=>'Login Successfully']);
        }else{
            return json_encode(['error'=>'Please validatethe credentials']);
        }
    }
    public function events()
    {
        redirect()->route('events');
    }
}