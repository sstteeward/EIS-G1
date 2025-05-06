<?php
include 'db.php';

if (isset($_GET['id'])) {
    $employeeID = $_GET['id'];
    $query = "SELECT * FROM employees WHERE employeeID = '$employeeID'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $fullName = $_POST['fullname'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $sex = $_POST['sex'];

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

    $updateQuery = "UPDATE employees SET fullName = '$fullName', email = '$email', position = '$position', sex = '$sex', picture = '$imagePath' WHERE employeeID = '$employeeID'";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: employee.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="editADMIN.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/LOGO for title.png">
  <title>Edit | Asian College EIS Admin</title>
</head>
<body>
<nav class="top-nav">
    <h2>Asian College EIS Admin</h2>
    <img src="assets/logo2-removebg-preview.png" alt="Logo">
    <div class="menu">
      <img id="menuBtn" class="menuBtn" src="assets/menuIcon.png" alt="Menu Button" />
      <ul id="menuItems" class="menuItems">
        <li><a href="home.php">🏠 Home</a></li>
        <li><a href="notifications.php">🔔 Notifications</a></li>
        <li><a href="employee.php">👨‍💼 Employee</a></li>
        <li><a href="addemployee.php">➕ Add New Employee</a></li>
        <li><a href="#" onclick="confirmLogout()">🚪 Logout</a></li>
      </ul>
    </div>
  </nav>

  <div class="main-content">
    <section id="edit-admin">
        <h1>✏️ Edit Admin</h1>
        <form method="POST" enctype="multipart/form-data">
        
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($row['fullName']) ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required>
            
            <label for="position">Position:</label>
            <input type="text" id="position" name="position" value="<?= htmlspecialchars($row['position']) ?>" required>
            
            <label for="sex">Sex:</label>
            <div class="radio-group">
                <label class="radio-option">
                    <input type="radio" id="male" name="sex" value="Male" <?= ($row['sex'] == 'Male') ? 'checked' : '' ?> required>
                    <span class="radio-custom"></span>
                    <span class="radio-text">Male</span>
                </label>
            
                <label class="radio-option">
                    <input type="radio" id="female" name="sex" value="Female" <?= ($row['sex'] == 'Female') ? 'checked' : '' ?> required>
                    <span class="radio-custom"></span>
                    <span class="radio-text">Female</span>
                </label>
            </div>
            
            <label for="picture">Profile Picture:</label>
            <input type="file" name="picture" id="profile" accept="image/*"><br>
            
            <img src="<?= htmlspecialchars($row['picture']) ?>" alt="Current Profile Image" style="width: 50px; height: 50px; border-radius: 50%; margin-top: 10px;"><br>

            <button type="submit" name="update">Update Admin</button>
        </form>
    </section>
</div>


    <script>
    const menuBtn = document.getElementById('menuBtn');
    const menuItems = document.getElementById('menuItems');

    let menuOpen = false;

    menuBtn.addEventListener('click', () => {
      menuOpen = !menuOpen;
      if (menuOpen) {
        menuBtn.src = 'assets/closeIcon.png'; 
        menuItems.classList.add('menuOpen');
      } else {
        menuBtn.src = 'assets/menuIcon.png'; 
        menuItems.classList.remove('menuOpen');
      }
    });

    menuItems.addEventListener('click', () => {
      menuOpen = false;
      menuBtn.src = 'assets/menuIcon.png';
      menuItems.classList.remove('menuOpen');
    });

    function confirmLogout() {
      if (confirm("Are you sure you want to logout?")) {
          window.location.href = "logout.php";
      }
    }

    document.getElementById('profile').onchange = function (event) {
      const [file] = this.files;
      if (file) {
        const preview = document.getElementById('previewImg');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
      }
    };
  </script>
</body>
</html>