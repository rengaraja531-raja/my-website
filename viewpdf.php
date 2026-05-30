```php
<?php

include "connect.php";

$id = $_GET['id'];

$sql = "SELECT * FROM pdf_files WHERE id='$id'";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<body>

<embed src="uploads/<?php echo $row['pdf']; ?>"
       type="application/pdf"
       width="100%"
       height="700px">

</body>
</html>

