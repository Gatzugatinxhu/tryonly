<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="password"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Registration</h2>
        <form action="insert.php" method="post">
            <label>ID Number:</label>
            <input type="text" name="id_number" required>

            <label>Last Name:</label>
            <input type="text" name="lastname" required>

            <label>First Name:</label>
            <input type="text" name="firstname" required>

            <label>Course:</label>
            <select name="course" required>
                <option value="BSIT">BSIT</option>
                <option value="BSIS">BSIS</option>
                <option value="BSAIS">BSAIS</option>
                <option value="BSBA">BSBA</option>
            </select>

            <label>Year Level:</label>
            <select name="year_level" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>

            <label>Password:</label>
            <input type="password" name="password" minlength="8" required>

            <input type="submit" value="Register">
        </form>
    </div>

    <!-- PHP Code to Insert Data into MySQLi Database -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_number = $_POST['id_number'];
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $course = $_POST['course'];
        $year_level = $_POST['year_level'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'your_database_name');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert query
        $sql = "INSERT INTO registration (id_number, lastname, firstname, course, year_level, password) 
                VALUES ('$id_number', '$lastname', '$firstname', '$course', '$year_level', '$password')";

        if ($conn->query($sql) === TRUE) {
            header('Location: login.php'); // Redirect to login page after successful registration
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>
