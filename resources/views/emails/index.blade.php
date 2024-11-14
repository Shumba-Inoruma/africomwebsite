<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Africom</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #e0e0e0; /* Light gray background */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #008000;
            text-align: center;
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .info-label, .info-value {
            font-size: 16px;
            font-weight: normal;
            color: #333;
        }

        .info-label {
            font-weight: bold;
            color: #555;
            margin-right: 10px; /* Uniform spacing between label and data */
        }

        .message-section {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Africom</h1>

        <div class="info-item">
            <span class="info-label">Name:</span>
            <span class="info-value">{{$data['name']}}</span>
        </div>

        <div class="info-item">
            <span class="info-label">Surname:</span>
            <span class="info-value">{{$data['surname']}}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Product:</span>
            <span class="info-value">{{$data['product']}}</span>
        </div>


        <div class="info-item">
            <span class="info-label">Phone:</span>
            <span class="info-value">{{$data['phone']}}</span>
        </div>

        <div class="info-item">
            <span class="info-label">Gender:</span>
            <span class="info-value">{{$data['gender']}}</span>
        </div>

        <div class="info-item">
            <span class="info-label">Email:</span>
            <span class="info-value">{{$data['email']}}</span>
        </div>

        <div class="info-item">
            <span class="info-label">Location:</span>
            <span class="info-value">{{$data['location']}}</span>
        </div>

        <div class="message-section">
        <h1>Message:</h1>
            <p class="info-value" style="margin-top: 5px;">{{$data['message']}}</p>
        </div>
    </div>
</body>
</html>
