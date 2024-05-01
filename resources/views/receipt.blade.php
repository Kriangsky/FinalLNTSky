<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="mb-4">Your Receipt</h1>
                <a href="{{ route('show')}}" class="btn btn-danger mb-3">Back to Cart</a>

                @if($carts->count() > 0)
                    @foreach($carts as $cart)
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/' . $cart->item->image) }}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $cart->item->name }}</h5>
                                        <p class="card-text">Price: Rp. {{ $cart->item->price }}</p>
                                        <p class="card-text">Total Items: {{ $cart->total_items }}</p>
                                        <p class="card-text">Address: {{ $cart->address }}</p>
                                        <p class="card-text">Postal Code: {{ $cart->postal_code }}</p>
                                        <p class="card-text">Subtotal: Rp. {{ $cart->item->price * $cart->total_items }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="alert alert-info">No items found in your receipt.</p>
                @endif
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
