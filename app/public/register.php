<?php

    require_once '../vendor/autoload.php';

    use App\Page;

    $page = new Page();

    if (isset($_POST['send'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the form data
            $username = $_POST["username"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $address = $_POST["address"];
            $phoneNumber = $_POST["phone_number"];
            $electricityUsage = $_POST["electricity_usage"];
            $gasUsage = $_POST["gas_usage"];
            $agreeTerms = $_POST["agree_terms"]; // Agreement with terms and conditions
            
            // Perform validation and registration logic here
            
            // Connect to the database
            $servername = "localhost";
            $dbUsername = "your_username";
            $dbPassword = "your_password";
            $dbname = "your_database";
            
            $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Prepare and execute the SQL statement
            $stmt = $conn->prepare("INSERT INTO users (username, password, email, address, phone_number, electricity_usage, gas_usage, agree_terms) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $username, $password, $email, $address, $phoneNumber, $electricityUsage, $gasUsage, $agreeTerms);
            $stmt->execute();
            
            // Close the statement and connection
            $stmt->close();
            $conn->close();
            
            // Redirect to the main.php page after successful registration
            header("Location: main.php");
            exit;
        }}

    echo $page->render('register.html.twig', []);