const inputs = document.querySelectorAll(".input");

function addcl() {
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

function remcl() {
    let parent = this.parentNode.parentNode;
    if (this.value == "") {
        parent.classList.remove("focus");
    }
}

inputs.forEach((input) => {
    input.addEventListener("focus", addcl);
    input.addEventListener("blur", remcl);
    if (input.value != "") {
        let parent = input.parentNode.parentNode;
        parent.classList.add("focus");
        console.log("tes");
    }
});
$(".input.is-invalid").change(function () {
    $(".input.is-invalid").removeClass("is-invalid");
});
var scroll_top = $(".scroll-custom").scrollTop();
$("a").on("click", function (event) {
    var hash = this.hash;
    if (this.hash !== "") {
        event.preventDefault();
        var pass = 0;
        if ($(hash).attr("pass") != undefined) {
            pass = $(hash).attr("pass");
        }
        console.log(hash);
        scroll_top = scroll_top + $(hash).offset().top - 70;
        if (scroll_top < 1) {
            scroll_top = 0;
        }
        $(".scroll-custom").animate(
            {
                scrollTop: scroll_top,
            },
            1000,
            function () {
                // window.location.hash = hash;
            }
        );
    }
});
$(".scroll-custom").scrollspy({
    target: "#navbarNavDropdown",
    offset: 100,
});
