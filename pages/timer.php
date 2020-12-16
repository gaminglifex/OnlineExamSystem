<html>
    <head>
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
            <link rel="stylesheet" href="/Exam/css/TimeCircles.css">
            <script src="/Exam/css/TimeCircles.js"></script>
    </head>
<body>
<div id="timer" data-timer="<?php session_start();echo $_SESSION['duration'];?>" style="width:50%;height:100px;"></div>
</body>
<script>

$("#timer").TimeCircles({
    count_past_zero: false,
    time:{
        Days:{
            show: false
        },
    }
});

var countdown = setInterval(function(){
    var remaining_second = $("#timer").TimeCircles().getTime();
    if(remaining_second <= 0)
    {
        clearInterval(countdown);
        alert('Exam time is over');
        document.getElementById("submitExam").click();
        $("#timer").TimeCircles().stop();
    }
}, 1000);


</script>
</html>