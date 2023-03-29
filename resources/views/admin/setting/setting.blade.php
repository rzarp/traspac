@extends('admin.base')
@section('setting')


<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
                </nav>
            <h1 class="mb-0 fw-bold">Profile</h1> 
        </div>
        <div class="col-6">
            <div class="text-end upgrade-btn">
                <a href="https://www.wrappixel.com/templates/flexy-bootstrap-admin-template/" class="btn btn-primary text-white"
                    target="_blank">Upgrade to Pro</a>
            </div>
        </div>
    </div>
</div>

@php
    $user = $user ?? null;
    $action = route('profile.action');
@endphp

<div class="container-fluid">
   
    <div class="row">
      
        <div class="col-lg-12 col-xlg-3 col-md-12">

            @if (session()->has('pesan'))
                <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session()->get('pesan') }}
                </div>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ $action }}" class="form-horizontal form-material mx-2" method="POST" >
                        @csrf

                        @if ($user)
                            <input type="hidden" name="_method" value="PUT">
                        @endif
                        
                        <div class="form-group">
                            <label class="col-md-12">Name</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" name="name" id="" value="{{ $user ? $user->name : old('name') }}" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" class="form-control form-control-line" name="email" id="" value="{{ $user ? $user->email : old('email') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control form-control-line" name="password" id="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success text-white" type="submit">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection