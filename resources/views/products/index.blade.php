@extends('layout.app')
@section('main')
    <div class="d-flex justify-content-between">
        <h5><i class="bi bi-journal-richtext"></i> Product Details</h5>
        <a href="create" class="btn btn-primary"> <i class="bi bi-plus-circle"></i> New Product</a>
    </div>
    <div class="col-md-12 table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>M.R.P</th>
                    <th>Selling Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $product)
                @php
                    $index = ($products->currentPage() - 1)*$products->currentPage()+$loop->iteration;
                @endphp
                    <tr>
                        <td>{{ $index}}.</td>
                        <td><img src="products/{{ $product->image }}" style="width: 50px; height:50px; object-fit: contain"
                                alt="Product" /></td>
                        <td><a href="products/{{$product->id}}/show">{{ $product->name }}</a></td>
                        <td>Rs. {{ $product->mrp }}</td>
                        <td>Rs .{{ $product->price }}</td>
                        <td>
                            <a href="products/{{$product->id}}/edit" class="btn btn-dark btn-sm"><i class="bi bi-pencil-square"></i></a>
                            <a href="products/{{$product->id}}/destroy" onclick="return confirm('Are you want to Delete this Product')"" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$products->links()}}
    </div>
@endsection
