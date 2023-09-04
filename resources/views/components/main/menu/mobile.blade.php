<ul class="header__list mb-0">
    @foreach($headerMenus as $menu)
    <li class="header__list__item">
        <a href="{{$menu->link}}" class="header__link">
                     <span class="info fw-800 def-text-2 -ttu">
                       {{$menu->title}}
                     </span>
        </a>
    </li>
    @endforeach
</ul>
