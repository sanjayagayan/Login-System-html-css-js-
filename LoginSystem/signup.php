<?php
session_start();
include "DbConnect.php";
if(isset($_POST["signup"])){
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname = validate($_POST["uname"]);
    $pass = validate($_POST["password"]);
    $cpass = validate($_POST["cpassword"]);
    if($pass != $cpass){
        header("Location: signup.php?error=Enter Same Password");
        exit();
    }else if(empty($uname) && empty($pass))
    {
        header("Location: signup.php?error=Please Fill All Fields");
        exit();
        

    }else if(empty($pass))
    {
        header("Location: signup.php?error=Password is required");
        exit();

    }else if(empty($uname))
    {
        header("Location: signup.php?error=User Name is required");
        exit();

    }else{
       
        $sql = "INSERT INTO users(user_name,password)VALUES('$uname','$pass')";
        $result = mysqli_query($conn,$sql);
        if($result){
            $_SESSION['username'] = $uname;
            header("Location: home.php");
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>AMMD</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box3">
        <form action="signup.php" method="post" autocomplete="off">
            <h2>AMMD</h2>
            <?php if(isset($_GET['error'])){ ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            
            <div class="inputBox">
                <input type="text" name="uname">
                <span>Username</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password" >
                <span>Password</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="cpassword" >
                <span>Confirm Password</span>
                <i></i>
            </div>
            <input type="submit" value="Sign Up" name="signup">
            <div class="links">
				<p>Have an Account?<a href="index.php">Login</a></p>
			</div>
        </form>
    </div>
</body>
</html>