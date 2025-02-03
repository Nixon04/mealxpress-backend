<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction Receipt</title>
    <style>
          body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #EEE;
            overflow: hidden;
        }

        .email-container {
            width: 100%;
            background: #EEE;
            padding: 0px 0;
        }

        .email-box-pad {
            background: #fff;
            margin: 0 auto;
            max-width: 600px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .email-header-mail {
            background: #2D2942;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            text-align: center;
            color: #fff;
        }

        .body-content {
            padding: 10px;
            color: #333;
        }

        .text-center {
            text-align: center;
        }

        .bg-content-card {
            background: #f7f6ff;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .rb-row-pad {
            display: table;
            width: 100%;
            margin: 10px 0;
        }

        .rb-row-pad span, .rb-row-pad h5 {
            display: table-cell;
            vertical-align: middle;
            padding: 5px 0;
        }

        .rb-row-pad span:first-child, .rb-row-pad h5:first-child {
            text-align: left;
        }

        .rb-row-pad span:last-child, .rb-row-pad h5:last-child {
            text-align: right;
        }

        a {
            color: #2D2942;
            text-decoration: none;
            font-weight: bold;
        }

        @media (max-width: 600px) {
            .email-box-pad {
                width: 99%;
                padding: 15px;
            }
            .body-content{
              padding: 1px;
            }

            .email-header-mail h1 {
                font-size: 20px;
            }

            .body-content h4 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="email-box-pad">
            <!-- Header Section -->
            <div class="email-header-mail">
                <h4>Mealxpress</h4>
                <h1 style="color: #fff">Receipt for your purchase</h1>
            </div>

            <!-- Body Content -->
            <div class="body-content">
                <h4>Hello {{ $username }}</h4>
                <p>Details of your transaction are shown below:</p>

                <!-- Transaction Details -->
                <div class="bg-content-card">
                    <div class="rb-row-pad">
                        <span>Transaction Type</span>
                        <span>Online Shopping</span>
                    </div>
                    <hr style="border: none; border-top: 1px solid #ccc; margin: 10px 0;">
                    <div class="rb-row-pad">
                        <h5>Total Amount</h5>
                        <h5>₦{{ number_format($amount, 2, '.', ',') }}</h5>
                    </div>
                    <hr style="border: none; border-top: 1px solid #ccc; margin: 10px 0;">
                    <div class="rb-row-pad">
                        <h5>Reference</h5>
                        <h5>{{ $reference }}</h5>
                    </div>

                    <hr style="border: none; border-top: 1px solid #ccc; margin: 10px 0;">
                    <div class="rb-row-pad">
                        <h5>Delivery Code</h5>
                        <h5>{{ $token }}</h5>
                    </div>

                    <hr style="border: none; border-top: 1px solid #ccc; margin: 10px 0;">
                    <div class="rb-row-pad">
                        <h5>Date</h5>
                        <h5>{{ $dateissued }}</h5>
                    </div>


                    <hr style="border: none; border-top: 1px solid #ccc; margin: 10px 0;">
                    <div class="rb-row-pad">
                        <h5>Status</h5>
                        <h5>success</h5>
                    </div>
                </div>

                <hr style="border: none; border-top: 1px solid #ccc; margin: 20px 0;">

                <p class="text-center">Any Questions?</p>
                <p class="text-center">
                    Our Help Desk has answers to many of the most common questions about Mealxpress. 
                    Send us an email at <a href="mailto:info@mealxpress.ng">info@mealxpress.ng</a>.
                </p>
            </div>
        </div>
    </div>

</body>
</html>
