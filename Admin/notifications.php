<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets\LOGO for title.png">
    <title>Asian College EIS Admin</title>
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