
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
        $conn = new mysqli('localhost', 'root', '', 'gatzschool');

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