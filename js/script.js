$(document).ready(function () {

    /**NAVBAR**/

    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');


        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });


        return false;
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
            if ($('#collapseTwo').hasClass('show')){
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
            if ($('#collapseOne').hasClass('show')){
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

})

/** PRODUCT DETAILS  **/
function expand_img(img) {
    let expandImg = document.getElementById("expandedImg");
    let imgText = document.getElementById("imgtext");
    let placeholder = document.getElementById("placeholder");

    placeholder.style.display ="none";
    expandImg.src = img.src;
    imgText.innerHTML = img.alt;
    expandImg.parentElement.style.display = "block";
}


