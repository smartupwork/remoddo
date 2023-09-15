@extends('main.layouts.main-auth')
@section('title') Login @endsection

@section('content')



    <div class="login-page">
        <div class="login-page__content">
            <div class="container container-xl">

                <div class="login-page__content-body">
                    <div class="login-page__head">
                        <a href="{{route('main.home')}}" class="logo">
                            <img src="{{asset('main/img/icons/Remoddo-logo.svg')}}" alt="">
                        </a>

                    </div>
                    <div class="login-page__body">
                        <form  method="post" action="{{route('main.security.login')}}" class="form-login" >
                            @csrf
                            <h3 class="mb-4 ttu w-100">Login</h3>
                            <p class="mb-40 w-100">Welcome back! Please enter your details.</p>
                            @if($errors->has('invalid_auth'))
                                <span class="text-danger">{{$errors->first('invalid_auth')}}</span>
                            @endif
                            <div class="input-wrap mb-20 w-100">
                                <label class="label-custom ttu">Email</label>
                                <input class="input mb-1" type="text" name="email" value="{{old('email')}}" placeholder="tim.jennings@example.com">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="input-wrap mb-40 w-100">
                                <label class="label-custom ttu">Password</label>
                                <input class="input mb-1" name="password" type="password" placeholder="••••••••••••••••••••••••">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn--dark btn--md radius-3 mb-4 w-100 ttu">Login</button>
                            {{-- <a href="{{route('main.security.google-login')}}" class="btn btn--outline outlie-dark btn--md radius-3 w-100">
                                <img src="{{asset('main/img/icons/logos_google-icon.svg')}}" alt="">
                                <span class="ms-3">Login with Google</span>
                            </a> --}}
                        </form>
                        <p class="text-center">Don’t have an account yet? <a href="{{route('main.security.registration.form')}}" class="fw-700">Sign Up</a></p>
                        <p class="text-center"><a href="{{route('forget.password.get')}}" class="fw-700">Forgot Password</a></p>
                    </div>
                </div>
            </div>
        </div>
     @include('main.sections.pages.security.slider')
    </div>
@endsection
