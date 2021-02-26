@extends('layouts.home')

@section('content')
    <div class="wrapper">
        <div class="container">
            <h1 style="color: #fff">Welcome to the task list program</h1>
            <form class="form" method="POST" action="{{ route('login') }}">
                @csrf
                <input id="email" name="email" type="email" placeholder="Email" class="" value="{{ old('email') }}" required autofocus>
                <input id="password" name="password" type="password" placeholder="Password" class="" value="{{ old('password') }}" required autofocus>
                <button type="submit" id="login-button">Login</button>
            </form>
            <p class="register_text">If you don't have account you can <a href="{{route('register')}}">register.</a></p>

            {{--alert--}}
            <div class="alert-home alert alert-danger alert-dismissible fade" role="alert">
                <strong>Error!</strong> <span class="text-err">You should check in on some of those fields below.</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

        </div>

        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
@endsection
