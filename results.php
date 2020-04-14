<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">  
  
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <meta name="author" content="Vinh Do, Kirtana Pathak, Liem Budzien">
    <meta name="description" content="Results page for Telestrations">  
    
    <link rel="shortcut icon" href="images/favicon.png" type="image/ico" />
    <title>Telestrations</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/custom.css" />
       
    </head>

    <body class="container">
    <?php 
        session_start();
        if(isset($_SESSION['username']))
        {
    ?>
    
            <div class="row" style="margin-top: 1.5rem; margin-bottom: 3rem;">
                <div class="col-md-4">
                    <button class="btn btn-lg btn-danger btn-top" type="submit" onclick="logOut()">Log Out</button>
                </div>
                <div class="col-md-4">
                    <h2>Telestrations</h2>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-lg btn-success btn-top" type="submit" onclick="newGame()">New Game</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 card">
                    <div class="card-body">
                        <p>Original Word: <?php echo $_SESSION['prompt'];?></p>
                    </div>
                </div>
                <div class="col-md-4 card">
                    <img src="<?php echo $_SESSION["imgURL"]; ?>">
                </div>
                <div class="col-md-4 card">
                    <div class="card-body">
                        <p>Guessed Word: <?php echo $_SESSION['guess'];?></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-lg btn-primary" type="submit" onclick="playAgain()">Play Again</button>
                </div>
            </div>

    <script>
        function logOut() {
            if(confirm("Are you sure you want to leave the current lobby and logout?")) {
            document.location.href = "logout.php";
            }
        }

        function newGame() {
            if(confirm("Are you sure you want to leave the current lobby?")) {
            document.location.href = "lobby.php";
            }
        }

        function playAgain() {
            document.location.href = "enterWord.php";
        }
    </script>
    <?php
    }
    else
    {
        header('Location: login.php');
    }
    ?>
    </body>

</html>

