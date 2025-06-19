<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 50px auto; padding: 20px; background: #f5f5f5; }
        h1 { color: #333; text-align: center; margin-bottom: 20px; }
        form { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="password"] { display: block; margin-bottom: 5px; font-weight: bold; }
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
    <h1>Welcome to Login</h1>
    <form action="#" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
<footer>
    <p style="text-align: center;"> &copy; 2025 Reserved By Inovyra Pvt. Ltd.</p>
</footer>
</html>