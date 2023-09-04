
@switch(request()->session()->get('user_role'))
    @case('lender')
      @include('main.sections.pages.profile.lender.sidebar',['role'=>request()->session()->get('user_role')])
    @break
    @case('renter')
    @include('main.sections.pages.profile.renter.sidebar',['role'=>request()->session()->get('user_role')])
    @break
    @default
    @include('main.sections.pages.profile.renter.sidebar',['role'=>request()->session()->get('user_role')])
@endswitch
