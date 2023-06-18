<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Email</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #455452;
            font-family: sans-serif;
        }

        .container {
            padding: 20px;
            margin: 0 auto;
            max-width: 600px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px 20px;
        }

        .card-content {
            margin: 0 0 30px 0;
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
                <p>You've registered your account on our website. Please verify your email address by clicking this
                    button</p>
            </div>
            <div>
                <a class="button" href="{{ $url }}">Confirm Email</a>
            </div>
            <div class="card-content">
                <hr>
                <p>If the the button doesn't work please copy this link:
                    <span>
                        <a href="{{ $url }}">{{ $url }}</a>
                    </span>
                </p>

            </div>
        </div>
    </div>
</body>

</html>
