<?php
include 'dataretrive.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sri Lanka - Employee Management</title>
    <link href="uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
    <link href="uicons-brands/css/uicons-brands.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Madimi+One&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <style>
        #addEmployeeModal,.modal3
        {
            height: fit-content;
        }

        .icon
        {
            text-align: center;
            font-size: 20px;
            color: #000;
            padding-left: 4px;
            justify-content:space-around;
            position: relative;

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
        #loan_status,
        #category,
        #tool_status
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
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo-container">
            <img src="logo/DNT C LOGO low.png" alt="Company Logo">
        </div>
            <a href="#" class="active" onclick="openTab('dashboard', this)">Dashboard</a>
            <a href="#" onclick="openTab('employees', this)">Employees</a>
            <a href="#" onclick="openTab('salary', this)">Salary</a>
            <a href="#" onclick="openTab('projects', this)">Projects</a>
            <a href="#" onclick="openTab('renttools', this)">Rent Tools</a>
            <a href="#" onclick="openTab('feedbacks', this)">Feedbacks</a>
            <a href="#" onclick="openTab('careers', this)">Careers</a>
        <button id="backBtn">Back</button>
        <button id="visitBtn">Visit Website</button>
    </div>
    <div id="dashboard" class="tabContent">
        <div class="welcome">
            <h1>DASHBOARD - SRI LANKA</h1><br</br>
            <h3>WELCOME!</h3>
        </div>
        <div class="project-stats">
            <div class="completed-projects">
                <h3>Employees</h3>
                <p id="completedProjectsCount"><?php echo $countemp ?></p> 
            </div>
            <div class="ongoing-projects">
                <h3>Salary</h3>
                <p id="ongoingProjectsCount">0</p> 
            </div>
        </div>
        <div class="project-stats">
            <div class="completed-projects">
                <h3>Projects</h3>
                <p id="completedProjectsCount">0</p> 
            </div>
            <div class="ongoing-projects">
                <h3>Rent Tools</h3>
                <p id="ongoingProjectsCount"><?php echo $counttool ?></p>
            </div>
        </div>
        <div class="project-stats">
            <div class="completed-projects">
                <h3>Feedbacks</h3>
                <p id="completedProjectsCount">0</p>
            </div>
            <div class="ongoing-projects">
                <h3>Careers</h3>
                <p id="ongoingProjectsCount">0</p>
            </div>
        </div>
    </div>




    <div id="employees" class="tabContent">
    <!-- Employee details table and functionality here -->
    <!--Pamudi-->
    <div class="search-container">
            <input type="text" id="searchInput" style="opacity:0;" onkeyup="filterTable()" placeholder="Search Employee...">
            <button id="addEmployeeBtn">Add Employee</button>
        </div>
            <table id="table">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Account Name</th>
                    <th>Account No.</th>
                    <th>Bank-Branch</th>
                    <th>Salary</th>
                    <th>Loan-Status</th>
                    <th>Actions</th>
                </tr>
                <?php if (!empty($employees)) : ?>
                <?php foreach ($employees as $employee) : ?>
                <tr>
                    <td><?php echo $employee['emp_id']; ?></td>
                    <td><?php echo $employee['emp_name']; ?></td>
                    <td><?php echo $employee['account_name']; ?></td>
                    <td><?php echo $employee['account_no']; ?></td>
                    <td><?php echo $employee['bank_name']; ?></td>
                    <td><?php echo $employee['salary']; ?></td>
                    <td><?php echo ($employee['loan_status'] == 1) ? 'Taken' : 'Non-taken'; ?></td>
                    <td>
                        <a href="edit_employee.php?id=<?php echo $employee['emp_id'] ?>"><i class="uil uil-edit icons" id="i1"></i></a>
                        <a href="delete_employee.php?id=<?php echo $employee['emp_id'] ?>"><i class="uil uil-trash-alt icons" id="i2"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else : ?>
                    <p class="text-3">Sorry! We couldnot find anything related</p>
                <?php endif; ?>
            </table>
        </div>
    </div>

<!-- Add Employee Modal -->
<!--Pamudi-->
<div id="addEmployeeModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal()">&times;</span>
            <h2>Add New Employee</h2>
            <form id="addEmployeeForm" action="insert_employee.php" method="POST">
                <div class="form-group">
                    <label for="emp_name">Employee Name:</label><br>
                    <input type="text" id="emp_name" name="emp_name" required><br><br>
                </div>
                <div class="form-group">
                    <label for="account_name">Account Name:</label><br>
                    <input type="text" id="account_name" name="account_name" required><br><br>
                </div>
                <div class="form-group">
                    <label for="account_no">Account Number:</label><br>
                    <input type="text" id="account_no" name="account_no" required><br><br>
                </div>
                <div class="form-group">
                    <label for="bank_name">Bank Name:</label><br>
                    <input type="text" id="bank_name" name="bank_name" required><br><br>
                </div>
                <div class="form-group">
                    <label for="salary">Salary:</label><br>
                    <input type="text" id="salary" name="salary" required><br><br>
                </div>
                <div class="form-group" >
                    <label for="salary">Loan status:</label><br>
                    <select name="loan_status" id="loan_status" required>
                        <option id="sopt" value="">Select</option>
                        <option id="sopt" value="1">Taken</option>
                        <option id="sopt" value="0">Non-Taken</option>
                    </select><br>
                </div>
                <div class="form-group">
                    <input type="submit" value="Add Employee" id="addEmployeeButton">
                </div>
            </form>
        </div>
    </div>

<!-- Rent tools details and functionality here -->
<!--Lochana-->
    <div id="renttools" class="tabContent">
        <div>
            <button id="addToolBtn">Add Tool</button>
        </div>
        <table id="table">
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Category </th>
                <th>Description</th>
                <th>Availability </th>
                <th>Fee-Day</th>
                <th>Fee-Week</th>
                <th>Fee-Month</th>
                <th>Image</th>
                <th>Actions</th>

            </tr>
            <tr>
            <?php if (!empty($tooldatas)) : ?>
                <?php foreach ($tooldatas as $tooldata) : ?>
                <tr>
                    <td><?php echo $tooldata['tid']; ?></td>
                    <td><?php echo $tooldata['toolname']; ?></td>
                    <td><?php echo $tooldata['category']; ?></td>
                    <td><?php echo $tooldata['description']; ?></td>
                    <td><?php echo ($tooldata['availability'] == 1) ? 'Available' : 'Unavailable'; ?></td>
                    <td><?php echo $tooldata['price-d']; ?></td>
                    <td><?php echo $tooldata['price-w']; ?></td>
                    <td><?php echo $tooldata['price-m']; ?></td>
                    <td><?php echo $tooldata['timg']; ?></td>
                    <td>
                        <a href="edit_tool.php?id=<?php echo $tooldata['tid'] ?>"><i class="uil uil-edit icon" id="i1"></i></a>
                        <a href="delete_tool.php?id=<?php echo $tooldata['tid'] ?>"><i class="uil uil-trash-alt icon" id="i2"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else : ?>
                    <p class="text-3">Sorry! We couldnot find anything related</p>
                <?php endif; ?>
            </tr>
            </table>
    </div>

<!-- Add Tool Modal -->
<!--Lochana-->
<div id="addToolModal" class="modal3">
    <div class="modal-content3">
        <span class="close-button" onclick="closeModal3()">&times;</span>
        <h2>Add New Tool</h2>
        <form id="addToolForm" action="insert_tool.php" method="POST">
            <div class="form-group">
                <label for="item">Tool Name:</label>
                <input type="text" id="toolname" name="toolname" required>
            </div>
            <div class="form-group">
                <label for="description"> Description:</label>
                <textarea name="description" id="description" required rows="5" cols="70"></textarea><br>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option id="sopt" value="">Select</option>
                    <?php if (!empty($categories)) : ?>
                        <?php foreach ($categories as $category) : ?>
                            <option id="sopt" value="<?php echo $category['cname']; ?>"><?php echo $category['cname']; ?></option>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="text-3">Sorry! We couldnot find anything related</p>
                    <?php endif; ?>
                </select>
                <br>
            </div>
            <div class="form-group">
                <label for="price-d">Price Daily:</label>
                <input type="text" name="price-d" id="price-d" value="" required><br>
            </div>
            <div class="form-group">
                <label for="price-w">Price Weekly:</label>
                <input type="text" name="price-w" id="price-w" value="" required><br>
            </div>
            <div class="form-group">
                <label for="price-m">Price Monthly:</label>
                <input type="text" name="price-m" id="price-m" value="" required><br>
            </div>
            <div class="form-group">
                <label for="timg">Image:</label>
                <input type="text" name="timg" id="timg" value="" required><br>
            </div>
            <div class="form-group">
                <label for="availability">Availability:</label>
                <select name="availability" id="tool_status" required>
                    <option id="sopt" value="">Select</option>
                    <option id="sopt" value="1">Available</option>
                    <option id="sopt" value="0">Unavailable</option>
                </select><br>
            </div>
            <div class="form-group">
            <input type="submit" id="addToolButton" name="addToolButton"value="Add Tool">
            </div>
        </form>
    </div>
</div>

<!-- Salary details table and functionality here -->
<!--Pamudi-->
<div id="salary" class="tabContent">   
    <div class="search-container">
        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search Employee...">
    </div>
    <table id="table">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Loans</th>
            <th>Salary</th>
            <th>Net Salary</th>
        </tr>
    </table>
</div>

    <div id="projects" class="tabContent">
        <!-- Projects details and functionality here -->
        <!--Dulneth-->
            <div class="project-stats">
                <div class="completed-projects">
                    <h3>Completed Projects</h3>
                    <p id="completedProjectsCount">0</p> <!-- Replace with actual count -->
                </div>
                <div class="ongoing-projects">
                    <h3>Ongoing Projects</h3>
                    <p id="ongoingProjectsCount">0</p> <!-- Replace with actual count -->
                </div>
            </div>

    
                <table id="table">
                    <tr>
                        <th>No</th>
                        <th>Client</th>
                        <th>Location </th>
                        <th>Description</th>
                        <th>Status </th>
                    </tr>
                </table>
                <div>
                    <button id="addProjectBtn">Add Project</button>
                </div>
            </div>
        </div> 
    </div>


    
    <div id="feedbacks" class="tabContent">
    <!-- Feedbacks details and functionality here -->
    <!--Asheli-->
    <table id="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email </th>
            <th>Description</th>
        </tr>
        <tr>
            <td>01</td>
            <td>Item01</td>
            <td>####</td>
            <td>xxxxxxxxxxxx</td>
        </tr>
        <tr>
            <td>02</td>
            <td>Item02</td>
            <td>####</td>
            <td>xxxxxxxxxxxx</td>
        </tr>
        <tr>
            <td>03</td>
            <td>Item03</td>
            <td>####</td>
            <td>xxxxxxxxxxxx</td>
        </tr>
        <!-- Add more rows here -->
    </table>
</div>

<div id="careers" class="tabContent">
    <!-- Careers details and functionality here -->
    <!--Hirusha-->
    <div class="search-container">
        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search Job Role...">
    </div>
    <table id="table">
        <tr>
            <th>No</th>
            <th>Job Role</th>
            <th>Email Address</th>
            <th>CV</th>
        </tr>
        <tr>
            <td>01</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>02</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>03</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <!-- Add more rows here -->
    </table>
    <div class="advertisement-import">
        <h3>Import Advertisement</h3>
        <input type="file" id="advertisementFile" name="advertisementFile" accept="image/*,application/pdf">
        <button onclick="importAdvertisement()">Import</button>
    </div>
</div>

<!-- Add Project Modal -->
<!--Dulneth-->
<div id="addProjectModal" class="modal2">
    <div class="modal-content2">
        <span class="close-button" onclick="closeModal2()">&times;</span>
        <h2>Add New Project</h2>
        <form id="addProjectForm">
            <div class="form-group">
                <label for="client">Client:</label>
                <input type="text" id="client" name="client">
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description">
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="completed">Completed</option>
                    <option value="ongoing">Ongoing</option>
                </select>
            </div>
            <div class="form-group">
                <label for="projectImage">Upload Image:</label>
                <input type="file" id="projectImage" name="projectImage" accept="image/*">
            </div>
            <input type="submit" id="addProjectButton" value="Add Project">
        </form>
    </div>
</div>    
<script src="Js/script.js"></script>
</body>
</html>
