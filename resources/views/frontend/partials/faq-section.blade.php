<div class="lonyo-section-padding4">
    <div class="container">
        <div class="lonyo-section-title center">
            <h2 id="title-answers" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                data-id="{{ $title->id }}">{{ $title->answers }}</h2>
        </div>
        <div class="lonyo-faq-shape"></div>
        <div class="lonyo-faq-wrap1">
            @foreach ($faq as $key => $item)
            <div class="lonyo-faq-item item2 @if ($key == 0)
                open
            @endif" data-aos="fade-up" data-aos-duration="500">
                <div class="lonyo-faq-header">
                    <h4>{{ $item->question }}</h4>
                    <div class="lonyo-active-icon">
                        <img class="plasicon" src="{{ asset('frontend') }}/assets/images/v1/mynus.svg" alt="">
                        <img class="mynusicon" src="{{ asset('frontend') }}/assets/images/v1/plas.svg" alt="">
                    </div>
                </div>
                <div class="lonyo-faq-body body2">
                    <p>{{ $item->answer }}</p>
                </div>
            </div>
            @endforeach
            
        </div>
        <div class="faq-btn" data-aos="fade-up" data-aos-duration="700">
            <a class="lonyo-default-btn faq-btn2" href="{{ route('contact') }}">Can't find your answer</a>
        </div>
    </div>
</div>


