<?php
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);
$id = $_POST['id'];
$update = $db->update("users", $id, [
    "id_no"     => $_POST['id_no'], 
    "username"  => $_POST['username'], 
    "email"     => $_POST['email'], 
    "pw"        => $_POST['pw'] 
]);

echo "Data Updated!";