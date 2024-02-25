@extends('dashboard.master')

@section('title')
Edit Profile
@endsection

@section('content')

 <!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Edit Profile</li>
                </ol>
            </div>
        </div>
      <div class="row mb-2 mt-2 ">
        <div class="col-sm-6">
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
  <!-- /.content-header -->

  <!-- Main content -->
<div class="content">
    <div class="container-fluid">
            <form action="{{ route('dashboard.profile.update') }}"  method="POST">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-4">
                        <x-form.input label='First Name' name='first_name' :value='$user->profile->first_name' />
                    </div>
                    <div class="col-md-4">
                        <x-form.input label='Last Name' name='last_name' :value='$user->profile->last_name' />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <x-form.input label='Birthday' type='date'  name='birthday' :value='$user->profile->birthday' />
                    </div>
                    <div class="col-md-4">
                        <x-form.radio label='Gender' :items="['male' => 'Male', 'femal' => 'femal' ]" name='gender' :checked='$user->profile->gender' class="d-flex"  />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <x-form.input label='Street Address' name='street_address' :value='$user->profile->street_address' />
                    </div>
                    <div class="col-md-4">
                        <x-form.input label='City' name='city'  :value='$user->profile->city' />
                    </div>

                    <div class="col-md-4">
                        <x-form.input label='State' name='state' :value='$user->profile->state' />
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <x-form.input label='Postal Code' name='postal_code'  :value='$user->profile->postal_code'/>
                    </div>
                    <div class="col-md-4">

                        <x-form.select label='country' name='country'  :options='$country' />
                    </div>

                    <div class="col-md-4">
                        <x-form.select label='Local' name='local'  :options='$local' />
                    </div>

                </div>
                
                
                    <input type="submit" class="btn mt-4  btn-primary" value="Save">
                
            </form>
            <!-- /.col-md-6 -->
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->



@endsection