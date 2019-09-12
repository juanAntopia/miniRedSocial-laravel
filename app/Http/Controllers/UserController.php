<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //method configuration
    public function config(){
        return view('user.config');
    }

    //method update user
    public function update(Request $request){
        $id = \Auth::user()->id;

        $validate = $this->validate($request, [
            'name' => 'required | string | max:100',
            'surname' => 'required | string | max:150',
            'nick' => 'required | string | max:100 | unique:users,nick,'.$id,
            'email' => 'required | string | max:255 | unique:users,email,'.$id
        ]);

        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        var_dump($id);
        var_dump($name);
        var_dump($surname);
        var_dump($nick);
        var_dump($email);

        die();
    }
}
