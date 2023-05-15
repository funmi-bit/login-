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

//if ( isset($_POST['pname']) && isset($_FILES['image'])){
//    $pname = $_POST['pname'];
//    $image = $_FILES['image']['name'];
//    $target_dir = "uploads/";
//  $target_file = $target_dir . basename($image);
//    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
//
//    $sqls = "INSERT INTO product (productName, productImage) 
//              VALUES (:pname, :image)";
//    echo("<pre>\n".$sqls."\n</pre>\n");
//    $stmt = $pdo->prepare($sqls);
//    $stmt->execute(array(
//        ':pname' => $pname,
//        ':image' => $target_file));
//}


if (isset($_POST['pname']) && isset($_FILES['image'])) {
    $pname = $_POST['pname'];
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    $sqls = "INSERT INTO product (productName, productImage) 
              VALUES (:pname, :image)";
    echo("<pre>\n".$sqls."\n</pre>\n");
    $stmt = $pdo->prepare($sqls);
    $stmt->execute(array(
        ':pname' => $pname,
        ':image' => $target_file));
}


$stmt = $pdo->query("SELECT productName, productImage FROM product");
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
	<form action = "create_user.php" method = "POST">
	<input type = "submit" value = "Add new user">
	</form>
    <form method="post" enctype="multipart/form-data">
        <fieldset>
            <p>Add product</p>
            <label for="pname">Product Name:</label>
            <input type="text" name="pname" size="40">
            <label for="image">upload image here:</label>
            <input type="file" name="image" accept ="image/*" multiple="multiple" onchange="showImagePreview(event")> 
            <p><input type="submit" value="Add New"/></p>
        </fieldset>
    </form>
    
    <table border="1" id="product-table">
        
        <tr>
            <th>Product Name</th>
            <th>Product Image</th>
        </tr>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['productName']; ?></td>
                <td><img src="<?php echo $row['productImage']; ?>" alt="<?php echo $row['productName']; ?>" width="200" height="200"></td>
            </tr>
        <?php } ?>
    </table>

//<?php
//foreach ( $rows as $row ) {
//    echo "<tr><td>";
//    echo($row['productName']);
//    echo("</td><td>");
//    echo '<img src="' . $row['productImage'] . '" alt="' . $row['productName'] . '"width="200" height="200">';
//    echo("</td></tr>");
//}
//?>
</table>


    <a href="logout.php"><button type = "button">Log Out</button></a

</body>
</html>

<!--if ( isset($_POST['pname']) && isset($_POST['image'])){
    $sqls = "INSERT INTO product (productName, productImage) 
              VALUES (:pname, :image)";
    echo("<pre>\n".$sqls."\n</pre>\n");
    $stmt = $pdo->prepare($sqls);
    $stmt->execute(array(
        ':pname' => $_POST['pname'],
        ':image' => $_POST['image']));
}-->
<!--     <table border="1">
<?php
//foreach ( $rows as $row ) {
//    //echo "<tr><td>";
//    echo($row['productName']);
//    echo("</td><td>");
//    echo($row['productImage']);
//    echo("</td><td>");
//    }
?>
</table>-->