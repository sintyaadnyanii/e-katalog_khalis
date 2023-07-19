<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        table,
        td,
        th {
            border: 1px solid;
            padding: 4px
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: center;
        }

        td {
            font-size: 14 px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        h3 {
            text-align: center;
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>

    <h3>{{ 'Khalis Bali Bamboo Product Report ' . date('Y') }} </h3>
    <table>
        <tr>
            <th>No.</th>
            <th>Product Code</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Wishlist</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td class="text-center">{{ $loop->iteration . '.' }}</td>
                <td class="text-center">{{ $product->product_code }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td class="text-right">{{ pricing($product->price) }}</td>
                <td class="text-right">{{ $product->wishlists_count }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
