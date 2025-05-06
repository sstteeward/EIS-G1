<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/LOGO for title.png">
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

  <div class="main-content">
    <section id="add-employee">
      <h1>➕ Add New Employee/Admin</h1>
      <form action="insert.php" method="post" enctype="multipart/form-data>
        
        <label for="id">Employee ID:</label>
        <input type="text" id="id" name="id" required>

        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="position">Position:</label>
        <input type="text" id="position" name="position" required>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
          <option value="">-- Select Role --</option>
          <option value="Employee">Employee</option>
          <option value="Admin">Admin</option>
        </select>

        <label>Sex:</label>
        <div class="radio-group">
          <label class="radio-option">
            <input type="radio" id="male" name="sex" value="male" required>
            <span class="radio-custom"></span>
            <span class="radio-text">Male</span>
          </label>
        
          <label class="radio-option">
            <input type="radio" id="female" name="sex" value="female" required>
            <span class="radio-custom"></span>
            <span class="radio-text">Female</span>
          </label>
        </div>

        <label for="profile">Picture:</label>
        <input type="file" name="profile" id="profile" accept="image/*" required>

        <img id="previewImg" src="#" alt="Preview" style="max-width: 150px; display: none; margin-top: 10px;">

        <div class="wrapper" id="previewWrapper" style="display:none;">
          <a id="imagePreviewLink" target="_blank">
            <img id="preview" alt="Image Preview">
          </a>
        </div>



        <button type="submit" name="submit">Add</button>
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