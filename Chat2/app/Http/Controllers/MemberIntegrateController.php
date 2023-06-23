<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberIntegrateController extends Controller
{
    public function getMemberFromSnack(Request $request)
    {
        //まず、chatアプリからmail,passをインプットしてもらい、
        //chat APIに渡す。

        //最後に、snackにあるメンバーインフォが返ってくるので、表示。
        //DB保存はchat apiでやってくれる。
        //こっちでは、受け取ったimageデータをもとにダウンロードし、storageに保存する。
    }

}
