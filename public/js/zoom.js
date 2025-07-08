document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("imageModal");
    const modalImage = document.getElementById("modalImage");
    const closeModal = document.querySelector(".close");
    let zoomed = false;

    document.querySelectorAll(".clickable-img").forEach((image) => {
        image.addEventListener("click", function () {
            modal.style.display = "flex";
            modalImage.src = this.src;
            modalImage.style.transform = "scale(1)";
            zoomed = false;
        });
    });

    closeModal.addEventListener("click", () => {
        modal.style.display = "none";
    });

    modalImage.addEventListener("click", () => {
        zoomed = !zoomed;
        modalImage.style.transform = zoomed ? "scale(2)" : "scale(1)";
        modalImage.style.cursor = zoomed ? "zoom-out" : "zoom-in";
    });

    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });
});
