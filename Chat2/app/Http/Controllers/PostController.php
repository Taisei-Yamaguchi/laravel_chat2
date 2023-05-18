<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

//add post
    public function post(Request $request){
        $this->validate($request,Post::$rules);
        $form=$request->all();
        unset($form['_token']);

        $post=new Post;
        $post->fill($form)->save();

        $ses=$request->session()->all();
        $posts=array();
        $posts=Post::orderBy('id','DESC')
        ->simplePaginate(10);
        return view('mypage.home',[
            'posts'=>$posts,
            'member'=>$ses,
        ]);
    }




//to Post Delete Screen
    public function delete_index(Request $request)
    {
        $ses=$request->session()->all();
        $post_id=$request->post_id;
        $post=Post::where('id',$post_id)->first();

        if(isset($post)){ //クエリのidに一致するpostがないときはそもそもこの処理をしない
            if($post->member_id==$ses['id']){
                return view('posts.delete_index',[
                    'member'=>$ses,
                    'post'=>$post,
                ]);
            }else{
                $posts=array();
                $posts=Post::orderBy('id','DESC')
                ->simplePaginate(10);
                return redirect("mypage/home");
            }
        }else{
            $posts=array();
                $posts=Post::orderBy('id','DESC')
                ->simplePaginate(10);
                return redirect("mypage/home");
        }
    }




//delete Post
    public function delete(Request $request)
    {
        $id=$request->post_id;
        $post=Post::where('id',$id)->delete();
        return redirect("mypage/home");
    }




//to individual Screen
    public function individual(Request $request)
    {
        $post_id=$request->post_id;
        $ses=$request->session()->all();
        $main_post=Post::where('id',$post_id)->first();

        if(isset($main_post)){
            $reply_posts=Post::where('reply_post_id',$post_id)
            ->orderBy('id','DESC')
            ->simplePaginate(10);

            return view("posts.post_individual",[
                'member'=>$ses,
                'main_post'=>$main_post,
                'reply_posts'=>$reply_posts,
            ]);
        }else{
            $posts=array();
            $posts=Post::orderBy('id','DESC')
            ->simplePaginate(10);
            return redirect("mypage/home");
        }
    }



//reply function
    public function reply(Request $request){
        
        $this->validate($request,Post::$rules);
        $form=$request->all();
        unset($form['_token']);
        $main_post=Post::where('id',$form['reply_post_id'])->first();

        $form['message']=$form['message']."→@(".$main_post->member->name.")".$main_post->message;

        $post=new Post;
        $post->fill($form)->save();

       return back()->withInput();
    }

}
