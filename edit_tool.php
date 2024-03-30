<?php
session_start();
include 'db_config.php';
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editToolButton"])) 
    {
        $id = $_GET['id'];
        $name = $_POST['toolname'];
        $desc = $_POST['description'];
        $category = $_POST['category'];
        $fee_d = $_POST['price-d'];
        $fee_w = $_POST['price-w'];
        $fee_m = $_POST['price-m'];
        $available = $_POST['availability'];
        $img = $_POST['timg'];


        $sql = "UPDATE tools SET toolname=?, description=?, category=?, `price-d`=?, `price-w`=?, `price-m`=?, availability=?, timg=? WHERE tid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiiiisi", $name, $desc, $category, $fee_d, $fee_w, $fee_m, $available, $img, $id);
        if ($stmt->execute()) 
        {
            header("Location: admin_sl.php?msg=Data updated successfully");
            exit();
        } 
        else 
        {
            echo "Failed: " . $stmt->error;
        }
    } 
    $sql = "SELECT * FROM category";
    $result = $conn->query($sql);
    
    $categories = array();
    while ($row = $result->fetch_assoc()) 
    {
        $categories[] = $row;
    }
if (isset($_GET['id'])) 
{
    $id = $_GET['id'];

    $sql = "SELECT * FROM tools WHERE tid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) 
    {
        $tool = $result->fetch_assoc();
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
        #availability,
        #category
        {
            width: 66.5%;
            border: 1px solid #ccc;
            padding: 5px;
        }
        #sopt
        {
            font-size:14px;
            text-align: center;
            padding: 2px;
        }
        #editToolButton
        {
            background-color: darkblue;
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
<div id="editToolModal">
    <div class="modal-content">
    <span class="close-button" onclick="redirectToAdmin()"> &times; </span>
        <h2 style="text-align:center;">Edit Tools</h2>
        <form action="edit_tool.php?id=<?php echo $_GET['id']; ?>" method="post">
            <div class="form-group">
                <input type="hidden" name="tid" value="<?php echo $tool['tid']; ?>">
                <label for="toolname">Tool Name:</label>
                <input type="text" name="toolname" id="toolname" value="<?php echo $tool['toolname']; ?>" required><br>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" required rows="5" cols="70"><?php echo $tool['description']; ?></textarea><br>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option id="sopt" value="<?php echo $tool['category']; ?>"><?php echo $tool['category']; ?></option>
                    <option id="sopt" value="">Select a option</option>
                    <?php if (!empty($categories)) : ?>
                        <?php foreach ($categories as $category) : ?>
                            <?php if ($category['cname'] !== $tool['category']) : ?>
                                <option id="sopt" value="<?php echo $category['cname']; ?>"><?php echo $category['cname']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="text-3">Sorry! We could not find anything related</p>
                    <?php endif; ?>
                </select>
                <br>
            </div>
            <div class="form-group">
                <label for="price-d">Price Daily:</label>
                <input type="text" name="price-d" id="price-d" value="<?php echo $tool['price-d']; ?>" required><br>
            </div>
            <div class="form-group">
                <label for="price-w">Price Weekly:</label>
                <input type="text" name="price-w" id="price-w" value="<?php echo $tool['price-w']; ?>" required><br>
            </div>
            <div class="form-group">
                <label for="price-m">Price Monthly:</label>
                <input type="text" name="price-m" id="price-m" value="<?php echo $tool['price-m']; ?>" required><br>
            </div>
            <div class="form-group">
                <label for="timg">Image:</label>
                <input type="text" name="timg" id="timg" value="<?php echo $tool['timg']; ?>" required><br>
            </div>
            <div class="form-group">
                <label for="availability">Availability:</label>
                <select name="availability" id="availability" required>
                    <option id="sopt" value="">Select</option>
                    <option id="sopt" value="1" <?php if ($tool['availability'] == '1') echo 'selected'; ?>>Available</option>
                    <option id="sopt" value="0" <?php if ($tool['availability'] == '0') echo 'selected'; ?>>Unavailable</option>
                </select><br>
            </div>
            <div class="form-group">
                <input type="submit" name="editToolButton" value="Update Tool" id="editToolButton">
            </div>
        </form>
    </div>
</div>
</body>
</html>