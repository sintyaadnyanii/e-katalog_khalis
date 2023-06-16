<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Email</title>
    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #455452;
            font-family: sans-serif;
        }

        .card {
            background-color: white;
            padding: 2rem;
            text-align: center;
            width: 80vw;
            margin: 2rem;
            border-radius: 0.5rem;
        }

        .button {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #455452;
            color: #FFFFFF;
            text-decoration: none;
            font-weight: 500;
            border-radius: 0.25rem;
        }
    </style>

</head>

<body>
    <div class="card">
        <h3>Hello, {{ $name }}</h3>
        <hr>
        <p>Thank you so much for joining our e-catalog. We are offering some new products this month. Come visit our
            website to find out more.</p>
        <a class="button" href="{{ route('main') }}">Visit Now</a>
    </div>
</body>

</html>
