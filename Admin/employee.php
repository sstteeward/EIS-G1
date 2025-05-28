<?php
include 'db.php';

// Helper function to generate letter avatar with colored circle
function generateLetterAvatar($letter) {
    $colors = ['#1abc9c', '#2ecc71', '#3498db', '#9b59b6', '#e67e22', '#e74c3c'];
    $color = $colors[ord(strtoupper($letter)) % count($colors)];

    return "<div style='
        background-color: $color;
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 24px;
        user-select: none;
    '>" . strtoupper($letter) . "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="employee.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" href="assets/LOGO for title.png" />
  <title>Asian College EIS Admin - Employee List</title>
</head>
<body>
  <nav class="top-nav">
    <h2>Asian College EIS Admin</h2>
    <img src="assets/logo2-removebg-preview.png" alt="Logo" />
    <div class="menu">
      <img id="menuBtn" class="menuBtn" src="assets/menuIcon.png" alt="Menu Button" />
      <ul id="menuItems" class="menuItems">
        <li><a href="home.php">🏠 Home</a></li>
        <li><a href="notifications.php">🔔 Notifications</a></li>
        <li><a href="employee.php">🧑‍💼 Employee</a></li>
        <li><a href="addemployee.php">➕ Add New User</a></li>
        <li><a href="profile.php">👤 Profile</a></li>
      </ul>
    </div>
  </nav>

  <div class="main-content">
    <!-- Admin List -->
    <section id="admin-list">
      <h1 style="text-align: center;">Admin List</h1>
      <table class="employee-table" cellspacing="0" cellpadding="5" border="1" style="width:100%; border-collapse: collapse;">
        <thead>
          <tr>
            <th>Number</th>
            <th>Picture</th>
            <th>Employee ID</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Position</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql_admins = "SELECT * FROM admin_";
          $result_admins = mysqli_query($conn, $sql_admins);
          if ($result_admins && mysqli_num_rows($result_admins) > 0) {
              $counter = 1;
              while ($row = mysqli_fetch_assoc($result_admins)) {
                  echo "<tr>";
                  echo "<td>" . $counter++ . "</td>";
                  
                  // Show image or letter avatar for Admin
                  echo "<td>";
                  if (!empty($row['picture']) && file_exists('uploads/' . $row['picture'])) {
                      echo "<img src='uploads/" . htmlspecialchars($row['picture']) . "' alt='Profile' style='width:50px; height:50px; border-radius:50%; object-fit:cover;'>";
                  } else {
                      echo generateLetterAvatar($row['firstName'][0]);
                  }
                  echo "</td>";
                  
                  echo "<td>" . htmlspecialchars($row['employeeID']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['firstName']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['middleName']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['lastName']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['position']) . "</td>";
                  echo "<td>
                          <a href='editADMIN.php?id=" . urlencode($row['employeeID']) . "'>
                            <button class='action-btn edit-btn'>Edit</button>
                          </a>
                          <a href='deleteADMIN.php?id=" . urlencode($row['employeeID']) . "' onclick='return confirm(\"Are you sure you want to delete this Admin?\");'>
                            <button class='action-btn delete-btn'>Delete</button>
                          </a>
                        </td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='9' style='text-align:center;'>No Admins found.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </section>

    <!-- Employee List -->
    <section id="employee-list" style="margin-top: 60px;">
      <h1 style="text-align: center;">Employee List</h1>
      <table class="employee-table" cellspacing="0" cellpadding="5" border="1" style="width:100%; border-collapse: collapse;">
        <thead>
          <tr>
            <th>Number</th>
            <th>Picture</th>
            <th>Employee ID</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Position</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql_employees = "SELECT * FROM employeeuser";
          $result_employees = mysqli_query($conn, $sql_employees);
          if ($result_employees && mysqli_num_rows($result_employees) > 0) {
              $counter = 1;
              while ($row = mysqli_fetch_assoc($result_employees)) {
                  echo "<tr>";
                  echo "<td>" . $counter++ . "</td>";

                  // Show image or letter avatar for Employee
                  echo "<td>";
                  if (!empty($row['picture']) && file_exists('uploads/' . $row['picture'])) {
                      echo "<img src='uploads/" . htmlspecialchars($row['picture']) . "' alt='Profile' style='width:50px; height:50px; border-radius:50%; object-fit:cover;'>";
                  } else {
                      echo generateLetterAvatar($row['firstName'][0]);
                  }
                  echo "</td>";

                  echo "<td>" . htmlspecialchars($row['employeeID']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['firstName']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['middleName']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['lastName']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['position']) . "</td>";
                  echo "<td>
                          <a href='edit_employee.php?id=" . urlencode($row['employeeID']) . "'>
                            <button class='action-btn edit-btn'>Edit</button>
                          </a>
                          <a href='delete_employee.php?id=" . urlencode($row['employeeID']) . "' onclick='return confirm(\"Are you sure you want to delete this Employee?\");'>
                            <button class='action-btn delete-btn'>Delete</button>
                          </a>
                        </td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='9' style='text-align:center;'>No Employees found.</td></tr>";
          }
          mysqli_close($conn);
          ?>
        </tbody>
      </table>
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
  </script>
</body>
</html>
