@extends('main.layouts.main-auth')


@section('title') Registration @endsection

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
                        <form method="post" enctype="multipart/form-data"
                              action="{{route('main.security.registration')}}" class="form-login">
                            @csrf
                            <h3 class="mb-4 ttu w-100">Create an Account</h3>
                            <p class="mb-40 w-100">Please enter your details.</p>
                            <div class="row">
                                <div class="col-ms-6">
                                    <div class="input-wrap mb-20 w-100">
                                        <label class="label-custom ttu">First Name</label>
                                        <input class="input" type="text" name="name" value="{{old('name')}}" placeholder="Jane">
                                        @error('name')
                                         <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-ms-6">
                                    <div class="input-wrap mb-20 w-100">
                                        <label class="label-custom ttu">Last Name</label>
                                        <input class="input" name="surname" value="{{old('surname')}}" type="text" placeholder="Smith">
                                        @error('surname')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="input-wrap mb-20 w-100">
                                <label class="label-custom ttu">Email</label>
                                <input class="input" type="text" name="email" value="{{old('email')}}" placeholder="tim.jennings@example.com">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input-wrap mb-20 w-100">
                                <label class="label-custom ttu">Password</label>
                                <input class="input" name="password"  type="password" placeholder="••••••••••••••••••••••••">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input-wrap mb-40 w-100">
                                <label class="label-custom ttu">Confirm Password</label>
                                <input class="input" name="password_confirmation" type="password" placeholder="••••••••••••••••••••••••">
                                @error('password_confirmation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <button  class="btn btn--dark btn--md radius-3 mb-4 w-100 ttu">Registration</button>
                            <a href="{{route('main.security.google-login')}}" class="btn btn--outline outlie-dark btn--md radius-3 w-100">
                                <img src="{{asset('main/img/icons/logos_google-icon.svg')}}" alt="">
                                <span class="ms-3">Sign Up with Google</span>
                            </a>
                        </form>
                        <p class="text-center">Already have an account?  <a href="{{route('main.security.login.form')}}" class="fw-700">Login</a></p>
                    </div>
                </div>
            </div>
        </div>

        @include('main.sections.pages.security.slider')
    </div>

@endsection
