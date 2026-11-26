<?php
require_once 'auth.php';
requireAdmin();
include('../settings/database.php');

// Get data
$user_id = $_GET['userID'] ?? '';
$user_status = $_GET['userStatus'] ?? '';
if (!ctype_digit((string)$user_id)) {
    header('Location: list_users.php');
    exit();
}

// Determine new status
if ($user_status === 'Active' || $user_status === 't' || $user_status === 'true') {
    $new_userStatus = 'false';  
} else {
    $new_userStatus = 'true';  
}

// Update user status
$sql_update_user_status = "
    UPDATE users
    SET status = $1
    WHERE id = $2
";
$res = pg_query_params(
    $local_conn,
    $sql_update_user_status,
    array($new_userStatus, $user_id)
);
if ($res) {
    header('Location: list_users.php');
    exit();
} else {
    echo "User status could not be updated.";
}
?>