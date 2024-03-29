<x-front-layout title="2FA Challenge">
    <x-slot name='breadcrumb'>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">2FA Challenge</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li>Challenge</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

     <!-- Start Account Login Area -->
     <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{ route('two-factor.login') }}"  method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>2FA Challenge</h3>
                                <p>You must enter 2FA codes.</p>
                            </div>
                           
                            @if ($errors->has('code'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                            <div class="form-group input-group">
                                <label for="reg-fn">2FA code</label>
                                <input class="form-control" type="text" name="code" id="reg-email" >
                            </div>
                            <div class="form-group input-group">
                                <label for="reg-fn">Recovery Code</label>
                                <input class="form-control" type="text" name="recovery_code" id="recovery_code" >
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Submit</button>
                            </div>
                         
                            
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->



</x-front-layout>