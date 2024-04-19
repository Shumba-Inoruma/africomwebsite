<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$data['subject']}}</title>
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
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #008000; /* Green */
        }

        h4 {
            margin-top: 10px;
            color: #008000; /* Green */
        }

        p {
            margin-top: 20px;
            color: #333; /* Dark Grey */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{$data['subject']}}</h1>
        <h4>{{$data['name']}}</h4>
        <h4>{{$data['email']}}</h4>
        <br><br>
        <p>{{$data['message']}}</p>
    </div>
</body>
</html>

