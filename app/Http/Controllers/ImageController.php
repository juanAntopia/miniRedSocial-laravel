<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Image;
use App\Comment;
use App\Like;

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

    //function get an image
    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    //function image detail
    public function detail($id){
        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image
        ]);
    }

    //function delete image
    public function delete($id){
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();
        
        
        if($user && $image->user->id == $user->id){
            //delete comments
            if($comments && count($comments)>=1){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }

            //delete likes
            if ($likes && count($likes) >= 1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            //delete files of the image
            Storage::disk('images')->delete($image->image_path);

            //delete register of image
            $image->delete();

            $message = array('message' => 'La imagen se ha borrado correctamente!!');
        }else{
            $message = array('message' => 'La imagen no se ha podido borrar');            
        }

        return redirect()->route('home')->with($message);
    }//end function delete

    public function edit($id){
        $user = \Auth::user();
        $image = Image::find($id);
        
        if($user && $image && $image->user->id == $user->id){
            return view('image.edit', [
                'image' => $image
            ]);
        }else{
            return redirect()->route('home');
        }
    }//end function edit

    public function update(Request $request){

        $validate = $this->validate($request, [
            'description' => 'string',
            'image_path' => 'image'
        ]);
        
        //get the data
        $image_path= $request->file('image_path');
        $image_id = $request->input('image_id');
        $description = $request->input('description');

        //set the data
        $image = Image::find($image_id);
        $image->description = $description;

        //upload image
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        
        //update image
        $image->update();

        return redirect()->route('image.detail', ['id' => $image_id])
                         ->with(['message' => 'Imagen actualizada con éxito!!']);   
    }    
}
