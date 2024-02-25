@extends('dashboard.master')


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

  <!-- Main content -->
<div class="content">
    <div class="container-fluid">
            <form action="{{ route('dashboard.products.update', $product->id) }}"  enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                @include('dashboard.products._form', [
                'btn' => 'Update'
                ])
            </form>
            <!-- /.col-md-6 -->
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->



@endsection