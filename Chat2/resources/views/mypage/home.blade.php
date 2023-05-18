@extends('layouts.chatapp')

@section('title','Home')

@section('content')
    <a href="../mypage/login">to Login Screen...</a><br>
    <a href="member_delete"　 class="deletion">Account Deletion</a>&nbsp;
    <p>Hi, {{$member['name']}}! Please write messages!</p>
    <form action="post" method="post">
    {{csrf_field()}}
        <textarea name="message" cols="50" rows="5"></textarea>
        <input type="hidden" name="member_id" value="{{$member['id']}}"><br>
        <input type="submit" value="POST">
    </form>
    
    @if(count($errors)>0)
    <div>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        <ul>
    </div>
    @endif
    <hr>
    @if(isset($posts))
    @foreach($posts as $post)
        <img src="../storage/member_images/{{$post->member->image}}" width='48' height='48' align='left'>
        <p>({{$post->member->name}})
            <br>
            {{$post->message}}<span class="message"></span></p>
        <a href="post_indivisual?post_id={{$post->id}}" class='sub'>{{$post->created_at}}</a>
        
        @if($post->reply_post_id!=0)
            <a href="post_indivisual?post_id={{$post->reply_post_id}}" class="sub">返信もとへ</a>
        @endif
        @if($post->member_id==$member['id'])
        <a class="deletion" href="post_delete?post_id={{$post->id}}">Deletion</a>&nbsp;
        @endif
        <hr>
    
    @endforeach
    {{$posts->links()}}
    @endif
@endsection

@section('footer')
copyright 2023 yamaguchi.
@endsection