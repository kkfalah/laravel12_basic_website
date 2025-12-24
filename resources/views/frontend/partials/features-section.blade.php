<div class="lonyo-section-padding2 position-relative">
    <div class="container">
        <div class="lonyo-section-title center">
            <h2 id="title-features" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $title->id }}" >{{ $title->features }}</h2>
        </div>
        <div class="row">

            @foreach ($features as $key => $item)
                
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="lonyo-service-wrap light-bg" data-aos="fade-up" data-aos-duration="500">
                        <div class="lonyo-service-title">
                            <h4>{{ $item->title }}</h4>
                            <img 
                            src="{{ !empty($item->image) ? Storage::url($item->image) : asset('backend/assets/images/default-image.jpg') }}" 
                            alt="{{ $item->title }}">
                        </div>
                        <div class="lonyo-service-data">
                            <p>{{ $item->description }}</p>
                        </div>
                    </div>
                </div>

            @endforeach
            
        </div>
    </div>
    <div class="lonyo-feature-shape"></div>
</div>
