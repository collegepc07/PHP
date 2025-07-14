<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Advanced PHP Form Validation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        form {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            font-size: 16px;
            border: 1.5px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #2980b9;
            outline: none;
        }
        .error {
            color: #e74c3c;
            font-size: 0.9em;
            margin-top: 4px;
            display: block;
        }
        .success {
            background-color: #2ecc71;
            color: white;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }
        input[type="submit"] {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #1f618d;
        }
    </style>
</head>
<body>

<?php
// Initialize variables and errors
$firstName = $lastName = $age = $password = $email = "";
$firstNameErr = $lastNameErr = $ageErr = $passwordErr = $emailErr = "";
$successMessage = "";
$valid = true;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize inputs
    $firstName = test_input($_POST["firstName"] ?? "");
    $lastName  = test_input($_POST["lastName"] ?? "");
    $age       = test_input($_POST["age"] ?? "");
    $password  = $_POST["password"] ?? "";  // password left raw for length check
    $email     = test_input($_POST["email"] ?? "");

    // Validate First Name
    if (empty($firstName)) {
        $firstNameErr = "First name is required.";
        $valid = false;
    } elseif (!preg_match("/^[a-zA-Z-' ]+$/", $firstName)) {
        $firstNameErr = "Only letters, apostrophes, hyphens, and spaces allowed.";
        $valid = false;
    }

    // Validate Last Name
    if (empty($lastName)) {
        $lastNameErr = "Last name is required.";
        $valid = false;
    } elseif (!preg_match("/^[a-zA-Z-' ]+$/", $lastName)) {
        $lastNameErr = "Only letters, apostrophes, hyphens, and spaces allowed.";
        $valid = false;
    }

    // Validate Age
    if (empty($age)) {
        $ageErr = "Age is required.";
        $valid = false;
    } elseif (!preg_match("/^\d+$/", $age)) {
        $ageErr = "Only numeric digits allowed.";
        $valid = false;
    }

    // Validate Password Length
    $passwordLen = strlen($password);
    if (empty($password)) {
        $passwordErr = "Password is required.";
        $valid = false;
    } elseif ($passwordLen < 6 || $passwordLen > 12) {
        $passwordErr = "Password must be between 6 and 12 characters.";
        $valid = false;
    }

    // Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    }
    
    // If all inputs are valid
    if ($valid) {
        $successMessage = "Form submitted successfully!";
        // Clear inputs (optional)
        $firstName = $lastName = $age = $password = $email = "";
    }
}

// Sanitization function
function test_input(string $data): string {
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
?>

<h2>Advanced PHP Form Validation</h2>

<?php if ($successMessage): ?>
    <div class="success"><?php echo $successMessage; ?></div>
<?php endif; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
    <div class="form-group">
        <label for="firstName">First Name <span style="color:#e74c3c;">*</span></label>
        <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>" required />
        <?php if ($firstNameErr): ?>
            <span class="error"><?php echo $firstNameErr; ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="lastName">Last Name <span style="color:#e74c3c;">*</span></label>
        <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>" required />
        <?php if ($lastNameErr): ?>
            <span class="error"><?php echo $lastNameErr; ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="age">Age <span style="color:#e74c3c;">*</span></label>
        <input type="text" id="age" name="age" value="<?php echo $age; ?>" required />
        <?php if ($ageErr): ?>
            <span class="error"><?php echo $ageErr; ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="password">Password <span style="color:#e74c3c;">*</span></label>
        <input type="password" id="password" name="password" value="" required />
        <?php if ($passwordErr): ?>
            <span class="error"><?php echo $passwordErr; ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="email">Email <span style="color:#e74c3c;">*</span></label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required />
        <?php if ($emailErr): ?>
            <span class="error"><?php echo $emailErr; ?></span>
        <?php endif; ?>
    </div>

    <input type="submit" value="Submit" />
</form>

</body>
</html>
