<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="mb-4">Update Barang</h1>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <form method="POST" action="{{ route('update', $item->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="category">Kategori Barang:</label>
                        <select id="categorySelect" class="form-control" name="category">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($item->category_id == $category->id) selected @endif>{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Barang:</label>
                        <input type="text" class="form-control" id="name" name="name" minlength="5" maxlength="80" value="{{ $item->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga Barang (Rp.):</label>
                        <input type="number" class="form-control" id="price" name="price" min="0" value="{{ $item->price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="total">Jumlah Barang:</label>
                        <input type="number" class="form-control" id="total" name="total" min="0" value="{{ $item->total }}" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Foto Barang:</label>
                        <input type="file" class="form-control-file" id="image" name="image" >
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#categorySelect').select2({
                tags: true
            });
        });
    </script>
</body>
</html>
