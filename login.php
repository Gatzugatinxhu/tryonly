<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="login.css">

</head>
<body>
<main class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="post">
        <div class="input-group">
            <label>ID Number:</label>
           <input type="text" name="idno" placeholder="id_number" required>
           </div>
           <div class="input-group">
            <label>Password:</label>
            <input type="password" name="password" placeholder="password" required>
            </div>
            <button type="submit">Login Now</button>
        </form>
        <div class="signup">
            <a href="#">Forgot password?</a> | <a href="rigs.php">Signup Now</a>
         </div>
</main>

    <!-- PHP Code for Login with Role-Based Redirection -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_number = $_POST['id_number'];
        $password = $_POST['password'];

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'gatzschool');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch user information
        $sql = "SELECT * FROM registration WHERE id_number = '$id_number'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Role-based redirection
                if (strlen($id_number) > 1) {
                    header("Location: sidenav.html");
                } else {
                    header("Location: user_page.php");
                }
                exit();
            } else {
                echo "Invalid password";
            }
        } else {
            echo "No user found with that ID number";
        }

        $conn->close();
    }
    ?>
</body>
</html>
