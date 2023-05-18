<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $items=Member::all();
        return view('member.index',['items'=>$items]);
    }



    
//to New Registration Screen
    public function add(Request $request)
    {
        //登録確認画面から戻った場合、アップデートされたimageを削除する処理を入れる。
        return view('member.register_index');
    }



//add New Member
//2023.5.16add 処理：メールのダブりを防ぐ。パスワードの二重確認、name,mail,passwordは必須にする。
//もっとコンパクトに？？？
    public function create(Request $request)
    {   
        //メールアドレスのチェック状況に関わらず、ruleは調べる。
        $this->validate($request,Member::$rules);
        $form=$request->all();
        unset($form['_token']);
        $mail_check =Member::where('mail',$form['mail'])
        ->first();
        //初めに配列を用意
        $member=new Member;
        $error=array();

        if(isset($mail_check)){
            $error['mail']="このメールアドレスは使われています。";
        }
        if($form['password']!=$form['password2']){
            $error['password']="確認用パスワードと一致しません";
            //これリアルタイムで出したい
        }
        //2023.5.16 画像ファイルの名前を抽出して保存。ファイル自体もmoveメソッドで保存。
        if(isset($form['image'])){
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();

            if($extension =='jpg' || $extension=='png' || $extension=='gif' || $extension=='jfif'){
                $original=$file->getClientOriginalName();
                $filename=date('Ymd_His').'_'.$original;
                $form['image']=$filename;
            }
            else{
                $error['image']="不適切なファイルです";
            }
        }

        if(empty($error)){
            if(isset($file)){
                $file->move('../storage/app/public/member_images',$filename);
            }
            $member->fill($form)->save();
            return view('member.register');
        }else{
            //flashとoldでフォームに入力してたものを一時的に記憶させる
            $request->flash();
            return view('member.register_index',
            ['error_others'=>$error],
        );
        }
    }






//to Member Delete Screen
    public function delete_index(Request $request)
    {
        $ses=$request->session()->all();
        return view('member.delete_index',[
            'member'=>$ses,
        ]);
    }



//delete Member
    public function delete(Request $request)
    {
        $member_id=$request->member_id;
        $member=Member::where('id',$member_id)->first();
        $posts=Post::where('member_id',$member_id)->get();
        
        //このポストにリプライしているポストを編集
        foreach($posts as $post){
            $reply_posts=Post::where('reply_post_id',$post->id)->get();
            foreach($reply_posts as $reply_post){
                $form=array();
                $form['reply_post_id']=0;
                $reply_post->fill($form)->save();
            }
        }
        $member=Member::where('id',$member_id)->delete();
        $posts=Post::where('member_id',$member_id)->delete();

        //このメンバーがリコメンドしたpostsの情報も消す。
        
        // $items=Snack::where('member_id',$member_id)->delete();
        //メンバーの写真も消す
        Storage::disk('public')->delete('member_images/'.$request->session()->get('image'));
        return view('mypage.login');
    }
}
