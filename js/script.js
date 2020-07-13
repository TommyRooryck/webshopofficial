$(document).ready(function () {

    /**NAVBAR**/
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
        if (!$('#collapseOne').hasClass('show')){
            $('.active_collapse').not(this).removeClass('active_collapse')
            $('.active_collapse_text').not(this).removeClass('active_collapse_text')
            $('#headingOne').addClass('active_collapse')
            $('#buttonOne').addClass('active_collapse_text')
        } else{
            $('#buttonOne').removeClass('active_collapse_text')
            $('#headingOne').removeClass('active_collapse')
        }
    })

    $('#buttonTwo').click(function () {
        if (!$('#collapseTwo').hasClass('show')){
            $('.active_collapse').not(this).removeClass('active_collapse')
            $('.active_collapse_text').not(this).removeClass('active_collapse_text')
            $('#headingTwo').addClass('active_collapse')
            $('#buttonTwo').addClass('active_collapse_text')
        } else{
            $('#headingTwo').removeClass('active_collapse')
            $('#buttonTwo').removeClass('active_collapse_text')
        }
    })




})
