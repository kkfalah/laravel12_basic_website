<section class="lonyo-cta-section bg-heading">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="lonyo-cta-thumb" data-aos="fade-up" data-aos-duration="500">
                    <img id="ctaImage" class="cursor-pointer w-full"
                    src="{{ !empty($cta->image) ? Storage::url($cta->image) : asset('frontend/assets/images/v1/cta-thumb.png') }}"
                    alt="{{ $cta->title }}">
                    @if (auth()->check())
                        <input type="file" id="uploadImage" style="display:none" />
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="lonyo-default-content lonyo-cta-wrap" data-aos="fade-up" data-aos-duration="700">
                    <h2  class="editable-title-cta" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $cta->id }}">{{ $cta->title }}</h2>
                    <p class="editable-description-cta" contenteditable="{{ auth()->check() ? 'true' : 'false' }}"
                        data-id="{{ $cta->id }}">{{ $cta->description }}</p>
                    <div class="lonyo-cta-info mt-50" data-aos="fade-up" data-aos-duration="900">
                        <ul>
                            <li>
                                <a href="https://www.apple.com/app-store/"><img
                                        src="{{ asset('frontend') }}/assets/images/v1/app-store.svg" alt=""></a>
                            </li>
                            <li>
                                <a href="https://playstore.com/"><img
                                        src="{{ asset('frontend') }}/assets/images/v1/play-store.svg"
                                        alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
document.addEventListener("DOMContentLoaded", function () {

    function saveChanges(element) {
        let ctaId = element.dataset.id;
        let field = element.classList.contains("editable-title-cta") ? "title" : "description";
        let newValue = element.innerText.trim();

        fetch(`/admin/update-cta/${ctaId}`, { 
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

    

    // Save on Enter key (only editable fields)
    document.addEventListener("keydown", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            saveChanges(e.target);
        }
    });

    // Save on blur
    document.querySelectorAll(".editable-title-cta, .editable-description-cta").forEach(el=>{
        el.addEventListener("blur", function() {
            saveChanges(el);
        });
    });

    // Image upload
    let ctaImageElement = document.getElementById("ctaImage");
    let uploadInputElement = document.getElementById("uploadImage");

    ctaImageElement.addEventListener("click", function() {
        @if (auth()->check())
            uploadInputElement.click();
        @endif
    });

    uploadInputElement.addEventListener("change", function() {
        let file = this.files[0];
        if(!file) return;

        let formData = new FormData();
        formData.append("image", file);
        formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute("content"));

        fetch(`/admin/update-cta-image/1`, { 
            method: "POST",
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Request failed");
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                ctaImageElement.src = data.image_url;
                console.log(`Image updated successfully`);
            }
        })
        .catch(error => console.error("Error:", error));

    });

});
</script>