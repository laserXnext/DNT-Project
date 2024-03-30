<?php
session_start();
include 'db_config.php';

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) 
{
    $id = $_GET['id'];

    $sql = "SELECT * FROM employees WHERE emp_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) 
    {
        $employee = $result->fetch_assoc();
    } 
    else 
    {
        echo "No data found for this ID.";
        exit();
    }
} 
else 
{
    echo "ID is missing.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateEmployeeButton"])) 
{
    $id = $_POST['emp_id'];
    $emp_name = $_POST['emp_name'];
    $account_name = $_POST['account_name'];
    $account_no = $_POST['account_no'];
    $bank_name = $_POST['bank_name'];
    $salary = $_POST['salary'];
    $status = $_POST['loan_status'];

    $sql = "UPDATE employees SET emp_name=?, account_name=?, account_no=?, bank_name=?, salary=?, loan_status=? WHERE emp_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssi", $emp_name, $account_name, $account_no, $bank_name, $salary, $status, $id);

    if ($stmt->execute()) 
    {
        header("Location: admin_sl.php?msg=Data updated successfully");
        exit();
    } else {
        echo "Failed: " . $stmt->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Employee</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <script>
    function redirectToAdmin() 
    {
    window.location.href = 'admin_sl.php';
    }
    </script>
    <style>
        #addEmployeeModal
        {
            height: fit-content;
        }
        .icons 
        {
            text-align: center;
            font-size: 20px;
            color: #000;
            justify-content:space-around;
            padding: 0 10px;
            left: 25px;
            position: relative;
        }
        #loan_status
        {
            width: 66%;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
        }
        #sopt
        {
            font-size:14px;
            text-align: center;
            padding: 2px;
        }
        #addEmployeeButton
        {
            background-color:darkblue;
            color: white;
            padding: 10px 15px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div id="editEmployeeModal">
    <div class="modal-content">
    <span class="close-button" onclick="redirectToAdmin()"> &times; </span>
        <h2 style="text-align:center;">Edit Employee</h2>
        <form action="edit_employee.php?id=<?php echo $_GET['id']; ?>" method="post">
            <div class="form-group">
                <input type="hidden" name="emp_id" value="<?php echo $employee['emp_id']; ?>">
                <label for="emp_name">Employee Name:</label>
                <input type="text" name="emp_name" id="emp_name" value="<?php echo $employee['emp_name']; ?>" required><br>
            </div>
            <div class="form-group">
                <label for="account_name">Account Name:</label>
                <input type="text" name="account_name" id="account_name" value="<?php echo $employee['account_name']; ?>" required><br>
            </div>
            <div class="form-group">
                <label for="account_no">Account No:</label>
                <input type="text" name="account_no" id="account_no" value="<?php echo $employee['account_no']; ?>" required><br>
            </div>
            <div class="form-group">
                <label for="bank_name">Bank Name:</label>
                <input type="text" name="bank_name" id="bank_name" value="<?php echo $employee['bank_name']; ?>" required><br>
            </div>
            <div class="form-group">
                <label for="salary">Salary:</label>
                <input type="text" name="salary" id="salary" value="<?php echo $employee['salary']; ?>" required><br>
            </div>
            <div class="form-group">
                <label for="loan_status">Loan Status:</label>
                <select name="loan_status" id="loan_status" required>
                    <option id="sopt" value="">Select</option>
                    <option id="sopt" value="1" <?php if ($employee['loan_status'] == '1') echo 'selected'; ?>>Taken</option>
                    <option id="sopt" value="0" <?php if ($employee['loan_status'] == '0') echo 'selected'; ?>>Non-Taken</option>
                </select><br>
            </div>
            <div class="form-group">
                <input type="submit" name="updateEmployeeButton" value="Update Employee" id="addEmployeeButton">
            </div>
        </form>
    </div>
</div>
</body>
</html>