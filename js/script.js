$(document).ready(function () {

    /**NAVBAR**/

    $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
            $('.dropdown-submenu .show').removeClass("show");
        });


        return false;
    });


    $(window).scroll(function () {

        if ($(window).scrollTop() > 200) {
            $('#nav').addClass('fixed-top');
            $('#nav').removeClass('my-3');
            $('#BackToTop').show();
        }

        if ($(window).scrollTop() < 200) {
            $('#nav').removeClass('fixed-top');
            $('#nav').addClass('my-3');
            $('#BackToTop').hide();
        }
    });


    /**LOGIN**/
    $('#register_button').click(function () {
        $('#register').addClass('d-none')
        $('#registration').removeClass('d-none')
    })


    /**MY ACCOUNT**/
    $("#shipping_adress_check").click(function () {

        $('#shipping_adress_form').toggleClass('d-block')
    })


    $('#buttonOne').click(function () {
        if (!$('#collapseOne').hasClass('show')) {
            if ($('#collapseTwo').hasClass('show')) {
                $('#collapseTwo').removeClass('show');
            }
            $('.active_collapse').not(this).removeClass('active_collapse')
            $('.active_collapse_text').not(this).removeClass('active_collapse_text')
            $('#headingOne').addClass('active_collapse')
            $('#buttonOne').addClass('active_collapse_text')
        } else {
            $('#buttonOne').removeClass('active_collapse_text')
            $('#headingOne').removeClass('active_collapse')
        }
    })

    $('#buttonTwo').click(function () {
        if (!$('#collapseTwo').hasClass('show')) {
            if ($('#collapseOne').hasClass('show')) {
                $('#collapseOne').removeClass('show');
            }
            $('.active_collapse').not(this).removeClass('active_collapse')
            $('.active_collapse_text').not(this).removeClass('active_collapse_text')
            $('#headingTwo').addClass('active_collapse')
            $('#buttonTwo').addClass('active_collapse_text')
        } else {
            $('#headingTwo').removeClass('active_collapse')
            $('#buttonTwo').removeClass('active_collapse_text')
        }
    })

    $(".product_information_button").click(function (){
        let arrow = $(".Arrow");
        if (arrow.hasClass("fa-arrow-down")){
            arrow.removeClass("fa-arrow-down");
            arrow.addClass("fa-arrow-right");
        } else {
            arrow.removeClass("fa-arrow-right");
            arrow.addClass("fa-arrow-down");
        }
    })



})


window.onload = function default_value() {
    if (document.getElementById('font-selector')) {
        let selector = document.getElementById('font-selector');
        let text = document.getElementById('custom-text');
        selector.style.fontFamily = selector.value;
        text.style.fontFamily = selector.value;

    }

    if (document.getElementById('colors')){
        let colors = document.getElementById('colors');
        let total_quantity =  colors.options[colors.selectedIndex].getAttribute("name");
        let quantity_selector = document.getElementById("quantity")

        console.log(total_quantity)
        quantity_selector.setAttribute("max", total_quantity);
        console.log(total_quantity);
    }
}

/** PRODUCT DETAILS  **/
function expand_img(img) {
    let expandImg = document.getElementById("expandedImg");
    let imgText = document.getElementById("imgtext");
    let placeholder = document.getElementById("placeholder");

    placeholder.style.display = "none";
    expandImg.src = img.src;
    imgText.innerHTML = img.alt;
    expandImg.parentElement.style.display = "block";
}


function change_font(font) {
    document.getElementById("font-selector").style.fontFamily = font.value;
    let text = document.getElementById('custom-text');
    text.style.fontFamily = font.value;
}



function edit_color_quantity(quantity){
    let total_quantity =  quantity.options[quantity.selectedIndex].getAttribute("name");
    let quantity_selector = document.getElementById("quantity")

    console.log(total_quantity)
    quantity_selector.value = 1;
    quantity_selector.setAttribute("max", total_quantity);
    console.log(total_quantity);
}



/**BACK TO TOP**/

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}




