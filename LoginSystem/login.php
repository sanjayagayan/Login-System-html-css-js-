<?php

session_start();

include "DbConnect.php";

if (isset($_POST['uname']) && isset($_POST['password']))
{
    echo"hello";
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if(empty($uname) && empty($pass))
    {
        header("Location: index.php?error=Please Fill All Fields");
        exit();
        

    }else if(empty($pass))
    {
        header("Location: index.php?error=Password is required");
        exit();

    }else if(empty($uname))
    {
        header("Location: index.php?error=User Name is required");
        exit();

    }
    else{
        $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

        $result = mysqli_query($conn,$sql);
        if($result)
        {
            if(mysqli_num_rows($result) == 1)
            {

                $_SESSION['username'] = $uname;
                    header("Location: home.php");
                    exit();
                
            }
            else{
                header("Location: index.php?error=Incorrect Username or Password");
                exit();
            }
        }
    }
}


