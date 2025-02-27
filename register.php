<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { //check if the form was submitted using the POST method
    $username = $_POST['username'];//retrieve the username from the submitted form
    $password = $_POST['password'];// retrieve the password from the submitted form

    // Hash the password before storing it in the database to enhance security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $host = "localhost";//database host
    $db_password = "";// database password
    $db_username = "root";//database username
    $dbname = "nickson";//Name of the database
    //create connection to the MySQL database

    $conn = new mysqli($host, $db_username, $db_password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);// stop execution if fails
    }
    //sql query to insert user data into the userss table using prepared statements

    $query = "INSERT INTO userss (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($query);//Prepare  the sql statement to prevent sql injection

    if ($stmt) {//Check if the sql statement was prepared successfully
        $stmt->bind_param("ss", $username, $hashed_password);//Bind parameters(username & hashed password) to the query
        $stmt->execute();//execute the prepared statement
        $stmt->close();//close the statement after execution
        header("Location: home.html");//redirect the user to home.html after succesful registration
    } else {
        die("Prepare failed: " . $conn->error);// Display error if SQL statement preparation fails
    }

    $conn->close();
    // Close database connection to free up resources
}
?>
