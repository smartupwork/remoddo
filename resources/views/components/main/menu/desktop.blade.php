<nav class="header__menu">
    <ul class="header__list mb-0">
       @foreach($headerMenus as $menu)
        <li class="header__list__item @if($menu->link==url()->current()) header--item-active @endif">
            <a href="{{ url($menu->link) }}" class="header__link">
                        <span class="info fw-800 lh-20">
                           {{$menu->title}}
                        </span>
            </a>
        </li>
        @endforeach
    </ul>
</nav>
