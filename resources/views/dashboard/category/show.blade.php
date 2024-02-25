@extends('dashboard.master')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.category.index') }}">Category</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

  <!-- Main content -->
<div class="content">
    <div class="container-fluid">
            <form action="{{ route('dashboard.category.update', $category->id) }}"  enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                @include('dashboard.category._form', [
                  'btn' => 'Update'
                ])
            </form>
            <!-- /.col-md-6 -->
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->



@endsection