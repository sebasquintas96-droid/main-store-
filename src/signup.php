<?php
// Get database connection 
/* Use this URL to in brower to register a new users:
*/
include("../settings/database.php");
// Get payload from frontend
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$ident_number = $_POST['idnumber'];
$mobile_phone = $_POST['mphone'];
$email = $_POST['email'];
$password = MD5($_POST['pswd']);
$PHOTO_URL ='photos_default.png';
 
$sql_check_email = "SELECT * FROM users WHERE email='$email'";
$res= pg_query($local_conn, $sql_check_email);
$total=pg_num_rows($res);
if($total<1){
// Prepare query
$sql = "
            INSERT INTO
            users (firstname, lastname, ident_number, mobile_phone, email, password, url_photo, mobile_phone)
            VALUES (
            '$firstname',
            '$lastname',
            '$ident_number',
            '$mobile_phone',
            '$email',
            '$password'
            '$PHOTO_URL'
            '$mobile_phone'
            )";
 
// Execute query
$res = pg_query($local_conn, $sql);
 
if ($res) {
    //echo "<script>alert('User has been created successfully');</script>";
    echo "<script>alert('User has been created successfully');</script>";
    header('refresh:0;url=../signin.html');
} else {
    echo "Error:user hasn't been created successfully...";
}
}else{
    echo "<script>alert('User email already exists');</script>";
    header('refresh:0;url=../signup.html');
    }
?>
 
