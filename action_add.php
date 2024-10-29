<?php
include("config.php");
include("firebaseRDB.php");
$db = new firebaseRDB($databaseURL);

$insert = $db->insert("users", [
    "id_no"        => $_POST['id_no'],
    "username"  => $_POST['username'],
    "email"     => $_POST['email'],
    "pw"        => $_POST['pw']
]);

echo "User Saved!";