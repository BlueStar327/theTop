var header = document.getElementsByTagName("header")[0];
var main = document.getElementsByTagName("main")[0];

window.addEventListener('scroll', function() {
    if(this.window.pageYOffset > 30)
    {
        header.classList.add("scroll");
        main.classList.add("scroll");
    }
    else 
    {
        header.classList.remove("scroll");
        main.classList.remove("scroll");
    }
});

var reservation = document.getElementsByClassName("reservation")[0];
var input_modal_box = document.getElementsByClassName("input_modal_box")[0];

if(reservation)
    reservation.addEventListener("click", () => {
        if(input_modal_box)
            input_modal_box.classList.add("active");
    })

var cancel = document.getElementsByClassName("cancel")[0];
if(cancel)
    cancel.addEventListener("click", () => {
        if(input_modal_box)
            input_modal_box.classList.remove("active");
    })