@extends('dashboard.master')


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.category.index') }}">Category</a></li>
    <li class="breadcrumb-item">Trash</li>

@endsection

@section('page_info')

<div class="row">
    <div class="col-sm-6">
        <h1 class="m-0">Trash</h1>
    </div><!-- /.col -->

</div><!-- /.row -->

@endsection

@section('content')

    <form action="{{ URL::Current() }}"  class="d-flex justify-content-between mb-4 gap-2">
        <x-form.input  name='name'  />
        <select name="status"  class="form-control">
            <option value="">All</option>
            <option value="active">Active</option>
            <option value="inactive">InActive</option>
        </select>
        <button class="btn btn-dark">Filter</button>
    </form>


<div class="row">

    <table class="table">
        <thead >
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Deleted At</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            
            @forelse ($categories as $category)
                <tr>
                    <td><img src="{{ asset('storage/'.$category->image)}}" height="50"></td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                    
                        <form action="{{ route('dashboard.category.restore', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="submit" class="btn btn-sm btn-outline-primary" value="restore">
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.category.force-delete', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-sm btn-outline-danger" value="delete">
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>Category is empty</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $categories->withQueryString()->links() }}

    <!-- /.col-md-6 -->
</div>
<!-- /.row -->


@endsection