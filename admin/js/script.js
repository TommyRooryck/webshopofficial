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

$x = 0;
$y = 0;



$("#accordionExample_" + $x++).click(function () {
    $i = document.getElementById('collapse');
    if ($i.className ==='collapse'){
        $($i).addClass('collapse-show').removeClass('collapse');
    } else if ($i.className === 'collapse-show') {
        $($i).addClass('collapse').removeClass('collapse-show');
    }

})


