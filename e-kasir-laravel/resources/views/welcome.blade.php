<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    <script src="{{ asset('js//sb-admin-2.min.js') }}" defer></script>

    <!-- Bootstrap & CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sb-admin-2.css') }}">

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    
                                    <form method="POST" action="/postlogin">
                                        @csrf

                                        <!--Email-->
                                        <div class="form-group">
                                            <input id="username" type="text" class="form-control form-control-user @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required placeholder="Enter Username"  autofocus>
                                        
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                        </div>

                                        <!--Password-->

                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="exampleInputPassword" placeholder="Password">
                                        
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        {{-- Allert Jika Username Atau Password salah --}}
                                        <script>
                                            var msg = '{{Session::get('alert')}}';
                                            var exist = '{{Session::has('alert')}}';
                                            if(exist){
                                                alert(msg);
                                            }
                                        </script>

                                        <!--Remember Me-->

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="remember" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="customCheck">{{ __('Remember Me') }}</label>
                                            </div>
                                        </div>

                                        <!--Button Login-->

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('Login') }}
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        @if (Route::has('password.request'))
                                            <a class="small" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    

</body>

</html>
