<section class="what-is bg-light-blue">
    <div class="what-is__image">
        <img src="{{ $page->show("what_is_our_mission:image") }}" alt="{{ $page->show("what_is_our_mission:title") }}">
    </div>
    <div class="what-is__content">
        <div class="container">
            <div class="what-is__body">
                <div class="what-is__text">
                    <h2 class="mb-20 ttu fw-900">{{ $page->show("what_is_our_mission:title") }}</h2>
                    <p class="mb-40 def-text def-text-2">{{ $page->show("what_is_our_mission:text") }}</p>
                    <a href="{{ $page->show("what_is_our_mission:url") }}" class="btn btn--warning btn--sm fw-800 radius-3 ttu">
                        <span class="info">
                            {{ $page->show("what_is_our_mission:button") }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
