@extends('dashboard.master')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
@endsection


@section('page_info')

<div class="row">
    <div class="col-sm-6">
        <h1 class="m-0">Products</h1>
    </div><!-- /.col -->
    <div class="col-sm-6 ">
        <a href="{{ route('dashboard.products.create') }}" class="btn float-sm-right btn-outline-primary btn-sm">Create</a>
    </div><!-- /.col -->
</div><!-- /.row -->

@endsection


@section('content')

<div class="row">

    <table class="table">
        <thead >
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Store</th>
                <th>Status</th>
                <th>Created_At</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            
            @forelse ($products as $product)
                <tr>
                    <td><img src="{{ asset('storage/'.$product->image)}}" height="50"></td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->store->name  }}</td>
                    <td>{{ $product->status  }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('dashboard.products.edit', $product->id) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-sm btn-outline-danger" value="delete">
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>product is empty</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $products->withQueryString()->links() }}

    <!-- /.col-md-6 -->
</div>
<!-- /.row -->


@endsection