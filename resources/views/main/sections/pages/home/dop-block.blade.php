<section class="section pb-70">
    <div class="container">
        <div class="row gutters-70 mb--30">
            <div class="col-lg-6 col-md-6 mb-30 d-flex">
                <div class="design-card p-70 w-100">
                    <div class="design-card--container">
                        <h3 class="heading fw-900 -ttu">
                            <span class="info">{{ $page->show("how_it_works:title") }}</span>
                        </h3>
                        <div class="mt-20">
                            <p class="def-text def-text-2">
                                {{ $page->show("how_it_works:text") }}
                            </p>
                        </div>
                        <div class="mt-30">
                            <a href="{{ $page->show("how_it_works:url") }}" class="btn btn--warning btn--sm fw-800 radius-3 ttu">
                                <span class="info">
                                    {{ $page->show("how_it_works:button") }}
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-30 d-flex">
                <div class="design-card p-70 w-100">
                    <div class="design-card--container">
                        <h3 class="heading fw-900 -ttu">
                            <span class="info">{{ $page->show("faq:title") }}</span>
                        </h3>
                        <div class="mt-20">
                            <p class="def-text def-text-2">
                                {{ $page->show("faq:text") }}
                            </p>
                        </div>
                        <div class="mt-30">
                            <a href="{{ $page->show("faq:url") }}" class="btn btn--warning btn--sm fw-800 radius-3 ttu">
                                <span class="info">
                                    {{ $page->show("faq:button") }}
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
