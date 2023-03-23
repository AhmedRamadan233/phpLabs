<?php
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">';


$data = array();

if(isset($_POST['fname']) && isset($_POST['address']) && isset($_POST['department'])){
    $name = $_POST['fname'];
    $address = $_POST['address'];
    $department = $_POST['department'];

    array_push($data, $name, $address, $department,);

    $file = fopen("data.txt", "a");
    fputcsv($file, $data);
    fclose($file);
    echo "Data saved successfully!";
}
    $file = fopen("data.txt", "r");
    if ($file) {
        echo '<table class="table">';
        echo '<thead><tr><th>#</th><th>First Name</th><th>Address</th><th>Department</th><th>Action</th></tr></thead>';
        echo '<tbody>';

        $index = 0;

        while(($row = fgetcsv($file)) !== false) {
            $index++;
            echo "
                <tr>
                    <td>$index</td>
                    <td>$row[0]</td>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                    <td>
                        <form method='post'>
                            <input type='hidden' name='delete_row' value='$index'>
                            <button type='submit' class='btn btn-danger'>Delete</button>
                        </form>
                    </td>
                    <td>
                        <form method='post'>
                            <input type='hidden' name='edit_row' value='$index'>
                            <button type='submit' class='btn btn-primary'>Edit</button>
                        </form>
                    </td>

                </tr>";
        }

        echo '</tbody></table>';
        fclose($file);

        if(isset($_POST['delete_row'])) {
            $delete_row = $_POST['delete_row'];
            $rows = file("data.txt");
            unset($rows[$delete_row - 1]);
            file_put_contents("data.txt", implode("", $rows));
            header("Location: done.php");
        }

        if(isset($_POST['edit_row'])) {
            $edit_row = $_POST['edit_row'];
            $rows = file("data.txt");
            $data = explode(",", $rows[$edit_row - 1]);
            $name = $data[0];
            $address = $data[1];
            $department = $data[2];
            echo "<form method='post' action='update.php'>
                    <input type='hidden' name='edit_index' value='$edit_row'>
                    <input type='text' name='fname' value='$name'>
                    <input type='text' name='address' value='$address'>
                    <input type='text' name='department' value='$department'>
                    <button type='submit' class='btn btn-primary'>Update</button>
                </form>";
        }
        
        
        
    }







?>
