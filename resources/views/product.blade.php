@extends('layouts.dashboard-layout')
@include('layouts.navbar-home')

<aside class="sidebar-dashboard show" id="sidebarLeft">
    @include('layouts.sidebar-dashboard')
</aside>
@section('content')
    <h4>Product</h4>
    <button class="btn text-light" data-bs-toggle="modal" data-bs-target="#addProduct" style="background-color:#9C2C77">Add
        Product</button>
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
    <div class="modal fade" id="edit-product-" tabindex="-1" aria-labelledby="addProduct" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
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
                            <label for="" class="col-sm-4 col-form-label">Stock Product</label>
                            <select class="form-select" name="kategori" aria-label="Default select example">
                                <option selected>Select Category</option>
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
    <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addProduct" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
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
                            <label for="" class="col-sm-4 col-form-label">Stock Product</label>
                            <select class="form-select" name="kategori" aria-label="Default select example">
                                <option selected>Select Category</option>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#product').DataTable({
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
        });
    </script>
@endpush
