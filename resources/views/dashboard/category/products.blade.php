@extends('dashboard.master')


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.category.index') }}">Category</a></li>
    <li class="breadcrumb-item active">Products</li>
@endsection




@section('page_info')

<div class="row">
    <div class="col-sm-6">
        <h1 class="m-0">{{ $category->name }}</h1>
    </div><!-- /.col -->
</div><!-- /.row -->



@endsection





@section('content')


{{-- Check if Session Has Success  --}}
<x-alert  status='success' />
<x-alert  status='info' />




<div class="row">

    <table class="table">
        <thead >
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Store</th>
                <th>Status</th>
                <th>Created_At</th>
            </tr>
        </thead>
        <tbody>
            
            @php
                $products = $category->products()->with('store')->Paginate(10);
            @endphp
            @forelse ($products as $product)
                <tr>
                    <td>

                        <img src="{{ $product->image }}" height="50">
                        
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->store->name }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td>Product is empty</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $products->withQueryString()->links() }}

    {{-- Notes:-
        this is use Tailwant if you use Bootstrab go to AppService and then in FUNC boot
        make Paginator::useBootstrapFour()

        Not 2 - Links() you can make custom Paginate pass view Name

    --}}
    <!-- /.col-md-6 -->
</div>
<!-- /.row -->


@endsection