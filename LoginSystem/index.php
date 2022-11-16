<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>AMMD</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box">
        <form action="login.php" method="post" autocomplete="off">
            <h2>AMMD</h2>
            <?php if(isset($_GET['error'])){ ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            
            <div class="inputBox">
                <input type="text" name="uname" required = "required">
                <span>Username</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password" >
                <span>Password</span>
                <i></i>
            </div>
            <input type="submit" value="Login">
            <div class="links">
				<p>Need an Account?<a href="signup.php">Signup</a></p>
			</div>
        </form>
    </div>
</body>
</html>

