<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" href="icon.jpeg" type="image/x-icon">
</head>
<body>
<header id="main-header">
    <!-- Logo with a link to the homepage -->
    <a href="../res/index.html">
        <h2 class="logo"></h2>
    </a>
    <!-- Navigation menu -->
    <nav class="navigation">
        <a href="../index.html">Home</a> 
        <a href="login.php">Log In</a>
    </nav>
</header>

<!-- Login form -->
<form action="login.php" method="post">
    <h2>LOGIN</h2>
    <?php if (isset($_GET['error'])) { ?>
        <!-- Display error message if provided in URL parameter -->
        <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php } ?>
    <label>Email</label>
    <!-- Input field for email -->
    <input type="email" name="email" placeholder="Email" required><br>

    <label>Password</label>
    <!-- Input field for password -->
    <input type="password" name="password" id="passwordField" placeholder="Password" required onpaste="return false;">
    <!-- Toggle password visibility -->
    <img src="open.png" id="showPassword" onclick="togglePasswordVisibility()" alt="Show Password" style="width: 20px; float: right; margin-right:10px; position:relative; top: -35px; right:10px; cursor:pointer;">
    <img src="close.png" id="hidePassword" onclick="togglePasswordVisibility()" alt="Hide Password" style="display: none; width: 20px; float: right; margin-right:10px; position:relative; top: -35px; right:10px; cursor: pointer;">
    <br>
        <br>
    <!-- Submit button -->
    <button type="submit" style="position:relative;">Login</button>
    <!-- Link to password reset page -->
    <a href="forgot.php">Forgot Password?</a>
</form>

<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("passwordField");
        var showPassword = document.getElementById("showPassword");
        var hidePassword = document.getElementById("hidePassword");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            showPassword.style.display = "none";
            hidePassword.style.display = "inline";
        } else {
            passwordField.type = "password";
            showPassword.style.display = "inline";
            hidePassword.style.display = "none";
        }
    }
</script>

</body>
</html>
