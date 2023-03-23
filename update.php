<?php
if(isset($_POST['edit_index']) && isset($_POST['fname']) && isset($_POST['address']) && isset($_POST['department'])){
    $edit_index = $_POST['edit_index'];
    $name = $_POST['fname'];
    $address = $_POST['address'];
    $department = $_POST['department'];

    $rows = file("data.txt");
    $rows[$edit_index - 1] = "$name,$address,$department\n";
    file_put_contents("data.txt", implode("", $rows));

    header("Location: done.php");
}
?>
