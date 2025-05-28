<?php
include 'db.php';
if (isset($_GET['employeeID'])) {
  $employeeID = mysqli_real_escape_string($conn, $_GET['employeeID']);

  $query = "SELECT * FROM employeeuser WHERE employeeID = '$employeeID'";
  $result = mysqli_query($conn, $query);

  if ($row = mysqli_fetch_assoc($result)) {
    $fullName = ucwords($row['firstName'] . ' ' . $row['middleName'] . ' ' . $row['lastName']);
  } else {
    echo "Employee not found.";
    exit;
  }
} else {
  echo "No employee ID provided.";
  exit;
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="viewProf.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="assets/LOGO for title.png" />
  <title>Asian College EIS</title>
</head>
<body>
  <nav class="top-nav">
    <h2>Asian College EIS View</h2>
    <img src="assets/logo2-removebg-preview.png" alt="Logo" />
    <div class="menu">
      <img id="menuBtn" class="menuBtn" src="assets/menuIcon.png" alt="Menu Button" role="button" aria-label="Toggle navigation menu" />
      <ul id="menuItems" class="menuItems">
        <li><a href="homeemployee.php">🏠 Home</a></li>
        <li><a href="notifEmp.php">🔔 Notifications</a></li>
        <li><a href="employee.php">🧑‍💼 Employee</a></li>
        <li><a href="profile.php">👤 Profile</a></li>
      </ul>
    </div>
</nav>

<h2><?php echo $fullName; ?>'s Profile</h2>
  <div class="profile-container">
    <p><strong>Employee ID:</strong> <?php echo $row['employeeID']; ?></p>
    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
    <p><strong>Position:</strong> <?php echo $row['position']; ?></p>
    <p><strong>Sex:</strong> <?php echo $row['sex']; ?></p>
    <p><strong>Registered On:</strong> <?php echo $row['registryDate']; ?></p>
    <p><strong>Status:</strong> <?php echo $row['status']; ?></p>
    <p><strong>Contact:</strong> <?php echo $row['contactNumber']; ?></p>
    <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
  </div>

  <script>
    const menuBtn = document.getElementById('menuBtn');
    const menuItems = document.getElementById('menuItems');
    let menuOpen = false;

    menuBtn.addEventListener('click', () => {
      menuOpen = !menuOpen;
      menuBtn.src = menuOpen ? 'assets/closeIcon.png' : 'assets/menuIcon.png';
      menuItems.classList.toggle('menuOpen', menuOpen);
    });

    menuItems.addEventListener('click', () => {
      menuOpen = false;
      menuBtn.src = 'assets/menuIcon.png';
      menuItems.classList.remove('menuOpen');
    });

  </script>
</body>
</html>
