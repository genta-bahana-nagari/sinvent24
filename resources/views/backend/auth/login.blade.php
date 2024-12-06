@extends('backend.layouts.auth_template')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-6 col-md-8">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="p-5">

                    <!-- Success Alert -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Error Alert -->
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Silakan Login Dulu</h1>
                    </div>

                    <!-- Login Form -->
                    <form class="user" method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email Address -->
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="email" required placeholder="Alamat Email">
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" name="password" required placeholder="Password">
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Login
                        </button>
                    </form>
                    <hr>

                    <!-- Register Link -->
                    <div class="text-center" style="margin-top: 15px">
                        Belum punya akun? <a href="{{ route('register') }}">Silahkan Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
