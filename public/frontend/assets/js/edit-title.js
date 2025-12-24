document.addEventListener("DOMContentLoaded", function () {
    const titleFeatures = document.getElementById("title-features");
    const titleTestimonials = document.getElementById("title-testimonials");
    const titleAnswers = document.getElementById("title-answers");

    function saveChanges(element) {
        let titleId = element.dataset.id;
        let field =
            element.id === "title-features" ?
                "features" :
                element.id === "title-testimonials" ?
                    "testimonials" :
                    element.id === "title-answers" ?
                        "answers" : '';

        let newValue = element.innerText.trim();

        fetch(`/admin/edit-titles/${titleId}`, { // ✅ fixed URL
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                [field]: newValue
            }),
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Request failed");
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    console.log(`${field} title updated successfully`);
                }
            })
            .catch(error => console.error("Error:", error));
    }

    // Save on blur
    titleFeatures.addEventListener("blur", () => saveChanges(titleFeatures));
    titleTestimonials.addEventListener("blur", () => saveChanges(titleTestimonials));
    titleAnswers.addEventListener("blur", () => saveChanges(titleAnswers));

    // Save on Enter key (only editable fields)
    document.addEventListener("keydown", function (e) {
        if (
            e.key === "Enter" &&
            (e.target.id === "title-features" || e.target.id === "title-testimonials" || e.target
                .id === "title-answers")
        ) {
            e.preventDefault();
            saveChanges(e.target);
        }
    });
});