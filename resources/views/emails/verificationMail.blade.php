<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Email body and general styles */
        body {
            margin: 0;
            padding: 0;
            font-family: "Roboto", serif;
            font-weight: 400;
            font-style: normal;
            background: #EEE;
            width: 100%;
        }

        .email-container {
            width: 100%;
            background: #EEE;
            padding: 20px 0;
        }

        .email-box-pad {
            background: #fff;
            margin: 0 auto;
            max-width: 600px;
            padding: 20px;
            box-sizing: border-box;
            border-radius: 10px;
        }

        /* Mobile responsiveness */
        @media (max-width: 600px) {
            .email-box-pad {
                width: 95%;
                padding: 15px;
            }
            .email-header-mail h1 {
                font-size: 24px;
            }
            .border-pointer h4 {
                font-size: 20px;
            }
        }
        
        /* Header styles */
        .email-header-mail {
            background: #2D2942;
            padding: 20px;
            border-radius: 10px;
        }

        .email-header-mail h4 {
            color: #fff;
            font-weight: bold;
        }

        .email-header-mail h1 {
            color: #fff;
            font-weight: bold;
            margin-top: 10px;
        }

        /* Content styles */
        .body-content {
            padding: 20px;
            color: #333;
        }

        .fw-bold {
            font-weight: bold;
            font-size: 15px!important;
        }

        /* Centering OTP with Flexbox */
        .text-spacing {
            letter-spacing: 5px;
            word-spacing: 10px;
            font-weight: bold;
            font-size: 32px; /* Increased font size for better visibility */
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
        }

        /* Border around OTP */
        .border-pointer {
            background-color: #f1f1f1;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .text-dark {
            color: #000;
        }

        .email-dec {
            text-decoration: none;
            color: #2D2942;
            font-weight: bold;
        }

        /* Links */
        a {
            color: #2D2942;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="email-box-pad">
            <!-- Header Section -->
            <div class="email-header-mail">
                <h4>Mealxpress</h4>
                <h1>Email Verification Code</h1>
            </div>

            <!-- Body Content Section -->
            <div class="body-content">
                <h4>Hello {{ $username }}</h4>
                <p>To verify your account, please use the following one-time password (OTP):</p>

                <!-- OTP Display Section -->
                <div class="border-pointer">
                    <h4 class="fw-bold text-spacing">{{ $token }}</h4>
                </div>

                <p>If you did not initiate this request, please ignore this message.</p>

                <hr>

                <p>Any Questions?</p>
                <p>Our Help Desk has answers to many of the most common questions about Mealxpress. Send us an email at <a class="email-dec" href="mailto:info@mealxpress.ng">info@mealxpress.ng</a></p>
            </div>
        </div>
    </div>

</body>
</html>
