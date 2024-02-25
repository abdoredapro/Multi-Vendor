@extends('dashboard.master')

@section('page_title')
    Roles |
@endsection


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('page_info')

<div class="row">
    <div class="col-sm-6">
        <h1 class="m-0">Roles</h1>
    </div><!-- /.col -->
    <div class="col-sm-6 ">
        <a href="{{ route('dashboard.roles.create') }}" class="btn float-sm-right btn-outline-primary btn-sm">Create</a>

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
                <th>ID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            
            @forelse ($roles as $role)
                <tr>
            
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name}}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('dashboard.roles.edit', $role->id) }}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-sm btn-outline-danger" value="delete">
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>Roles is empty</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $roles->withQueryString()->links() }}

    <!-- /.col-md-6 -->
</div>
<!-- /.row -->


@endsection