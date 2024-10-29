<?php
include("config.php");
include("firebaseRDB.php");
$db = new firebaseRDB($databaseURL);
$id = $_GET['id'];
$retrieve = $db->retrieve("users/$id");
$data = json_decode($retrieve, 1);

?>
<form method="post" action="action_edit.php">
<table border="0" width="500">
    <tr>
        <td>ID</td>
        <td>:</td>
        <td><input type="text" name = "id_no" value="<?php echo $data['id_no']?>"></td>
    </tr>
    <tr>
        <td>Username</td>
        <td>:</td>
        <td><input type="text" name = "username" value="<?php echo $data['username']?>"></td>
    </tr>
    <tr>
        <td>Email</td>
        <td>:</td>
        <td><input type="text" name = "email" value="<?php echo $data['email']?>"></td>
    </tr>
    <tr>
        <td>Password</td>
        <td>:</td>
        <td><input type="text" name = "pw" value="<?php echo $data['pw']?>"></td>
    </tr>
    <tr>
        <td>
            <input type="hidden" name="id" value="<?php echo $id?>">
            <input type="submit" value="Save">
        </td>
    </tr>
</table>
</form\>
 