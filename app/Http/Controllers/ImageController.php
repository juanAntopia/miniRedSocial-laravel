<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    //method for authenticate the user
    public function __construct()
    {
        $this->middleware('auth');
    }

    //method for return a view "create image"
    public function create(){
        return view('image.create');
    }

    //method for save an image
    public function save(Request $request){
        //validation
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|image'
        ]);
        
        //take the value of data
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //Assign values at the new object
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

        //upload file
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->save();

        return redirect()->route('home')->with([
            'message' => 'La imagen ha sido subida correctamente'   
        ]);
    }
}
