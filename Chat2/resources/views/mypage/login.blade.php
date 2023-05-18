@extends('layouts.chatapp')

@section('title','Login')

@section('content')
    <ul><a href="../member/add">New Registration</a></ul>
    @if (isset($mess))
    {{$mess}}
    @endif
    <form action="../mypage/home" method=post> <!-- ここ「/」の有無が大事 !-->
        <table>
            {{csrf_field()}}
            <tr><th></th><td>please enter your address and password.</td></tr>
            <tr><th>mail:</th><td><input type="text" name="mail"></td></tr>
            <tr><th>password:</th><td><input type="password" name="password"></td></tr>
            <tr><th></th><td><input type="submit" value="LOGIN"></td></tr>
        </table>
    </form>
    
@endsection

@section('footer')
copyright 2023 yamaguchi.
@endsection