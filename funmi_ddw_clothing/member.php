<?php
require_once "pdo.php";

session_start();

if (isset($_SESSION['email'])) {
    //echo($_SESSION['email']);
    $sql = "SELECT * FROM login WHERE Email = :email";
    //just for demonstration - delete
   // echo("<pre>\n" . $sql . "\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $_SESSION['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    //$user = $stmt->fetchColumn();
    //just for demonstration - delete
   // print_r($user);
    $username = $user["Name"];
} else {
    echo "Sorry! not a member";
    header('Location: login.php');
}

if ( isset($_POST['pname']) && isset($_POST['image'])){
    $sql = "INSERT INTO login (productName, productImages) 
              VALUES (:pname, :image)";
    echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':pname' => $_POST['pname'],
        ':image' => $_POST['image']));
}

$stmt = $pdo->query("SELECT productName, productImages FROM login");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>Members Area</title>
    
</head>
<body>
    <h1>Welcome <?= $username ?></h1> 
    <form method="post">
        <fieldset>
            <p>Add product</p>
            <label for="pname">Product Name:</label>
            <input type="text" name="pname" size="40">
            <label for="image">upload image here:</label>
            <input type="file" name="image" accept = "file_attribute" multiple="multiple"> 
            <p><input type="submit" value="Add New"/></p>
        </fieldset>
    </form>
    
     <table border="1">
<?php
foreach ( $rows as $row ) {
    //echo "<tr><td>";
    echo($row['productName']);
    echo("</td><td>");
    echo($row['productImages']);
    echo("</td><td>");
    }
?>
</table>
    <a href="logout.php"><button type = "button">Log Out</button></a

</body>
</html>

