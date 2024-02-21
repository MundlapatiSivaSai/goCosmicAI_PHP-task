<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        form label {
            font-weight: bold;
            margin-top: 10px;
        }
        form input[type="text"],
        form input[type="email"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        form input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
<script>
    window.onload = function() {
        document.getElementById('registrationForm').onsubmit = function(event) {
            var name = document.getElementById('name').value.trim();
            var phone = document.getElementById('phone').value.trim();
            var email = document.getElementById('email').value.trim();
            var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
            var regexPhone = /^\d+$/; 

            // Validate name
            if (name.length === 0) {
                alert('Please enter your name.');
                event.preventDefault(); 
                return false;
            }

            // Validate phone
            if (!regexPhone.test(phone)) {
                alert('Please enter a valid phone number (digits only).');
                event.preventDefault(); 
                return false;
            }

            // Validate email
            if (!regexEmail.test(email)) {
                alert('Please enter a valid email address.');
                event.preventDefault(); 
                return false;
            }

            return true; 
        };
    };
</script>
</head>
<body>
<form id="registrationForm" action="process_registration.php" method="post">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" required><br>
    <label for="phone">Phone:</label><br>
    <input type="text" id="phone" name="phone" required><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br>
    <input type="submit" value="Register">
</form>
</body>
</html>