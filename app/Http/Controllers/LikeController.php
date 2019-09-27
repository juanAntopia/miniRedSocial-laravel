<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    //method for authenticate the user
    public function __construct()
    {
        $this->middleware('auth');
    }

    //method for list of likes
    public function index(){
        $user= \Auth::user(); 
        $likes = Like::where('user_id', $user->id)
                       ->orderBy('id', 'desc')
                       ->paginate(5);

        return view('like.index', [
            'likes' => $likes
        ]);
    }

    public function like($image_id){
        //get user data and image_id
        $user_id = \Auth::user();

        //check in the database
        $isset_like = Like::where('user_id', $user_id->id)
                            ->where('image_id', $image_id)
                            ->count();
        //validate the like
        if($isset_like == 0){
            $like = new Like();
            $like->user_id = $user_id->id;
            $like->image_id = (int)$image_id;

            //save the like
            $like->save();
            
            //return response in json format
            return response()->json([
                'like' => $like
            ]);

        }else{
            //else: response
            return response()->json([
                'message' => 'El like ya existe'
            ]);
        }
    }//end like function

    public function dislike($image_id){
        $user_id = \Auth::user();

        $like = Like::where('user_id', $user_id->id)
                      ->where('image_id', $image_id)
                      ->first();

        if($like){
            $like->delete();

            return response()->json([
                'like' => $like,
                'message' => 'Ha dado dislike'
            ]);
        }else{
            return response()->json([
                'message' => 'El like no existe'
            ]);
        }
    }//end function dislike
}//end class controller
