<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Barang</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="mb-0">Daftar Barang</h1>
                    <a href="{{ route('cart', ['user_id' => auth()->user()->id]) }}" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Cart</a>
                    <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
                </div>
                @if(count($items) > 0)
                    <div class="row">
                        @foreach($items as $item)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->name }}</h5>
                                        <p class="card-text">Harga: Rp. {{ $item->price }}</p>
                                        <p class="card-text">Total Quantity: {{ $item->total }}</p>
                                        <p class="card-text">Kategori: {{ $item->category->category_name }}</p>
                                        <form action="{{ route('add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                                            <div class="form-group">
                                                <label for="quantity">Quantity:</label>
                                                <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                                            </div>
                                            <button type="submit" class="btn btn-success">Buy</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Tidak ada barang yang tersedia.</p>
                @endif
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
