<div class="lonyo-section-padding4 position-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 order-lg-2">
                <div class="lonyo-content-thumb" data-aos="fade-up" data-aos-duration="700">
                    <img 
                    src="{{ !empty($midSectionTwo->image) ? Storage::url($midSectionTwo->image) : asset('frontend/assets/images/v1/content-thumb2.png') }}"
                    alt="">
                </div>
            </div>
            <div class="col-lg-7 d-flex align-items-center">
                <div class="lonyo-default-content pr-50" data-aos="fade-right" data-aos-duration="700">
                    <h2>{{ $midSectionTwo->title }}</h2>
                    <p class="data">{{ $midSectionTwo->description }}</p>
                    <div class="mt-50">
                        <ul class="tabs">
                            <li class="active-tab">
                                <img src="{{ asset('frontend') }}/assets/images/v1/tv.svg" alt="">
                                <h4>{{ $midSectionTwo->sub_title1 }}</h4>
                            </li>
                            <li>
                                <img src="{{ asset('frontend') }}/assets/images/v1/alerm.svg" alt="">
                                <h4>{{ $midSectionTwo->sub_title2 }}</h4>
                            </li>
                        </ul>
                        <ul class="tabs-content">
                            <li>
                                {{ $midSectionTwo->sub_description1 }}
                            </li>
                            <li>
                                {{ $midSectionTwo->sub_description2 }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lonyo-content-shape2"></div>
</div>
