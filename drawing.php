<!DOCTYPE html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<html lang="en">
    <head>	
    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        
        <meta name="authors" content="Kirtana Pathak, Vinh Do, Liem Budzien">
        <meta name="description" content="Drawing page">
        <meta name="keywords" content="drawing, telestrations">
           
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/custom.css">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:100,300,400">
        
        <!--icon on tab of page-->
        <link rel="shortcut icon" href="images/favicon.png" type="image/ico" />
        <title>Telestrations</title>
    
</head>
<script>
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            timer--;
            if (timer == -2) {
                done();
            }
        }, 1000);
    }

    window.onload = function () {
        var time = 59;
        display = document.querySelector('#time');
        startTimer(time, display);
    };
</script>
<body style='margin: 0'>
    <?php session_start(); 
        if(isset($_SESSION['username']))
        {
    ?>

    <div class="row" id ="heading">
        <div class="col-md-12">
            <h3>
                It's time to draw! Your word is <span style="text-decoration: underline;"><font color="black"><?php echo $_SESSION['prompt'];?></font></span>!
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <h3>Time left:
                <br><span id="time">1:00</span>
            </h3>
        </div>
        <div class="col-md-8">
            <div class="text-center">
                <canvas id="myCanvas" width = "1000%" height="485%" style="border:0.01rem solid #000000;background-color: white;text-align:center">
                    Sorry, your browser does not support the canvas.
                </canvas>
                <div id="colors">
                    <div class="shade active"style="background-color:black"></div>
                    <div class="shade"style="background-color:red"></div>
                    <div class="shade"style="background-color:orange" ></div>
                    <div class="shade"style="background-color:yellow"></div>
                    <div class="shade"style="background-color:green"></div>
                    <div class="shade"style="background-color:blue"></div>
                    <div class="shade"style="background-color:purple"></div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="row" text-align="center">
        <div class="col-md-12">
            <button class="btn btn-danger btn-game" onclick="window.location.href='lobby.php'">Exit Game</button>
            <button class="btn btn-success btn-game" onclick="done();">Done</button>
        </div>
    </div>
    <script src="drawing.js"></script>

    <script>
        function done() {
            var canvas = document.getElementById('myCanvas');
            var drawingURL = canvas.toDataURL();

            $.ajax({ 
                data: {drawingURL: drawingURL},
                type: "POST",
                success: function(output) {
                    window.location.href='guess.php'
                },
                error: function (e) {
                    console.log("Unsuccessful:", e);
                }
            });
        }
    </script>

    <?php
            if(isset($_POST['drawingURL'])){
                $_SESSION["imgURL"] = $_POST['drawingURL']; 
            }
    ?>

    <?php 
        }
        else
            header('Location: login.php');
    ?>
</body>
</html>