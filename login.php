<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {//check if the form was submitted using POST
    $username = $_POST['username'];//retrieve the username from input
    $password = $_POST['password'];//retrieve password from the input
//database connection details
    $host = "localhost";// database server
    $db_password = "";// database password
    $db_username = "root";// database usernane
    $dbname = "nickson";

    $conn = new mysqli($host, $db_username, $db_password, $dbname);// establish a new connection to mysql
    if ($conn->connect_error) {// checks if the connection to database was succesfully
        die("Connection failed: " . $conn->connect_error);// display error and stop script execution
    }

    //sql query to insert data into table userss prapatred statement

    $query = "SELECT id, password FROM userss WHERE username = ?";
    $stmt = $conn->prepare($query);//prapare the sql statement to prevent injection

    if ($stmt) {//checks if the sql statement prapared succesfully
        $stmt->bind_param("s", $username);//bind input user to query
        $stmt->execute();//execute the sql query
        $stmt->store_result();// close the prepared statement

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user_id;

                $cookieParams = session_get_cookie_params();
                setcookie(
                    session_name(),
                    session_id(),
                    time() + 3600,
                    $cookieParams["path"],
                    $cookieParams["domain"],
                    true,
                    true
                );

                header("Location: logger.php");//redirect the users to logger.html after unsuccefull registration
                exit;
            } else {
                header("Location: failed.html");
                exit;
            }
        } else {
            header("Location: failed.html");//redirect the users to fail.html after unsuccefull registration
            exit;// ensure no further  script execution after redirection
        }
        $stmt->close();// close the statement after execution
    } else {
        die("Prepare failed: " . $conn->error);//Display an error message if SQL statement preparation fails
    }
    $conn->close();// close the database the database connection to free up resources
}
?>
