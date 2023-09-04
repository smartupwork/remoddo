@extends('main.layouts.main-auth')
@section('title','Forget Password')

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
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form method="post" action="{{route('forget.password.post')}}" class="form-login">
                            @csrf
                            <h3 class="mb-4 ttu w-100">Forget Password</h3>

                            <div class="input-wrap mb-20 w-100">
                                <label class="label-custom ttu">Email</label>
                                <input class="input mb-1" type="text" name="email" value="{{old('email')}}"
                                       placeholder="tim.jennings@example.com">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn--dark btn--md radius-3 mb-4 w-100 ttu">Submit</button>
                            <p class="text-center">Already have an account? <a
                                    href="{{route('main.security.login.form')}}" class="fw-700">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('main.sections.pages.security.slider')
    </div>
@endsection
