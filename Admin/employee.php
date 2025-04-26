<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="employee.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/LOGO for title.png">
  <title>Asian College EIS Admin - Employee List</title>
</head>
<body>
  <nav class="top-nav">
    <h2>Asian College EIS Admin</h2>
    <img src="assets/logo2-removebg-preview.png" alt="Logo">
    <div class="menu">
      <img id="menuBtn" class="menuBtn" src="assets/menuIcon.png" alt="Menu Button" />
      <ul id="menuItems" class="menuItems">
        <li><a href="home.html">🏠 Home</a></li>
        <li><a href="notifications.html">🔔 Notifications</a></li>
        <li><a href="employee.php">🧑‍💼 Employees</a></li>
        <li><a href="addemployee.html">➕ Add New Employee</a></li>
        <li><a href="logout.php">🚪 Logout</a></li>
      </ul>
    </div>
  </nav>

  <div class="main-content">
    <section id="employee-list">
      <h1>🧑‍💼 Admin List</h1>
      <table class="employee-table">
        <thead>
          <tr>
            <th>Number</th>
            <th>Employee ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Position</th>
          </tr>
        </thead>
        <tbody>
          <?php
          
          include 'db.php'; 

          $sql = "SELECT * FROM employees"; 
          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
              $counter = 1;
              while($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>" . $counter++ . "</td>";
                  echo "<td>" . htmlspecialchars($row['employeeID']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['fullName']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['position']) . "</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='5'>No employees found.</td></tr>";
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
  </script>
</body>
</html>
