@extends('dashboard.master')

@section('page_title')
    Category |
@endsection


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Category</li>
@endsection



@section('page_info')

<div class="row">
    <div class="col-sm-6">
        <h1 class="m-0">Category</h1>
    </div><!-- /.col -->
    <div class="col-sm-6 ">
        @can('category.create') {{-- if has permission --}}
        
        <a href="{{ route('dashboard.category.create') }}" class="btn float-sm-right btn-outline-primary btn-sm">Create</a>
        @endcan
    </div><!-- /.col -->
</div><!-- /.row -->


    <div class="row">
        <a href="{{ route('dashboard.category.trash') }}" class="btn float-sm-right btn-outline-dark mt-2 ml-2 btn-sm">Trash</a>
    </div>

@endsection


@section('content')


{{-- Check if Session Has Success  --}}
<x-alert  status='success' />
<x-alert  status='info' />


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
                <th>Parent</th>
                <th>Product Count</th>
                <th>Status</th>
                <th>Created_At</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            
            @forelse ($categories as $category)
                <tr>
                    <td>
                        @if ($category->image)
                        <img src="{{ $category->image }}" height="50">
                        @endif
                    </td>
                    <td>{{ $category->id }}</td>
                    <td>
                        <a href="{{ route('dashboard.category.show', $category->id) }}">{{ $category->name }}</a>
                    </td>
                    <td>{{ $category->parent->name }}</td>
                    <td>{{ $category->products_count }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->created_at->diffForHumans() }}</td>
                    <td>
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('dashboard.category.edit', $category->id) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.category.destroy', $category->id) }}" method="POST">
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