<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- Name Validation ---
    if (empty($_POST["name"])) {
        echo "❌ Name is required.<br>";
    } else {
        $name = $_POST["name"];
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            echo "❌ Name must contain only letters and spaces.<br>";
        } else {
            echo "✅ Name: $name <br>";
        }
    }

    // --- Mobile Number Validation ---
    if (empty($_POST["mobile"])) {
        echo "❌ Mobile number is required.<br>";
    } else {
        $mobile = $_POST["mobile"];
        if (!preg_match("/^[0-9]*$/", $mobile)) {
            echo "❌ Mobile number must contain only digits.<br>";
        } elseif (strlen($mobile) != 10) {
            echo "❌ Mobile number must be exactly 10 digits.<br>";
        } else {
            echo "✅ Mobile: $mobile <br>";
        }
    }

    // --- Email Validation ---
    if (empty($_POST["email"])) {
        echo "❌ Email is required.<br>";
    } else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "❌ Invalid email format.<br>";
        } else {
            echo "✅ Email: $email <br>";
        }
    }
}
    // ---Password Validation---
    if (empty($_POST["password"])) {
        echo "❌ Password is required.<br>";
    } else {
        $password = $_POST["password"];
        if (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
            echo "❌ Password must contain only letters and numbers.<br>";
        } else {
            echo "✅ Password: $password <br>";
        }
    }
?>
