<!-- should go in center grid of page-->
<!DOCTYPE html>
<html lang="en">
    <head>	
    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        
        <meta name="authors" content="Kirtana Pathak, Vinh Do, Liem Budzien">
        <meta name="description" content="Lobby page">
        <meta name="keywords" content="telestrations, lobby">
           
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/custom.css">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:100,300,400">
        
        <!--favicon-->
        <link rel="shortcut icon" href="images/favicon.png" type="image/ico" />
        <title>Telestrations</title>
    
</head>
<body>
    <?php 
        header('Access-Control-Allow-Origin: http://localhost:4200');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
        
        session_start();
        if(isset($_SESSION['username']))
        {
    ?>
    <header>
    <div class="row">
        <div class="col-md-4">
                <p>
                    <button class="btn btn-lg btn-primary" name='btnaction' value='home' type="submit" onclick="window.location.href='profile.php'">View Profile</button>
                </p>
        </div>
        <div class="col-md-4">
        <h1>Lobby</h1>
        </div>
        <div class="col-md-4">
                <p>
                    <button class="btn btn-lg btn-danger btn-primary" name='btnaction' value='home' type="submit" onclick="window.location.href='logout.php'">Logout</button>
                </p>
        </div>
    </div>
    </header>
    <h3>Welcome, <font color="black" style="font-style:italic"><?php if(isset($_SESSION['username'])) echo $_SESSION['username'] . "!";?></font></h1>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <br>
            <button class="btn btn-primary btn-lg" style="width: 75%;">Create a New Lobby</button>
            <h3><br>OR<br><br>Join an existing lobby!</h3><br>
            <form class="needs-validation" action="<?php $_SERVER['PHP_SELF']?>" onsubmit= "return validateCode()" method="get"> 
                <div class="form-group mx-sm-5 mb-2">
                    <input type="text" id="code" name="code" class="form-control" placeholder="Enter 6 letter code" autofocus required/>
                </div>    
                <br/>
                <input type="submit" value="Join Game" class="btn btn-primary btn-lg"></input>
                </div> 
            </form>
        </div>
    </div>
    <?php
    }
    else
    {
        header('Location: login.php');
    }
    ?>
    <?php
        $code = '';
        if(!empty($_GET['code']))
        {
            $_SESSION['code'] = $_GET['code'];
            header('Location: ' . 'enterWord.php?roomCode=' . $_GET['code']);
        }
    ?>
    <script>
    var lengthCheck = (codeLength) => codeLength-6;

    //Function to check to make appropriate code is entered
    function validateCode() {
        var entered = document.getElementById("code").value;
        if ((lengthCheck(entered.length)) != 0){
            alert("The code's length should be 6.");
            return false;
             }
        else{
            return true;
             }
        }
    </script>

</body>
</html>