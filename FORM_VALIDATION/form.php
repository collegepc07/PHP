<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM VALIDATION TESTING</title>
    <style>
        body { font-family: cursive; max-width: 400px; margin: 50px auto; padding: 20px; background: #f5f5f5; }
        h1 { color: #333; text-align: center; margin-bottom: 20px; }
        form { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        div { margin-bottom: 15px; }
        input[type="text"] { margin-bottom: 5px; font-weight: bold; width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        input[type="email"] { margin-bottom: 5px; font-weight: bold; width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        input[type="password"] { margin-bottom: 5px; font-weight: bold; width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { 
            background: rgb(20, 27, 21);
            color: white; 
            padding: 10px 15px; 
            border: none; 
            border-radius: 4px; 
            width: 100%; 
            font-size: 16px; 
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="validation.php" method="post">
            First Name:
            <input type="text" id="Fname" name="Fname" required><br><br>
            Last Name:
            <input type="text" id="Lname" name="Lname" required><br><br>
            Mobile Number:
            <input type="text" id="mobile" name="mobile" required><br><br>  
            Email:
            <input type="email" id="email" name="email" required><br><br>
            Password:
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>