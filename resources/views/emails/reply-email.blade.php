<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply For Customer's Feedback</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .card {
            padding: 20px;
        }

        .card-content {
            margin: 10px 0 10px 0;
        }

        h1 {
            color: #333333;
            font-size: 20px;
        }

        p {
            color: #333333;
            font-size: 16px;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-content">
                <h1>Hello, {{ $name }}</h1>
                <hr>
                <p>{{ strip_tags($reply_message) }}</p>
                <p>Your feedback:
                    {{ strip_tags($feedback_message) . ' (sent on ' . date_format($sent_date, 'd M Y') . ').' }}
                </p>
            </div>
        </div>
    </div>
</body>

</html>
