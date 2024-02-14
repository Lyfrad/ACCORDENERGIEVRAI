<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();
    $msg = false;

    if(isset($_POST['send'])){
        session_start();
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];    
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row["password"])) {
                    $_SESSION["username"] = $username;
                    header("Location: main.php");
                    exit;
                }
            }
            
            $error = "Invalid username or password.";
            
            $stmt->close();
            $conn->close();
        }}




    echo $page->render('index.html.twig', ['msg' => $msg]);