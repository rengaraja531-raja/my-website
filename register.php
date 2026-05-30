<?php
session_start();

$conn = mysqli_connect("localhost","root","","rengaraja_db");

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

$message = "";

if(isset($_POST['register'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check username already exists
    $check = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $check);

    if(mysqli_num_rows($result) > 0){

        $message = "Username Already Exists!";

    }else{

        $sql = "INSERT INTO users (name, username, password)
                VALUES ('$name', '$username', '$password')";

        if(mysqli_query($conn, $sql)){

            $_SESSION['name'] = $name;
            $_SESSION['username'] = $username;

            header("Location: login.php");
            exit();

        }else{

            $message = "Registration Failed : " . mysqli_error($conn);

        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Page</title>

    <style>

        body{
            font-family: Arial;
            background:#f2f2f2;
        }

        .box{
            width:350px;
            background:white;
            padding:30px;
            margin:80px auto;
            border-radius:10px;
            box-shadow:0 0 10px gray;
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        input{
            width:100%;
            padding:10px;
            margin-top:10px;
            box-sizing:border-box;
        }

        button{
            width:100%;
            padding:10px;
            margin-top:15px;
            background:blue;
            color:white;
            border:none;
            cursor:pointer;
            border-radius:5px;
        }

        button:hover{
            background:darkblue;
        }

        p{
            color:red;
            text-align:center;
        }

    </style>

</head>
<body>

<div class="box">

    <h2>Register</h2>

    <form method="POST">

        <input type="text" name="name" placeholder="Enter Name" required>

        <input type="text" name="username" placeholder="Enter Username" required>

        <input type="password" name="password" placeholder="Enter Password" required>

        <button type="submit" name="register">Register</button>

    </form>

    <p><?php echo $message; ?></p>

</div>

</body>
</html>