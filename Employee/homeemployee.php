<html lang="en">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="profileEmp.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="assets/LOGO for title.png" />
  <title>Asian College EIS</title>
</head>
<body>
  <nav class="top-nav">
    <h2>Asian College EIS Home</h2>
    <img src="assets/logo2-removebg-preview.png" alt="Logo" />
    <div class="menu">
      <img id="menuBtn" class="menuBtn" src="assets/menuIcon.png" alt="Menu Button" role="button" aria-label="Toggle navigation menu" />
      <ul id="menuItems" class="menuItems">
        <li><a href="homeemployee.php">🏠 Home</a></li>
        <li><a href="notifEmp.php">🔔 Notifications</a></li>
        <li><a href="employee.php">🧑‍💼 Employee</a></li>
        <li><a href="profileEmp.php">👤 Profile</a></li>
      </ul>
    </div>
</nav>

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
