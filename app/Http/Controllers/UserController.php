<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    //method configuration
    public function config(){
        return view('user.config');
    }

    //method update user
    public function update(Request $request){

        //Conseguir usuario identificado
        $user = \Auth::user();
        $id = $user->id;

        //Validación del formulario
        $validate = $this->validate($request, [
            'name' => 'required | string | max:100',
            'surname' => 'required | string | max:150',
            'nick' => 'required | string | max:100 | unique:users,nick,'.$id,
            'email' => 'required | string | max:255 | unique:users,email,'.$id
        ]);
        
        //Recoger los datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //pasar nuevos valores a objeto de usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;
        
        //subir imagen
        $image_path = $request->file('image_path');
        if($image_path){
            //poner nombre único
            $image_path_name = time().$image_path->getClientOriginalName();

            //Guardar en la carpeta storage (Storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            //seteó la imagen al objeto user
            $user->image = $image_path_name;
        }

        //Ejecutar función de actualizar
        $user->update();

        return redirect()->route('config')->with(['message' => 'Usuario actualizado correctamente']);
    }
}
