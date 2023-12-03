$(document).ready(function () {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        dots: false,
        lazyLoad: true,
        autoplay: true,
        autoplayTimeout: 5000,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 5,
                nav: true,
                loop: false
            }
        }
    })

    $("#color1").click(function(){
        $("#icon-check1").addClass("fa-solid fa-check pd-icon--check");
        $("#icon-check2").removeClass("fa-solid fa-check pd-icon--check");
    });
    $("#color2").click(function(){
        $("#icon-check2").addClass("fa-solid fa-check pd-icon--check");
        $("#icon-check1").removeClass("fa-solid fa-check pd-icon--check");
    });
});


// Show Password

document.addEventListener('DOMContentLoaded', function () {
    var passwordInput = document.getElementById('password');
    var togglePassword = document.querySelector('.showpassword i');

    togglePassword.addEventListener('click', function () {
        var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.classList.toggle('fa-eye');
        togglePassword.classList.toggle('fa-eye-slash');
    });
});


// Loader page

window.addEventListener("load", () => {
    const loader = document.querySelector(".loader-box");

    loader.classList.add("loader-box-hidden");

    loader.addEventListener("transitionend", () => {
        document.body.removeChild("loader-box");
    })
})

