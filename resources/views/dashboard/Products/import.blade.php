@extends('dashboard.master')


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">Import</li>
@endsection

@section('content')


  <!-- Main content -->
<div class="content">
    <div class="container-fluid">
            <form action="{{ route('dashboard.products.import') }}"  enctype="multipart/form-data" method="POST">
                @csrf
                
                <div class="form-group">
                    <x-form.input label='Count' type='text' name='count'  />
                </div>

                
                <input type="submit" value="Save" class="mb-4 btn  btn-primary">
                
            </form>
            <!-- /.col-md-6 -->
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->



@endsection