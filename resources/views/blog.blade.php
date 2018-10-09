@extends('layouts.master')
@section('content')
    <div class="title m-b-md">
        Raising the bar
    </div>
    <a href="{{ route('user.logout') }}">
        <button type="button" class="btn btn-outline-primary">Đăng Xuất</button>
    </a>

    <p>User đang đăng nhập </p>
    {{ $userLog }}
    <hr>

    <p> Bạn đang xem lần thứ: </p>
    <?php
    $sessionView = Session::get('login');
   echo count($sessionView);
    ?>


@endsection