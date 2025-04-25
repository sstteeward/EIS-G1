<?php
    include 'db.php';

    if (isset($_POST['submit'])) {
        $employeeID = $_POST['id'];
        $fullName = $_POST['fullname'];
        $email = $_POST['email'];
        $position = $_POST['position'];
        $sex = $_POST['sex'];

        $insert = mysqli_query($conn, "INSERT INTO employees (employeeID, fullName, email, position, sex) 
                                       VALUES ('$employeeID', '$fullName', '$email', '$position', '$sex')");

        if ($insert) {
            header("Location: employee.html"); 
            exit();
        } else {
            echo "Error inserting data: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid form submission.";
    }
?>
