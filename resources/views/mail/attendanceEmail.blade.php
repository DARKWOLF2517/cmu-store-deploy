<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h3>{{ $details['org_name'] }}</h3>
        </div>
        <div class="content">
            <p>Hi {{ $details['user_name'] }}!</p>
            <p>
                You have logged into session {{ $details['session'] }} of the attendance for the
                {{ $details['event_name'] }}.
            </p>
            <small>Date Attended: {{ $details['date'] }}</small>
            <br>
            <small>Time Attended: {{ $details['time'] }}</small>
        </div>
    </div>
</body>

</html>
