 <div class="col-md-5 col-sm-12 col-12 d-flex">
        <div class="card bg-light d-flex flex-fill w-100">
            <div class="card-header text-muted border-bottom-0">
                {{$user->roleName}}
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-8">
                        <h2 class="lead"><b>{{$user->info->full_name}}</b></h2>
                        <p class="text-muted text-sm"><b>About: </b> {{$user->info->about}}</p>
                        <ul class="ml-4 mb-0 fa-ul text-muted" id="user_info" data-url="{{route('admin.user.update',['user'=>$user->id])}}">
                            <li class="small">
                                <div>
                                    <span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                    <span>Address:</span>
                                </div>

                                <div class="input-group mb-3 input-save">
                                    <input type="text" name="address" class="form-control focus-none" value="{{$user->info->address}}">

                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary btn-edit w-50 p-0 radius-5">
                                            <i class="fas fa-edit fs-14"></i>
                                        </button>

                                        <button type="button"  class="btn btn-success btn-save w-50 p-0 radius-5">
                                            <i class="fas fa-save fs-14"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li class="small">
                                <div>
                                    <span class="fa-li"><i class="fas fa-envelope"></i></span>
                                    <span>Email:</span>
                                </div>


                                <div class="input-group mb-3 input-save">
                                    <input type="text" name="email" class="form-control focus-none" value="{{$user->email}}">

                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary btn-edit w-50 p-0 radius-5">
                                            <i class="fas fa-edit fs-14"></i>
                                        </button>

                                        <button type="button" class="btn btn-success btn-save w-50 p-0 radius-5">
                                            <i class="fas fa-save fs-14"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-4 text-center">
                        <img src="{{asset($user->info->avatar)}}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">


                        <a href="#" class="btn btn-sm btn-warning user-lock lock-action @if(!$user->info->is_blocked) d-none @endif"
                           data-url="{{route('admin.user.update-status',['user'=>$user->id])}}"
                           >
                            <i class="fas fa-lock"></i> Block
                        </a>

                        <a href="#" class="btn btn-sm btn-primary user-unlock lock-action @if($user->info->is_blocked) d-none @endif"
                           data-url="{{route('admin.user.update-status',['user'=>$user->id])}}"
                           >
                            <i class="fas fa-lock-open"></i> Unlock
                        </a>

                </div>
            </div>
        </div>
    </div>
 @push('scripts')
     <script src="{{asset('js/admin/user-block.js')}}"></script>
 @endpush
