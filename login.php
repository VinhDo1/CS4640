<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <meta name="author" content="Vinh Do, Kirtana Pathak, Liem Budzien">
  <meta name="description" content="Login page for Telestrations">  
    
  <link rel="shortcut icon" href="images/favicon.png" type="image/ico" />
  <title>Telestrations</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="styles/custom.css" />
       
</head>

<body>  
    <header>
        <div class="row">
            <div class="col-md-12">
                <h1>Telestrations</h1>
            </div>
        </div>
    </header>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form class="needs-validation" action="<?php $_SERVER['PHP_SELF'] ?>" id="login" method="post"> 
            <div class="form-group mx-sm-5 mb-2">
                <input type="text" name="username" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Enter username" autofocus required>
                <small id="usernameHelp" class="form-text wrong-login" ></small>
            </div>    

            <div class="form-group mx-sm-5 mb-2 form-rounded">
                <input type="password" name="pwd" class ="form-control" id="password" placeholder="Password" required/>
                <small id="passwordHelp" class="form-text wrong-login" ></small>
            </div>
            <div class="form-group mx-sm-5 mb-2 form-rounded">
                <button class="btn btn-lg btn-primary" type="submit" >Sign in</button>
                <br>    
                <a href="register.php" class="register">Don't have an account? Register now</a>
            </div> 
        </form>
    </div>
        <div class="col-md-4"></div>
    </div>
<?php
    session_start();
?>
<?php
    function reject($entry){
        echo 'Incorrect ' . $entry;
        exit();
    }



    if($_SERVER['REQUEST_METHOD']=="POST" && strlen($_POST['username']) > 0)
    {
        $user = trim($_POST['username']);
        if(!ctype_alnum($user)) //built in function that checks to make sure its alphanumeric 
        {
            reject('username');
        }
        if(isset($_POST['pwd'])) //check if password null
        {
            $pwd = trim($_POST['pwd']);
            if(!ctype_alnum($pwd))
            {
                reject('password');
            }
            else
            {
                $_SESSION['username'] = $user;
                $hash_pwd = password_hash($pwd, PASSWORD_BCRYPT);
                $_SESSION['pwd'] = $hash_pwd;
                header('Location: lobby.php');

            }
        }
    }


?>

    <script> 
        const username = document.getElementById("username");
        username.addEventListener("input", function (event) {
            if (username.validity.typeMismatch) {
                username.setCustomValidity("Invalid username address");
            } else {
                username.setCustomValidity("");
            } 
        });
    </script>


</body>
</html>