@extends('layouts.chatapp')

@section('title','Register')

@section('content')
    <ul><a href="../mypage/login">to Login screen...</a></ul>
    
    <form action="add" method="post" enctype="multipart/form-data"> <!-- ここ「/」の有無が大事 !-->
        <table>
            {{csrf_field()}}
            <tr><th></th><td>Please enter your registration information.</td></tr>
            <tr><th>Name:</th><td><input type="text" name="name" value="{{old('name')}}"></td></tr>
            <tr><th>mail:</th><td><input type="text" name="mail" value="{{old('mail')}}"></td></tr>
            <tr><th>password:</th><td><input type="password" name="password"><br>
                <input type="password" name="password2">*please enter the same password for confirmation.</td></tr>
            <tr><th>Image:</th><td><input type="file" name="image"></td></tr>
            <tr><th></th><td><input type="submit" value="REGISTER"></td></tr>
        </table>
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
    @if (isset($error_others))
    <div><ul>
        @foreach($error_others as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul></div>
    @endif
@endsection

@section('footer')
copyright 2023 yamaguchi.
@endsection