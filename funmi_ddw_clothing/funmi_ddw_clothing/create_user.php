<?php
echo "Hello";

//this is not being used yet
require_once "pdo.php";
if ( isset($_POST['name']) && isset($_POST['email']) 
     && isset($_POST['password'])) {
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO login (name, email, password) 
              VALUES (:name, :email, :password)";
    echo("<pre>\n".$sql."\n</pre>\n");
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $hash));
}

if ( isset($_POST['delete']) && isset($_POST['email']) ) {
    $sql = "DELETE FROM users WHERE email = :zip";
    echo "<pre>\n$sql\n</pre>\n";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':zip' => $_POST['email']));
}

$stmt = $pdo->query("SELECT name, email, password FROM login");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <title>Create User</title>
</head>
<body>
    <table border="1">
<?php
foreach ( $rows as $row ) {
    echo "<tr><td>";
    echo($row['name']);
    echo("</td><td>");
    echo($row['email']);
    echo("</td><td>");
    echo($row['password']);
    echo("</td><td>");
    echo('<form method="post"><input type="hidden" ');
    echo('<input type="submit" value="Del" name="delete">');
    echo("\n</form>\n");
    echo("</td></tr>\n");
}
//?>
</table>
<!- Should use proper semantic HTML -->
<p>Add A New User</p>
<form method="post">
<label for="name">Name:</label>
<input type="text" name="name" size="40"></p>
<label for="name">Email:</label>
<input type="text" name="email"></p>
<label for="name">Password:</label>
<input type="password" name="password"></p>
<p><input type="submit" value="Add New"/></p>
</form>
</body>
