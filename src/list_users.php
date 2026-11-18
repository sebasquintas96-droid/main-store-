<?php
// Use this URL to ptint data in browser:
// http://localhost/main-store-/src/list_users.php
   include("../settings/database.php");

   // Get data from users table 
   $sql="
        select 
        id,
        firstname ||' '|| lastname as fullname,
        email,
        mobile_phone,
        case when status = true then 'Active' else 'Inactive' end as status,
        url_photo
        from 
            users 
        
        ";
        $res = pg_query($local_conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DMain Store - List users</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <table class="table table-striped">
            <thead>
            <tr>
              <th>Photo</th>
              <th>Fullname</th>
              <th>Email</th>
              <th>Mobile phone</th>
              <th>Status</th>
              <th>Options</th>
            </tr>
            <thead>
            <?php while($row = pg_fetch_assoc($res)) { ?>
            <tr>
            <!-- Hre print data from database  -->
                <td>
                    <img src="<?= $row['url_photo'] ?>" width="40" alt="User photo profile">
                </td>
                <td><?= $row['fullname'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['mobile_phone'] ?></td>
                <td><?= $row['status'] ?></td>
                <td align="center">
                    <a href="edit_user.php?userID=<?php echo $row['id']; ?>">
                        <img src="icons/edit.png" alt="Edit user"  width="20">
                    </a>
                    <a href="#">
                        <img src="icons/search.png" alt="Search user" Width="20">
                    </a>
                    <a href="delete_user.php?userID=<?= $row['id'] ?>">
                        <img src="icons/delete.png" alt="Delete user" Width="20">
                    </a>
                    
                </td>

            </tr>

           <?php } ?>

        </table>
    </body>
 </html>
 