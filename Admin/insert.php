<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $employeeID = $_POST['id'];
    $fullName = $_POST['fullname'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $sex = $_POST['sex'];
    $role = $_POST['role']; 

    if ($role == "Employee") {
        $insert = mysqli_query($conn, "INSERT INTO employeeuser (employeeID, fullName, email, position, sex) 
                                       VALUES ('$employeeID', '$fullName', '$email', '$position', '$sex')");
        if ($insert) {
            header("Location: employee.php");
            exit();
        } else {
            echo "Error inserting Employee: " . mysqli_error($conn);
        }
    } elseif ($role == "Admin") {
        
        $insert = mysqli_query($conn, "INSERT INTO employees (employeeID, fullName, email, position, sex) 
                                       VALUES ('$employeeID', '$fullName', '$email', '$position', '$sex')");
        if ($insert) {
            header("Location: employee.php"); 
            exit();
        } else {
            echo "Error inserting Admin: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid role selected.";
    }
} else {
    echo "Invalid form submission.";
}
?>
