<?php
session_start();
include 'db_config.php';

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
    $id = $_GET['id'];
    $sql = "DELETE FROM tools WHERE tid= $id";
    $result = mysqli_query($conn, $sql);

    if ($result) 
    {
        header("location: admin_sl.php?msg=Data deleted successfully");
    } 
    else 
    {
        echo "Failed: " . mysqli_error($conn);
    }
}
else 
{
    echo "ID is missing.";
    exit();
}

?>