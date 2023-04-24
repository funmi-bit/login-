<?php
require_once "pdo.php";

$hash = password_hash(1234, PASSWORD_DEFAULT);
echo $hash . "<br>";
session_start();
if (isset($_POST['email']) && isset($_POST['password'])) {

    //this way is vulnerable replace like below
    // Using (hack method)can login into any user account without passwords example, funmi' or 1=1#
    //get the typed email and password
//	$typed_email = $_POST['email'];
//	$typed_password = $_POST['password']; 	
//	
//	
//    
//	$sql = "SELECT * FROM users WHERE email = '$typed_email' AND password= '$typed_password'";
//	
//	//just for demonstration - delete
//	echo("<pre>\n".$sql."\n</pre>\n");
//	$stmt = $pdo->query($sql);
//	$user = $stmt->fetch(PDO::FETCH_ASSOC);
//	print_r($rows);
//	
    // this uses prepared statements so is not vulnerable to injection
    
    
    $sql = "SELECT * FROM login WHERE Email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $_POST['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
   $flag = false;
   if ($user){
       $flag = password_verify($_POST['password'], $user['Password']);
   }
   if ($flag) {
        $_SESSION['email'] = $_POST['email'];
        //echo "<h1>correct</h1>";
        //echo($_SESSION['email']);
        header('Location: member.php');
        if (empty($_POST['email']) && empty($_POST['password'])) {
            echo("Fields cannot be empty!");
        }
    } else {
        echo("Incorrect password try again!");
    }
}
?>


<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <meta charset="UTF-8">
        <title>Login to the Members Area</title>

    </head>
    <body>
        <!- Should use proper semantic HTML -->
        <p>Login</p>
        <form method="post">
            <p>Email:
                <input type="text" name="email"></p>
            <p>Password:
                <input type="password" name="password"></p>
            <p><input type="submit" value="Login"/></p>

    </body>
</html>