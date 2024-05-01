<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="mb-0">Daftar Barang</h1>
                    <a href="{{ route('viewInsert') }}" class="btn btn-success"><i class="fas fa-plus"></i> Insert</a>
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
                                        <p class="card-text">Jumlah: {{ $item->total }}</p>
                                        <p class="card-text">Kategori: {{ $item->category->category_name }}</p>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('update-form', ['id' => $item->id]) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Update</a>
                                            <button type="button" class="btn btn-danger delete-item" data-toggle="modal" data-target="#confirmDeleteModal" data-id="{{ $item->id }}"><i class="fas fa-trash"></i> Delete</button>
                                        </div>
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

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Anda yakin ingin menghapus barang ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).on('click', '.delete-item', function(){
            var itemId = $(this).data('id');
            var deleteUrl = "{{ route('delete', ['id' => ':id']) }}";
            deleteUrl = deleteUrl.replace(':id', itemId);
            $('#deleteForm').attr('action', deleteUrl);
        });
    </script>
</body>
</html>
