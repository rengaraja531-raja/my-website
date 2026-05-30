```php
<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>

<title>Dashboard</title>

<style>

body{
    margin:0;
    font-family:Arial;
    background:#f2f2f2;
}

.navbar{

    background:#333;
    padding:15px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.logo{
    color:white;
    font-size:22px;
}

.menu a{

    color:white;
    text-decoration:none;
    margin-left:15px;
    background:blue;
    padding:10px 15px;
    border-radius:5px;
}

.box{

    width:80%;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:10px;
}

</style>

</head>

<body>

<div class="navbar">

    <div class="logo">
        User Dashboard
    </div>

    <div class="menu">

        <a href="dashboard.php">Dashboard</a>

        <a href="profile.php">Profile</a>

        <a href="pdf.php">PDF</a>

    </div>

</div>

<div class="box">

    <h2>Welcome Dashboard</h2>

    <p>PDF button top right la irukkum.</p>

</div>

</body>
</html>
```
