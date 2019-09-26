<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){
        
        //form validation
        $validate = $this->validate($request, [
            'image_id' => 'integer | required',
            'content' => 'string | required',
        ]);

        //catch the data
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        //assign the values to my new object
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        
        //Save the comment
        $comment->save();
        
        //Redirect with message flash
        return redirect()->route('image.detail', ['id' => $image_id])
                ->with(['message' => 'Has publicado tu comentario correctamente!!']);
    }

    public function delete($id){
        //user auth
        $user = \Auth::user();

        //get the comment
        $comment = Comment::find($id);

        //validate the true owner of the post
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            $comment->delete();

            return redirect()->route('image.detail', ['id' => $comment->image->id])
                             ->with(['message' => 'Comentario eliminado correctamente!!']);
        }else{
            return redirect()->route('image.detail', ['id' => $comment->image->id])
                             ->with(['message' => 'El comentario no se ha podido eliminar !!']);
        }
    }
}
