<?php
require_once 'config.php';  
$email = $_GET['key'];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($connect,$sql);
$errors = array(); 

global $db,$errors;
if(mysqli_num_rows($result) === 1){
    if(isset($_POST['submit'])){
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        if($password == "" && $cpassword == ""){
            array_push($errors, "some fields are empty");
        }else{
            if($password == $cpassword){
                $password = password_hash($password, PASSWORD_DEFAULT);
                $update = "UPDATE users SET password = '$password' WHERE email = '$email'";
                if(mysqli_query($connect,$update)){
                    array_push($errors, "User password successfully changed! please login");
                }else{
                    array_push($errors, "Password change error. Refresh and reclick the email link");
                }
            }else{
                array_push($errors, "password are not match");
            }
        }
    }else{
    }

}
function display_error() {
    global $errors;

    if (count($errors) > 0){
        echo '<div class="error">';
            foreach ($errors as $error){
                echo $error .'<br>';
            }
        echo '</div>';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Forgot Password</title>
	<link rel="stylesheet" type="text/css" href="style_login.css">
</head>
<body>
   
<form method="post" action="">

    <h2><span>Welcome </span><?php echo $email ?></h2>

	<?php echo display_error(); ?>
    <div class="input-group">
        <label>New Password</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <label>Confirm password</label>
        <input type="password" name="cpassword">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="submit" > submit</button>
    </div>
</form>



</body>
</html>