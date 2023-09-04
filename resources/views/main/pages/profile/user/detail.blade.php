@extends('main.layouts.main')
@section('wrapper_class')
    pt-header
@endsection
@section('title') Profile Detail @endsection

@section('content')
        <div class="container container-xl">
            <div class="category-page">
                @include('main.sections.pages.profile.user.sidebar')
                <div class="category-page__content">
                    <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                        <h3 class="ttu fw-800 pe-4 mb-4">My Details</h3>
                    </div>
                    <div class="border-card">
                        <div class="max-w-630">
                            <h5 class="fw-800 ttu mb-4px">Personal Info</h5>
                            <p class="fsz-14 mb-30 detail-message">Update your photo and personal details here</p>
                            <div class="change_avatar_block mb-20 avatar_section">

                                <div class="avatar_wrpr">
                                    <img src="{{asset($user->info->avatar)}}" alt="">
                                </div>


                                <label class="btn btn--dark btn--md radius-3 ttu">
                                    Change Photo
                                    <input type="file" name="avatar" id="avatar" class="d-none">
                                </label>

                            </div>
                            <span class="error-detail error-avatar error-message"></span>

                            <div class="input-colums">
                                <div class="input-wrap input-col-6 mb-20">
                                    <label class="label-custom">First Name</label>
                                    <input class="input name" name="name" type="text" value="{{$user->info->name}}">
                                    <span class="error-detail error-name error-message"></span>
                                </div>

                                <div class="input-wrap input-col-6 mb-20">
                                    <label class="label-custom">Last NAme</label>
                                    <input class="input surname" name="surname" type="text" value="{{$user->info->surname}}">
                                    <span class="error-detail error-surname error-message"></span>
                                </div>
                            </div>
                            <div class="input-wrap mb-30">
                                <label class="label-custom">Email</label>
                                <input class="input email" name="email" type="text" value="{{$user->email}}">
                                <span class="error-detail error-email error-message"></span>
                             </div>
                            <div class="mb-30 pb-30 border-bottom">
                                <button data-url="{{route('main.profile.user.update.detail')}}" class="btn btn--warning update-user-detail btn--md radius-3 ttu">Save Changes</button>
                            </div>

                            <h5 class="fw-800 ttu mb-4px">Password</h5>
                            <p class="fsz-14 mb-30 password-message">Please enter your current password to change your password</p>
                            <div class="input-colums">
                                <div class="input-wrap input-col-6 mb-20">
                                    <label class="label-custom">Current Password</label>
                                    <input class="input password" type="password" name="password" placeholder="••••••••••••••••••••••">
                                    <span class="error-user error-password error-message"></span>
                                </div>

                            </div>
                            <div class="input-colums mb-10">
                                <div class="input-wrap input-col-6 mb-20">
                                    <label class="label-custom">New Password</label>
                                    <input class="input new_password" type="password" name="new_password" placeholder="••••••••••••••••••••••">
                                    <span class="error-user error-new_password error-message"></span>
                                </div>

                                <div class="input-wrap input-col-6 mb-20">
                                    <label class="label-custom">Confirm Password</label>
                                    <input class="input new_password_confirmation" type="password" name="new_password_confirmation" placeholder="••••••••••••••••••••••">
                                    <span class="error-user error-new_password_confirmation error-message"></span>
                                </div>

                            </div>

                            <div>
                                <button data-url="{{route('main.profile.user.update.password')}}" class="btn update-user-password btn--warning btn--md radius-3 ttu">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
    <script src="{{asset('main/js/update-user-detail.js')}}"></script>
    <script src="{{asset('main/js/update-user-password.js')}}"></script>
@endpush
