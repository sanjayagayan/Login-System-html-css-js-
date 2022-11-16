<?php
include "DbConnect.php";
    session_start();
?>
<?php
    
    
    if(isset($_SESSION['username'])){
        $userName = $_SESSION['username'];
        $sql="SELECT * FROM users WHERE user_name = '$userName'";
        $result = mysqli_query($conn,$sql);
        if($result){
            if(mysqli_num_rows($result)==1){
                
                $row = mysqli_fetch_assoc($result);
                $oldUser = $row['user_name'];
                $oldPass = $row['password'];
    
    
            }
        }
    }else{
        header("Location: index.php");
    }

    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: index.php");
    }
    if(isset($_GET["close"])){
        unset($_SESSION['username']);
        header("Location :index.php");
    }


    if(isset($_POST["submit"])){
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
        $oldpass = validate($_POST["oldpassword"]);
        if($pass != $cpass){
            header("Location: home.php?error=Enter Same Password");
            exit();
        }else if(empty($uname) && empty($pass))
        {
            header("Location: homeup.php?error=Please Fill All Fields");
            exit();
            
    
        }else if(empty($pass))
        {
            header("Location: home.php?error=Password is required");
            exit();
    
        }else if(empty($uname))
        {
            header("Location: home.php?error=User Name is required");
            exit();
    
        }else{
           
           if($oldpass != $oldPass){
                echo"<p style='color: red'>You Entered Wrong Old Password</p>";
                echo "<br>";
           }else{
                $query = "UPDATE users SET user_name = '$uname', password = '$pass' WHERE user_name = '$oldUser'";
                $res = mysqli_query($conn,$query);
                if($res){
                    echo"<p style='color: #FFFF00'>Update Success</p>";
                    echo "<br>";
                }
           }
        }
    
    }
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>AMMD</title>
    <link rel="stylesheet" href="style2.css">
    <style>
        #myForm{
            display: none; 
    
        }
    </style>
</head>
<body>
    <div class="box2" id="box2">
        <header class="header">
            <div id="hbtn" >
                <button class="edit" onclick="formUp()">Edit User</button>
<form action="home.php" method="post" >
<button class='logout' name = "logout">Logout</button>
</form>
                
            
                
            </div>
        </header>
        <div class="margin-box"></div>
        <div class="form-popup" id="myForm">
        <?php if(isset($_GET['error'])){ ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
        
        <form action="home.php" method="post" >
            
            <h2>Welcome</h2>
            <div class="form2">
                <input type="text" name="uname" value="<?php echo $oldUser?>" placeholder="user">
                <input type="text" name="password" placeholder="Password">
                <input type="text" name="cpassword" placeholder="Confirm Password">
                <input type="text" name="oldpassword" placeholder="Old Password">
            </div>
           
           
            <input type="submit"  name="submit" id="btn" value="Update">
          
            
           
        </form>
        </div>

    </div>
    <script>
        
        function formUp(){
            document.getElementById("myForm").style.display = "block";
            console.log("hello");
        }
    </script>

</body>
</html>