<html>
    <head>
        <title>File Form</title>
        <style>
            body {
                position: relative;
                margin: 100px;
                font-family: cursive;
            }
            .container {
                position: relative;
                margin: 100px;
                height: 250px;
                width: 400px;
                background-color:rgb(255, 255, 255);
                border-radius: 10px;
                box-shadow: 0 9px 14px rgba(8, 7, 7, 0.1);
                padding: 20px;
                text-align: center;
                font-size: 16px;


            }input[type="file"] {
                width: 100%;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ddd;
            }
            input[type="submit"] {
                background-color:rgb(   255, 255, 255);
                color: #000;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                font-family: cursive;
                font-size: 16px;
                margin-top: 20px; 
                margin-bottom: 20px;
            }
            </style>
</head>
<body>
    <div Class="container">
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <h3 style="color: #333;">Choose Your File To Upload..</h3>
        <input type="file" name="file">
        <input type="submit" value="Upload File">
    </form>

<footer>
    <p style="text-align: center;">&copy; 2025 Reserved By Inovyra Pvt. Ltd.</p>
</footer>
</body> 
</div>

</html>