<?php
session_start();
include 'db_config.php';

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "INSERT INTO employees (emp_name, account_name, account_no, bank_name, salary,loan_status) VALUES (?, ?, ?, ?, ?, ?)";

if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "ssisis", $emp_name, $account_name, $account_no, $bank_name, $salary, $status);

    $emp_name = $_POST['emp_name'];
    $account_name = $_POST['account_name'];
    $account_no = $_POST['account_no'];
    $bank_name = $_POST['bank_name'];
    $salary = $_POST['salary'];
    $status = $_POST['loan_status'];

    if (mysqli_stmt_execute($stmt)) 
    {
        echo "Employee added successfully.";
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
