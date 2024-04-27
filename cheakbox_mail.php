<?php include_once "includes/header.php" ?>


<?php

    $connection = mysqli_connect('localhost', 'root', '', 'test_practice');
    if (!$connection) {
        die("Database not connected".mysqli_error);
    }
    $query = "SELECT * FROM user_info";
    $result = mysqli_query($connection, $query);

    $count = mysqli_num_rows($result);  
?>

   <form action="test_mail.php" method="post">
    <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>DB ID</th>
                    <th>Email</th>
                    <th> <center><input class="btn btn-success" name="submit" type="submit" value="Send_Mail"></center> </th>
                </tr>
            </thead>

            <?php
            while ($row= mysqli_fetch_assoc($result)) {
                $db_id = $row['id'];
                $db_email = $row['email'];

                ?>
                <tbody>
                    <tr>
                        <td><?php echo $db_id ?></td>
                        <td><?php echo $db_email ?></td>
                        <td><center><input type="checkbox" name="email_mark[]" value="<?php echo $db_id?>"></center></td>
                    </tr>
                </tbody>
                <?php
            }
            ?>
        </table>
   </form>