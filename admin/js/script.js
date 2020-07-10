$(function() {

    function timeChecker() {
        setInterval(function () {
            var storedTimeStamp = sessionStorage.getItem("lastTimeStamp");
            timeCompare(storedTimeStamp);
        }, 3000);
    }


    function timeCompare(timeString) {
        var maxMinutes = 10 ;
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

$("#close-sidebar").click(function () {
    $("#sidenav-main").addClass('d-block')
})


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

$("[name='author']").remove()
$("[name='description']").remove()






