<?php


namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Function\LoginFunction;
use Illuminate\Pagination\Paginator;
use App\Models\Post;
use App\Models\Member;


class MainController extends Controller
{
    public function login_index(Request $request){
        $request->session()->forget('id');
        $request->session()->forget('name');
        $request->session()->forget('mail');
        $request->session()->forget('image');
        return view('mypage.login');
    }

    

//login processing & to Mypage
    public function login(Request $request){
        $mail=$request->mail;
        $password=$request->password;
        //mailとpassを渡して、ログインできるメンバーを取得
        $member=LoginFunction::login($mail,$password);
        //ここにifを入れて、一致するメンバーがいたらマイページへ。いなければエラーメッセージ。
        if(isset($member)){
            $request->session()->put('id',$member->id);
            $request->session()->put('name',$member->name);
            $request->session()->put('image',$member->image);
            $request->session()->put('mail',$member->mail);
            $ses=$request->session()->all();
            
            $posts=array();
            $posts=Post::orderBy('id','DESC')
            ->simplePaginate(10);
            return view('mypage.home',[
                'member'=>$ses,
                'posts'=>$posts,
            ]);
        }else{
            return view('mypage.login',['mess'=>'ログイン失敗']);
        }
    }



//to Mypage(for GET). But session_id which is added when logined is necessary.
    public function home_index(Request $request)
    {
        $posts=$request->posts;
        $ses=$request->session()->all();
        return view('mypage.home',[
            'member'=>$ses,
            'posts'=>$posts,
        ]);
    }


}
