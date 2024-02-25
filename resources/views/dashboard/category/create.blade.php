@extends('dashboard.master')


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.category.index') }}">Category</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection


@section('page_info')

@endsection


@section('content')


  <!-- Main content -->
<div class="content">
    <div class="container-fluid">
            <form action="{{ route('dashboard.category.store') }}"  enctype="multipart/form-data" method="POST">
                @csrf
                @include('dashboard.category._form')
            </form>
            <!-- /.col-md-6 -->
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->



@endsection