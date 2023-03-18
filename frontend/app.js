// Image carousel1 javascript
var slides = document.querySelectorAll(".slide");
var btns = document.querySelectorAll(".btn");
let currentSlide = 1;

// Javascript for image slider manual navigation
var manualNav = function (manual) {
    slides.forEach((slide) => {
        slide.classList.remove("active");

        btns.forEach((btn) => {
            btn.classList.remove("active");
        });
    });

    slides[manual].classList.add("active");
    btns[manual].classList.add("active");
};

btns.forEach((btn, i) => {
    btn.addEventListener("click", () => {
        manualNav(i);
        currentSlide = i;
    });
});

// Javascript for image slider autoplay navigation
var repeat = function (activeClass) {
    let active = document.getElementsByClassName("active");
    let i = 1;

    var repeater = () => {
        setTimeout(function () {
            [...active].forEach((activeSlide) => {
                activeSlide.classList.remove("active");
            });

            slides[i].classList.add("active");
            btns[i].classList.add("active");
            i++;

            if (slides.length == i) {
                i = 0;
            }
            if (i >= slides.length) {
                return;
            }
            repeater();
        }, 10000);
    };
    repeater();
};
repeat();

// second image carousel
var slides2 = document.querySelectorAll(".slide2");
var btns2 = document.querySelectorAll(".btn2");
let currentSlide2 = 1;

// Javascript for image slider manual navigation
var manualNav2 = function (manual2) {
    slides2.forEach((slide) => {
        slide.classList.remove("active2");

        btns2.forEach((btn) => {
            btn.classList.remove("active2");
        });
    });

    slides2[manual2].classList.add("active2");
    btns2[manual2].classList.add("active2");
};

btns2.forEach((btn, i) => {
    btn.addEventListener("click", () => {
        manualNav2(i);
        currentSlide2 = i;
    });
});

// Javascript for image slider autoplay navigation
var repeat2 = function (activeClass) {
    let active2 = document.getElementsByClassName("active");
    let i2 = 1;

    var repeater2 = () => {
        setTimeout(function () {
            [...active2].forEach((activeSlide) => {
                activeSlide.classList.remove("active2");
            });

            slides2[i].classList.add("active2");
            btns2[i].classList.add("active2");
            i2++;

            if (slides2.length == i) {
                i = 0;
            }
            if (i2 >= slides2.length) {
                return;
            }
            repeater();
        }, 10000);
    };
    repeater();
};
repeat();

// Navbar
const body = document.querySelector("body");
const navbar = document.querySelector(".navbar");
const menuBtn = document.querySelector(".menu-btn");
const cancelBtn = document.querySelector(".cancel-btn");
menuBtn.onclick = () => {
    navbar.classList.add("show");
    menuBtn.classList.add("hide");
    body.classList.add("disabled");
};
cancelBtn.onclick = () => {
    body.classList.remove("disabled");
    navbar.classList.remove("show");
    menuBtn.classList.remove("hide");
};
window.onscroll = () => {
    this.scrollY > 20
        ? navbar.classList.add("sticky")
        : navbar.classList.remove("sticky");
};

// DropDown Menu

document.addEventListener("click", (e) => {
    const isDropdownButton = e.target.matches("[data-dropdown-button]");
    if (!isDropdownButton && e.target.closest("[data-dropdown]") != null) return;

    let currentDropdown;
    if (isDropdownButton) {
        currentDropdown = e.target.closest("[data-dropdown]");
        currentDropdown.classList.toggle("active");
    }

    document.querySelectorAll("[data-dropdown].active").forEach((dropdown) => {
        if (dropdown === currentDropdown) return;
        dropdown.classList.remove("active");
    });
});

// Back To Top Button
const showOnPx = 100;
const backToTopButton = document.querySelector(".back-to-top");
const pageProgressBar = document.querySelector(".progress-bar");

const scrollContainer = () => {
    return document.documentElement || document.body;
};

const goToTop = () => {
    document.body.scrollIntoView({
        behavior: "smooth",
    });
};

document.addEventListener("scroll", () => {
    // console.log("Scroll Height: ", scrollContainer().scrollHeight);
    // console.log("Client Height: ", scrollContainer().clientHeight);

    const scrolledPercentage =
        (scrollContainer().scrollTop /
            (scrollContainer().scrollHeight - scrollContainer().clientHeight)) *
        100;

    pageProgressBar.style.width = `${scrolledPercentage}%`;

    if (scrollContainer().scrollTop > showOnPx) {
        backToTopButton.classList.remove("hidden");
    } else {
        backToTopButton.classList.add("hidden");
    }
});

backToTopButton.addEventListener("click", goToTop);



// Products Button -> Products
// const productButton = document.querySelectorAll(".bg-content a");