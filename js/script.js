$(document).ready(function () {

  /*   $('#navbarDropdownMenuLink0').on('click', function(){
         if (!$('#dropdown_menu0').hasClass('show')){
             $('#navbarDropdownMenuLink0').addClass('active_dropdown');
         } else{
             $('#navbarDropdownMenuLink0').removeClass('active_dropdown');
         }
    });

    $('body').on('click', function(){
        if ($('#dropdown_menu0').hasClass('show')){
            $('#navbarDropdownMenuLink0').removeClass('active_dropdown');
        }
    });

    $('#navbarDropdownMenuLink1').on('click', function(){
        if (!$('#dropdown_menu1').hasClass('show')){
            $('#navbarDropdownMenuLink1').addClass('active_dropdown');
        } else{
            $('#navbarDropdownMenuLink1').removeClass('active_dropdown');
        }
    });

    $('body').on('click', function(){
        if ($('#dropdown_menu1').hasClass('show')){
            $('#navbarDropdownMenuLink1').removeClass('active_dropdown');
        }
    });*/


    $('#navbar-toggler').click(function () {
        $("#bars-icon").toggleClass('active_dropdown')
        $('#navbar-toggler').toggleClass('active_dropdown_border')
    });

    $('#register_button').click(function () {
        $('#register').addClass('d-none')
        $('#registration').removeClass('d-none')
    })

    $("#shipping_adress_check").click(function () {

        $('#shipping_adress_form').toggleClass('d-block')
    })


    $('#headingOne').click(function () {
        if (!$('#collapseOne').hasClass('show')){
            $('#headingOne').addClass('active_collapse')
            $('.active_collapse').not(this).removeClass('active_collapse')
            $('.active_collapse_text').not(this).removeClass('active_collapse_text')
            $('#buttonOne').addClass('active_collapse_text')
        } else{
            $('#buttonOne').removeClass('active_collapse_text')
            $('#headingOne').removeClass('active_collapse')
        }
    })

    $('#headingTwo').click(function () {
        if (!$('#collapseTwo').hasClass('show')){
            $('#headingTwo').addClass('active_collapse')
            $('.active_collapse').not(this).removeClass('active_collapse')
            $('.active_collapse_text').not(this).removeClass('active_collapse_text')
            $('#buttonTwo').addClass('active_collapse_text')
        } else{
            $('#headingTwo').removeClass('active_collapse')
            $('#buttonTwo').removeClass('active_collapse_text')
        }
    })




})
