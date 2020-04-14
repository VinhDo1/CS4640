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
    <?php 
        session_start();
        if(isset($_SESSION['username']))
        {
    ?>
    <header>
    <div class="row">
        <div class="col-md-4">
                <p>
                <button class="btn btn-lg btn-primary" name='btnaction' value='home' type="submit" onclick="window.location.href='lobby.php'">Back to Lobby</button>
            </p>
        </div>
        <div class="col-md-4">
        <h1>Telestrations</h1>
            <h3>Changing <font color="black" style="font-style:italic"><?php if(isset($_SESSION['username'])) echo $_SESSION['username'];?></font>'s password</h3>
        </div>
    </div>
    </header>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form class="needs-validation" action="<?php $_SERVER['PHP_SELF'] ?>" id="login" method="get"> 
            <div class="form-group mx-sm-5 mb-2">
            </div>    

            <div class="form-group mx-sm-5 mb-2 form-rounded">
                <input type="password" name="pwd" class ="form-control" id="password" placeholder="New Password" required/>
                <small id="passwordHelp" class="form-text wrong-login" ></small>
            </div>
            <div class="form-group mx-sm-5 mb-2 form-rounded">
            <button class="btn btn-lg btn-primary" name='btnaction' value='update' type="submit" >Update Password</button>
                <br>
            <h2>
                View Past Games
            </h2>        
            </div> 
        </form>
    </div>
        <div class="col-md-3"></div>
    </div>
<?php
    }
    else
    {
        header('Location: login.php');
    }
?>
<?php
    if (isset($_GET['btnaction']))
    {	
        try 
        { 	
            switch ($_GET['btnaction']) 
            {
                case 'update': 
                    updatePassword(); 
                    break;    
                case 'home':
                    header('Location: lobby.php');
                    break;
            }
        }
        catch (Exception $e)       // handle any type of exception
        {
            $error_message = $e->getMessage();
            echo "<p>Error message: $error_message </p>";
        }   
    }
?>
<?php
function updatePassword()
{
    require('connect-db.php');
	
    $username = $_SESSION['username'];
    $password = $_GET['pwd'];
    $hash_pwd = password_hash($password, PASSWORD_BCRYPT);
    $query = "UPDATE register SET password=:password WHERE username=:username";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $hash_pwd);
    $statement->execute();
    $statement->closeCursor();
    $_SESSION['pwd'] = $hash_pwd;
}
?>
<?php  
    require('connect-db.php');

    $query = "SELECT * FROM drawings WHERE username = :username";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $_SESSION['username']);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    foreach($results as $result)
    {
        $imageData = base64_encode(file_get_contents($result['imgURL']));
        echo '<div class="row">';
            echo '<div class="col-md-4 card">';
                echo '<div class="card-body"><p>';
                    $prompt = $result['prompt'];
                    echo $prompt;
                echo '<p></div>';
            echo '</div>';
            echo '<div class="col-md-4 card">';
                echo '<div class="card-body">';
                    echo '<img src="data:image/jpeg;base64,'.$imageData.'">';
                echo '</div>';
            echo '</div>';
            echo '<div class="col-md-4 card">';
                echo '<div class="card-body"><p>';
                $guess = $result['guess'];
                echo $guess;
                echo '</p></div>';
            echo '</div>';
            echo '</div>';
        echo '</div>';
        
    }
?>
</body>
</html>