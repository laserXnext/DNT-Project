<?php
session_start();
include 'db_config.php';
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}


$emp = "SELECT * FROM employees ORDER BY emp_id";
$countemp = $conn->query($emp)->num_rows;
$emps = $conn->query($emp);

$employees = array();
while ($emprow = $emps->fetch_assoc()) 
{
    $employees[] = $emprow;
}

$tool = "SELECT * FROM tools ORDER BY tid";
$counttool = $conn->query($tool)->num_rows;
$tools = $conn->query($tool);

$tooldatas = array();
while ($trow = $tools->fetch_assoc()) 
{
    $tooldatas[] = $trow;  
}


$sql = "SELECT * FROM category";
$result = $conn->query($sql);

$categories = array();
while ($row = $result->fetch_assoc()) 
{
    $categories[] = $row;
}
$conn->close();
?>