<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
        }

        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #000000;
            margin: 10px 0;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Email Verification</h1>
        <p>Dear User,</p>
        <p>Thank you for registering. To complete your registration, please use the following OTP:</p>
        <p class="otp-code">{{ $otp }}</p>
        <p>This OTP is valid for a limited time. Please do not share it with anyone.</p>
        <p>If you did not register on our platform, you can safely ignore this email.</p>
    </div>
</body>
</html>
