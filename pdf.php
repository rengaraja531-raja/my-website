<?php

include "connect.php";

if(isset($_POST['upload'])){

    $title = $_POST['title'];

    $pdf = $_FILES['pdf']['name'];

    $tmp = $_FILES['pdf']['tmp_name'];

    /* Create uploads folder */

    if(!file_exists("uploads")){

        mkdir("uploads",0777,true);

    }

    /* Rename PDF */

    $newname = time() . "_" . $pdf;

    /* Upload Path */

    $path = "uploads/" . $newname;

    /* Upload PDF */

    move_uploaded_file($tmp,$path);

    /* Insert Data */

    $sql = "INSERT INTO pdf_files(title,pdf)
            VALUES('$title','$newname')";

    if (mysqli_query($conn,$sql))
        {

        echo "<h3>PDF Uploaded Successfully</h3>";                       
        }else{
            echo "Database Error";

            }
}        

?>

<!DOCTYPE html>
<html>

<head>

<title>PDF Upload</title>

<style>

body{
    font-family:Arial;
    background:#f2f2f2;
}

.box{

    width:600px;
    background:white;
    margin:30px auto;
    padding:20px;
    border-radius:10px;
}

input{

    width:100%;
    padding:12px;
    margin-top:10px;
}

button{

    width:100%;
    padding:12px;
    margin-top:15px;
    background:blue;
    color:white;
    border:none;
    cursor:pointer;
}

table{

    width:100%;
    margin-top:20px;
    border-collapse:collapse;
}

table th,
table td{

    border:1px solid gray;
    padding:10px;
    text-align:center;
}

a{

    background:green;
    color:white;
    padding:8px 15px;
    text-decoration:none;
    border-radius:5px;
}

</style>

</head>

<body>

<div class="box">

<h2>Upload PDF</h2>

<form method="POST" enctype="multipart/form-data">

<input type="text"
       name="title"
       placeholder="Enter PDF Title"
       required>

<br>

<input type="file"
       name="pdf"
       accept=".pdf"
       required>

<br>

<button type="submit" name="upload">

Upload PDF

</button>

</form>

</div>

<div class="box">

<h2>PDF List</h2>

<table>

<tr>

<th>ID</th>

<th>Title</th>

<th>View</th>

</tr>

<?php

$sql = "SELECT * FROM pdf_files";

$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result))
    {

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['title']; ?></td>

<td>

<a href="viewpdf.php?id=<?php echo $row['id']; ?>">

View

</a>

</td>

</tr>

<?php

}

?>

</table>

</div>

</body>
</html>