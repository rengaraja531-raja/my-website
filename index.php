<?php
session_start();

// Current Page
$page = "dashboard";

if(isset($_GET['page'])){
    $page = $_GET['page'];
}

// Default Data
if(!isset($_SESSION['name'])){
    $_SESSION['name'] = " ";
}

if(!isset($_SESSION['email'])){
    $_SESSION['email'] = "";
}

if(!isset($_SESSION['phone'])){
    $_SESSION['phone'] = "9876543210";
}

if(!isset($_SESSION['city'])){
    $_SESSION['city'] = "Chennai";
}

if(!isset($_SESSION['age'])){
    $_SESSION['age'] = "21";
}

if(!isset($_SESSION['dob'])){
    $_SESSION['dob'] = "2005-01-01";
}

if(!isset($_SESSION['aadhar'])){
    $_SESSION['aadhar'] = "123456789012";
}

if(!isset($_SESSION['photo'])){
    $_SESSION['photo'] = "";
}

// Upload Folder
if(!file_exists("uploads")){
    mkdir("uploads");
}

// Update Details
if(isset($_POST['update'])){

    $_SESSION['name'] = $_POST['name'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['dob'] = $_POST['dob'];
    $_SESSION['aadhar'] = $_POST['aadhar'];

    if(isset($_FILES['photo']) && $_FILES['photo']['name'] != ""){

        $file = time() . "_" . $_FILES['photo']['name'];

        $path = "uploads/" . $file;

        move_uploaded_file($_FILES['photo']['tmp_name'], $path);

        $_SESSION['photo'] = $path;
    }
}

// Delete Image
if(isset($_POST['delete_image'])){

    if($_SESSION['photo'] != "" && file_exists($_SESSION['photo'])){
        unlink($_SESSION['photo']);
    }

    $_SESSION['photo'] = "";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>User Panel</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{
    background:#dfe3e8;
    display:flex;
}

/* Sidebar */

.sidebar{
    width:220px;
    height:100vh;
    background:#1d2945;
    padding:20px;
    position:fixed;
}

.sidebar h2{
    color:white;
    margin-bottom:30px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:14px;
    margin-bottom:15px;
    border-radius:6px;
    background:#34495e;
}

.sidebar a:hover{
    background:blue;
}

.active{
    background:blue !important;
}

/* Main */

.main{
    margin-left:240px;
    width:100%;
    padding:40px;
}

.title{
    font-size:40px;
    margin-bottom:30px;
}

.top-box{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:20px;
    margin-bottom:40px;
}

.card{
    background:#2563eb;
    color:white;
    padding:25px;
    border-radius:12px;
}

.card h3{
    margin-bottom:10px;
}

.form-box{
    background:white;
    padding:30px;
    border-radius:12px;
}

.input-box{
    margin-bottom:20px;
}

.input-box label{
    display:block;
    margin-bottom:8px;
    font-weight:bold;
}

.input-box input{
    width:100%;
    padding:14px;
    border:none;
    background:#f1f1f1;
    border-radius:6px;
}

.btn{
    width:100%;
    padding:14px;
    border:none;
    border-radius:6px;
    color:white;
    font-size:18px;
    cursor:pointer;
    margin-top:10px;
}

.save-btn{
    background:green;
}

.delete-btn{
    background:red;
}

.image-box{
    text-align:center;
    margin-bottom:20px;
}

.image-box img{
    width:130px;
    height:130px;
    border-radius:50%;
    object-fit:cover;
}

.no-image{
    width:130px;
    height:130px;
    border-radius:50%;
    background:#ddd;
    display:flex;
    justify-content:center;
    align-items:center;
    margin:auto;
}

</style>

</head>

<body>

<!-- Sidebar -->

<div class="sidebar">

    <h2>User Panel</h2>

    <a href="index.php?page=dashboard"
    class="<?php if($page=="dashboard"){ echo 'active'; } ?>">
        Dashboard
    </a>

    <a href="index.php?page=profile"
    class="<?php if($page=="profile"){ echo 'active'; } ?>">
        Profile
    </a>

    <a href="index.php?page=detail"
    class="<?php if($page=="detail"){ echo 'active'; } ?>">
        Detail
    </a>

</div>

<!-- Main -->

<div class="main">

<?php

/* Dashboard */

if($page == "dashboard"){
?>

<h1 class="title">Dashboard</h1>

<div class="top-box">

    <div class="card">
        <h3>Name</h3>
        <p><?php echo $_SESSION['name']; ?></p>
    </div>

    <div class="card">
        <h3>Email</h3>
        <p><?php echo $_SESSION['email']; ?></p>
    </div>

</div>

<?php
}

/* Profile */

else if($page == "profile"){
?>

<h1 class="title">Profile</h1>

<div class="top-box">

    <div class="card">
        <h3>Phone</h3>
        <p><?php echo $_SESSION['phone']; ?></p>
    </div>

    <div class="card">
        <h3>City</h3>
        <p><?php echo $_SESSION['city']; ?></p>
    </div>

</div>

<?php
}

/* Detail */

else if($page == "detail"){
?>

<h1 class="title">Detail</h1>

<div class="form-box">

    <div class="image-box">

        <?php if($_SESSION['photo'] != "" && file_exists($_SESSION['photo'])){ ?>

            <img src="<?php echo $_SESSION['photo']; ?>">

        <?php } else { ?>

            <div class="no-image">No Image</div>

        <?php } ?>

    </div>

    <form method="POST" enctype="multipart/form-data">

        <div class="input-box">
            <label>Name</label>
            <input type="text" name="name"
            value="<?php echo $_SESSION['name']; ?>">
        </div>

        <div class="input-box">
            <label>Age</label>
            <input type="number" name="age"
            value="<?php echo $_SESSION['age']; ?>">
        </div>

        <div class="input-box">
            <label>Date of Birth</label>
            <input type="date" name="dob"
            value="<?php echo $_SESSION['dob']; ?>">
        </div>

        <div class="input-box">
            <label>Aadhar Number</label>
            <input type="text" name="aadhar"
            value="<?php echo $_SESSION['aadhar']; ?>">
        </div>

        <div class="input-box">
            <label>Upload Photo</label>
            <input type="file" name="photo">
        </div>

        <button type="submit"
        name="update"
        class="btn save-btn">

            Save Details

        </button>

    </form>

    <?php if($_SESSION['photo'] != ""){ ?>

    <form method="POST">

        <button type="submit"
        name="delete_image"
        class="btn delete-btn">

            Delete Image

        </button>

    </form>

    <?php } ?>

</div>

<?php
}
?>

</div>

</body>
</html>
