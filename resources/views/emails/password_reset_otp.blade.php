<!DOCTYPE html>
<html>
<head>
    <style>
        .container {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .header {
            background-color: #A85C2E;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            padding: 30px;
            text-align: center;
            background-color: #ffffff;
        }
        .otp-code {
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 5px;
            color: #A85C2E;
            margin: 20px 0;
            padding: 15px;
            background-color: #f0f4f8;
            border-radius: 5px;
            display: inline-block;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ config('app.name') }}</h1>
        </div>
        <div class="content">
            <h2>Password Reset Verification</h2>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <p>Please use the following code to verify your request:</p>
            <div class="otp-code">{{ $code }}</div>
            <p>This code will expire in 60 minutes.</p>
            <p>If you did not request a password reset, no further action is required.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
