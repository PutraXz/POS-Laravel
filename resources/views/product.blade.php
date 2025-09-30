@extends('layouts.dashboard-layout')
@include('layouts.navbar-home')

<aside class="sidebar-dashboard show" id="sidebarLeft">
    @include('layouts.sidebar-dashboard')
</aside>
@section('content')
    <h4>Product</h4>
    <button class="btn text-light" data-bs-toggle="modal" data-bs-target="#addProduct" style="background-color:#9C2C77">Add
        Product</button>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <table class="table my-4" id="product">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Product</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Stock</th>
                <th>Kategori</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm" enctype="multipart/form-data">
                @csrf
                {{-- <input type="hidden" name="_method" value="PUT"> <-- This is handled in JS now --}}
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="product_id" id="edit_id">
                        <div class="mb-3">
                            <label class="form-label">Nama Product</label>
                            <input type="text" name="name_product" id="edit_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Product</label>
                            <input type="number" name="price" id="edit_price" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar Product (opsional)</label>
                            <input type="file" name="image" id="edit_image" class="form-control">
                            <div class="mt-2">
                                <img id="edit_preview" src="" alt="" width="90"
                                    class="img-thumbnail d-none">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock Product</label>
                            <input type="number" name="stock" id="edit_stock" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" name="kategori" id="edit_kategori" required>
                                <option value="" disabled>Pilih Kategori</option>
                                <option value="makanan">Makanan</option>
                                <option value="minuman">Minuman</option>
                                <option value="snack">Snack</option>
                                <option value="mie">Mie</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn text-light" style="background-color:#9C2C77">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addProduct" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="col-sm-4 col-form-label">Nama Product</label>
                            <input type="text" name="name_product" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-sm-4 col-form-label">Harga Product</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-sm-4 col-form-label">Gambar Product</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-sm-4 col-form-label">Stock Product</label>
                            <input type="number" name="stock" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-sm-4 col-form-label">Kategori</label>
                            <select class="form-select" name="kategori" aria-label="Default select example">
                                <option selected disabled>Select Category</option>
                                <option value="makanan">Makanan</option>
                                <option value="minuman">Minuman</option>
                                <option value="snack">Snack</option>
                                <option value="mie">Mie</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn text-light" style="background-color:#9C2C77">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        // Setup AJAX untuk mengirimkan token CSRF di setiap request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function() {
            const table = $('#product').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('show.product') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name_product',
                        name: 'name_product'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'stock',
                        name: 'stock'
                    },
                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Klik Edit -> open modal + prefill
            $('#product').on('click', '.edit', function() {
                const id = $(this).data('id');
                // Menggunakan route name products.get
                $.get('{{ url('/products') }}/' + id, function(res) {
                    if (res.ok) {
                        const p = res.data;
                        $('#edit_id').val(p.id);
                        $('#edit_name').val(p.name_product);
                        $('#edit_price').val(p.price);
                        $('#edit_stock').val(p.stock);
                        $('#edit_kategori').val(p.kategori);

                        if (res.image_url) {
                            $('#edit_preview').attr('src', res.image_url).removeClass('d-none');
                        } else {
                            $('#edit_preview').addClass('d-none');
                        }
                        $('#editModal').modal('show'); // Pastikan modal muncul
                    }
                });
            });

            // Submit Update
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                const id = $('#edit_id').val();
                const formData = new FormData(this);
                // Tambahkan method spoofing untuk PUT agar sesuai dengan route put
                formData.append('_method', 'PUT');

                $.ajax({
                    url: '{{ url('/products') }}/' + id,
                    type: 'POST', // Menggunakan POST untuk mengirim FormData dengan file dan method spoofing
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: (res) => {
                        if (res.ok) {
                            $('#editModal').modal('hide');
                            // Alert/Toast sukses di sini jika perlu
                            table.ajax.reload(null, false);
                        }
                    },
                    error: (xhr) => {
                        alert('Gagal update: ' + (xhr.responseJSON?.message ||
                            'Unknown error'));
                    }
                });
            });


        });
    </script>
@endpush
