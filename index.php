<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="LOGO for title.png">
    <title>Asian College EIS</title>
</head>
<body>
    <div>
        <header>
            <div class="logo">
                <img src="assets/logo.png" alt="Asian College Logo">
            </div>
            <div class="title">
                <h1>Asian College EIS</h1>
            </div>
        </header>

        <div class="role-selection">
            <h2>Select Your Role</h2>
            <select id="role-select">
                <option value="" disabled selected>Select Role</option>
                <option value="admin">Admin</option>
                <option value="employee">Employee</option>
            </select>
        </div>

        <div class="login hidden" id="login-form">
            <form action="login.php" method="post">

                <input type="hidden" name="role" id="role-input">

                <div class="login-title">
                    <h2>Login</h2>
                </div>
                <div class="login-input">
                    <input type="text" name="email" placeholder="Email" required>
                </div>
                <div class="login-input">
                    <input type="text" name="id" placeholder="ID" maxlength="20" required>
                </div>
                <div class="login-button">
                    <button type="submit" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const roleSelect = document.getElementById('role-select');
        const loginForm = document.getElementById('login-form');
        const roleInput = document.getElementById('role-input');

        roleSelect.addEventListener('change', function () {
            const selectedRole = this.value;
            if (selectedRole) {
                roleInput.value = selectedRole;
                loginForm.classList.remove('hidden');
            }
        });

    </script>
    
</body>
</html>