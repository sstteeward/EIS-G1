<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $imagePath = $row['picture'];  
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $imgName = basename($_FILES['picture']['name']);
        $tmpName = $_FILES['picture']['tmp_name'];
        $uploadDir = "uploads/";
        $imagePath = $uploadDir . time() . "_" . $imgName;
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        move_uploaded_file($tmpName, $imagePath);
    }
    $employeeID = $_POST['id'];
    $fullName = $_POST['fullname'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $sex = $_POST['sex'];
    $role = $_POST['role'];


    if ($role == "Employee") {
        $insert = mysqli_query($conn, "INSERT INTO employeeuser (picture, employeeID, fullName, email, position, sex) 
                                       VALUES ('$imagePath', '$employeeID', '$fullName', '$email', '$position', '$sex')");
        if ($insert) {
            header("Location: employee.php");
            exit();
        } else {
            echo "Error inserting Employee: " . mysqli_error($conn);
        }
    } elseif ($role == "Admin") {
        $insert = mysqli_query($conn, "INSERT INTO employees (picture, employeeID, fullName, email, position, sex) 
                                       VALUES ('$imagePath', '$employeeID', '$fullName', '$email', '$position', '$sex')");
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