<?php
include 'function.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Parking Fee Calculator</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Parking Fee Calculator</h2>
    <form method="post" action="">
        Enter Reg No: <input type="text" name="regNo" required><br><br>
        In date: <input type="datetime-local" name="inDate" required><br><br>
        Out date: <input type="datetime-local" name="outDate" required><br><br>
        <input type="submit" name="calculate" value="Calculate Duration">
    </form>

    <?php
    include 'park_fee.php';
    ?>
</body>
</html>
