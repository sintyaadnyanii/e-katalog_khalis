<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Email</title>
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

        .button {
            background-color: #455452;
            border: none;
            border-radius: 4px;
            color: white !important;
            cursor: pointer;
            display: inline-block;
            font-size: 16px;
            padding: 10px 20px;
            text-decoration: none;
            margin: 10px 0 10px 0;
        }

        .button,
        .button:visited,
        .button:hover,
        .button:active {
            color: white;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-content">
                <h1>Hello, {{ $name }}</h1>
                <hr>
                <p>Thank you so much for joining our e-catalog. We're offering some new products this month. Come visit
                    our website to find out more.</p>
            </div>
            <div>
                <a class="button" href="{{ $url }}">Visit now!</a>
            </div>
        </div>
    </div>
</body>

</html>
