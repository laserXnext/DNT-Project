<?php
session_start();
include 'db_config.php';

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "INSERT INTO tools (`toolname`, `description`, `category`, `price-d`, `price-w`, `price-m`, `availability`, `timg`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
if ($stmt = mysqli_prepare($conn, $sql)) 
{
    mysqli_stmt_bind_param($stmt, "sssiiiss", $name, $desc, $category, $fee_d, $fee_w, $fee_m, $available, $img);

    $name = $_POST['toolname'];
    $desc = $_POST['description'];
    $category = $_POST['category'];
    $fee_d = $_POST['price-d'];
    $fee_w = $_POST['price-w'];
    $fee_m = $_POST['price-m'];
    $available = $_POST['availability'];
    $img = $_POST['timg'];

    if (mysqli_stmt_execute($stmt)) 
    {
        echo "Tool added successfully.";
        header('location:admin_sl.php');
    } else 
    {
        echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
}

$conn->close();
?>
