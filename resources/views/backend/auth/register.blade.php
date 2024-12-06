@extends('backend.layouts.auth_template')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-6 col-md-8">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Daftar Akun Sinvent</h1>
                    </div>
                    <form class="user" method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Full Name -->
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="nama_lengkap"
                            required placeholder="Nama Lengkap" value="{{ old('name') }}">
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="email"
                            required placeholder="Alamat Email" value="{{ old('email') }}">
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" name="password"
                            required placeholder="Password (min 8 karakter)">
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user"
                            name="password_confirmation" required placeholder="Ulangi Password">
                        </div>

                        <!-- Register Button -->
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Register
                        </button>

                        <div class="text-center" style="margin-top: 15px">
                            Sudah punya akun? <a href="{{ route('login') }}">Silahkan Login</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
