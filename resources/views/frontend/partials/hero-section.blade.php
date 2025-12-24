<div class="lonyo-hero-section light-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 d-flex align-items-center">
                <div class="lonyo-hero-content" data-aos="fade-up" data-aos-duration="700">
                    <h1 id="slider-title" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $sliders->id }}" class="hero-title">{{ $sliders->title }}</h1>
                    <p id="slider-description" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $sliders->id }}" class="text">{{ $sliders->description }}</p>
                    <div class="mt-50" data-aos="fade-up" data-aos-duration="900">
                        <a href="{{ $sliders->link }}" class="lonyo-default-btn hero-btn">Start Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="lonyo-hero-thumb" data-aos="fade-left" data-aos-duration="700">
                    <img 
                    src="{{ !empty($sliders->image) ? Storage::url($sliders->image) : asset('frontend/assets/images/hero-thumb.png') }}"
                        alt="">
                    <div class="lonyo-hero-shape">
                        <img src="{{ asset('frontend/assets/images/shape/hero-shape1.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
document.addEventListener("DOMContentLoaded", function () {
    const titleElement = document.getElementById("slider-title");
    const descriptionElement = document.getElementById("slider-description");

    function saveChanges(element) {
        let sliderId = element.dataset.id;
        let field = element.id === "slider-title" ? "title" : "description";
        let newValue = element.innerText.trim();

        fetch(`/admin/edit-sliders/${sliderId}`, { // ✅ fixed URL
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ [field]: newValue }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Request failed");
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                console.log(`${field} updated successfully`);
            }
        })
        .catch(error => console.error("Error:", error));
    }

    // Save on blur
    titleElement.addEventListener("blur", () => saveChanges(titleElement));
    descriptionElement.addEventListener("blur", () => saveChanges(descriptionElement));

    // Save on Enter key (only editable fields)
    document.addEventListener("keydown", function (e) {
        if (
            e.key === "Enter" &&
            (e.target.id === "slider-title" || e.target.id === "slider-description")
        ) {
            e.preventDefault();
            saveChanges(e.target);
        }
    });
});
</script>

