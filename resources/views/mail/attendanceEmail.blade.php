<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .header {
            background-color: #60b192;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            padding: 20px;
        }

        .small {
            color: #969696;
        }

        .footer {
            text-align: center;
            padding-top: 10px;
            border-top: 1px solid #ccc;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h3>{{ $details['org_name'] }}</h3>
        </div>
        <div class="content">
            <p>Hi <b>{{ $details['user_name'] }}</b>!</p>
            <p>
                You have logged into session <b>{{ $details['session'] }}</b> of the attendance for the
                <b>{{ $details['event_name'] }}</b> .
            </p>
            <small>Date Attended: <b>{{ $details['date'] }}</b></small>
            <br>
            <small>Time Attended: <b>{{ $details['time'] }}</b></small>
        </div>
        <div class="footer">
            <p>&copy; 2024 CMU-STORE-AMS</p>
        </div>
    </div>
</body>

</html>
