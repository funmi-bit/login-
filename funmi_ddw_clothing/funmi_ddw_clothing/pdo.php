<?php
//use port 8889 on a mac

$pdo = new PDO('mysql:host=localhost; port=3306; dbname=logindatabase', 
   'jan', '1234');
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//port=3306;


