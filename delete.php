<?php
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);
$id = $_GET['id'];
if($id !=""){
    $delete = $db->delete("users", $id);
    echo "Data Deleted...";
}
