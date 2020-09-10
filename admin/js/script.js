/**Auto-login function**/
$(function () {

    function timeChecker() {
        setInterval(function () {
            var storedTimeStamp = sessionStorage.getItem("lastTimeStamp");
            timeCompare(storedTimeStamp);
        }, 3000);
    }


    function timeCompare(timeString) {
        var maxMinutes = 10;
        var currentTime = new Date();
        var pastTime = new Date(timeString);
        var timeDiff = currentTime - pastTime;
        var minPast = Math.floor((timeDiff / 60000));

        if (minPast > maxMinutes) {
            sessionStorage.removeItem("lastTimeStamp");
            window.location = "logout.php";
            return false;
        } else {
            console.log(currentTime + " - " + pastTime + " - " + minPast + " min past");
        }
    }

    if (typeof (Storage) !== "undefined") {
        $(document).mousemove(function () {
            var timeStamp = new Date();
            sessionStorage.setItem("lastTimeStamp", timeStamp);
        });

        timeChecker();
    }
})

/**SIDEBAR TOGGLE FUNCTION**/
$("#sidenav-collapse-main").click(function () {
    $("#sidenav-main").toggleClass('d-none')
})

$('.sidenav-toggler-inner').click(function () {
    $("#sidenav-main").toggleClass('d-block')
})

/**ADD CATEGORIES FORM FUNCTIONS**/
$(function () {

    $(".add_category_check").click(function () {
        $(".add_category_form").toggle();

    })
})

$(function () {

    $(".add_sub_category_check").click(function () {
        $(".add_sub_category_form").toggle();

    })
})

$(function () {

    $("button.collapse_level_one").click(function () {
        $(".add_category_form_label").toggle();
        $(".add_category_check").toggle();
    })


})

$(function () {

    $("button.collapse_level_two").click(function () {
        $(".add_sub_category_form_label").toggle();
        $(".add_sub_category_check").toggle();
    })

})

$(function () {

    $(".inactive_accordion_header").click(function () {
        $(".inactive_accordion_header").toggleClass("active_collapse")
        $(".inactive_collapse_text").toggleClass("active_collapse_text")
    })
})



/**IMAGE PREVIEW FUNCTIONS**/

$(function () {

    var imagesPreview = function (input, placeToInsertImagePreview) {

        if (input.files) {
            $(".gallery").html("");
            var filesAmount = input.files.length;

            for (o = 0; o < filesAmount; o++) {
                var reader = new FileReader();

                reader.onload = function (event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[o]);
            }
        }

    };


    $('#gallery-photo-add').on('change', function () {
        $(".gallery").append(imagesPreview(this, 'div.gallery'));
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#placeholder_img").attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function () {
    readURL(this);
})

/**Create input**/

$(document).ready(function () {

    var fieldHML = ' <input type="text" name="value[]" class="form-control my-2" placeholder="Enter Attribute Value">';

    $('#add_element').click(function () {
        $("#new_value").append(fieldHML);
    })

})












