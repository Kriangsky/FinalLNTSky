<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <a href="{{ route('show')}}" class="btn btn-danger mb-3">Back to Cart</a>
                @if($carts->where('status', 'active')->count() > 0)
                <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#checkoutModal">Checkout</button>
                @else 
                <button type="button" class="btn btn-secondary mb-3">Cart Empty</button>
                @endif
                <a href="{{ route('receipt')}}" class="btn btn-primary mb-3">See Receipt</a>
                <h1 class="mb-4">Your Cart</h1>
                @if($carts->count() > 0)
                    @foreach($carts as $cart)
                        @if($cart->status == "active")  
                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <img src="{{ asset('storage/' . $cart->item->image) }}" class="card-img" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $cart->item->name }}</h5>
                                            <h5 class="card-title">{{ $cart->item->status }}</h5>
                                            <p class="card-text">Price: Rp. {{ $cart->item->price }}</p>
                                            <p class="card-text">Total Items: {{ $cart->total_items }}</p>
                                            <p class="card-text">Subtotal: Rp. {{ $cart->item->price * $cart->total_items }}</p>
                                            <form action="{{ route('cart.delete', $cart->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="alert alert-info">Your shopping cart is empty.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Enter Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="checkoutForm" action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="postalCode">Postal Code:</label>
                            <input type="text" class="form-control" id="postalCode" name="postalCode" required>
                        </div>
                        <div class="    form-group">
                            <label for="address">Address:</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                        <div class="modal-footer">  
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#checkoutModal').on('shown.bs.modal', function () {
                $('#postalCode').focus(); // Focus on postal code input when modal is shown
            });
        });
    </script>
</body>
</html>
