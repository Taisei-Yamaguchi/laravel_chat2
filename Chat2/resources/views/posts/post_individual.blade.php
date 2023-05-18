@extends('layouts.chatapp')

@section('title','Reply')

@section('content')
    
<a href="home">to Mypage...</a>
<div class="msg">
        <img src="../storage/member_images/{{$main_post->member->image}}" width='48' height='48' align='left'>
        <p>{{$main_post->message}}<span class="message">({{$main_post->member->name}})</span></p>
            <div class="sub">{{$main_post->created_at}}</div>
        @if($main_post->member_id==$member['id'])
        <a class="deletion" href="post_delete?post_id={{$main_post->id}}">Deletion</a>&nbsp;
        @endif
        <hr>
    </div>

    <form action="reply" method="post" enctype="multipart/form-data"> <!-- ここ「/」の有無が大事 !-->
        <table>
            {{csrf_field()}}
            
            <textarea name="message" cols="50" rows="5" placeholder="@({{$main_post->member->name}})&nbsp;{{$main_post->message}}"></textarea>
            <input type="hidden" name="reply_post_id" value="{{$main_post->id}}">
            <input type="hidden" name="member_id" value="{{$member['id']}}">
            <br>
            <input type="submit" value="POST">
        </table>
    </form>
    <hr>

    @if(isset($reply_posts))
    @foreach($reply_posts as $post)
    <div class="msg">
        <img src="../storage/member_images/{{$post->member->image}}" width='48' height='48' align='left'>
        <p>
        ({{$post->member->name}})
        <br>
        {{$post->message}}
        <span class="message"></span>
        </p>
        
            <a href="post_indivisual?post_id={{$post->id}}" class='sub'>{{$post->created_at}}</a>

        @if($post->member_id==$member['id'])
            <a class="deletion" href="post_delete?post_id={{$post->id}}">Deletion</a>&nbsp;
        @endif
        <hr>
    </div>
    @endforeach
    {{$reply_posts->links()}}
    @endif
@endsection

@section('footer')
copyright 2023 yamaguchi.
@endsection