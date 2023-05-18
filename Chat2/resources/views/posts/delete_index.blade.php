@extends('layouts.chatapp')

@section('title','Delete')

@section('content')
    
<a href="home">to Mypage...</a>
<p>Do you want to delete this post?</p>
    <form action="post_delete" method="post" enctype="multipart/form-data"> <!-- ここ「/」の有無が大事 !-->
        <table>
            {{csrf_field()}}
            <tr><th>Name:</th><td>{{$post->message}}</td></tr>
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <tr><th></th><td><input type="submit" value="DELETE"></td></tr>
        </table>
    </form>
@endsection

@section('footer')
copyright 2023 yamaguchi.
@endsection