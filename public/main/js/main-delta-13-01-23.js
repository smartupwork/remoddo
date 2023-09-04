let stars = document.querySelectorAll(".star");
// document.querySelector(".stars-container").addEventListener("click", starRating);
stars.forEach(el => el.addEventListener("click", starRating))
function starRating(e) {
    stars.forEach((star) => star.classList.remove("star--checked"));
    const i = [...stars].indexOf(e.currentTarget);
    if (i > -1) {
        stars[i].classList.add("star--checked");
    }
}
