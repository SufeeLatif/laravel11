@extends('layouts.master2')

@section('css')

<style>
    .invalid-feedback {
        color: white !important;
    }
</style>

@endsection

@section('content')
<div class="page">
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="">
                        <div class="text-white">
                            <div class="card-body">
                                <h2 class="display-4 mb-2 font-weight-bold error-text text-center">
                                    <strong>Login</strong>
                                    @if (Session::has('error_message'))
                                        <strong> {{ Session::get('error_message') }}</strong>

                                    @endif
                                </h2>
                                <h4 class="text-white-80 mb-7 text-center">Sign In to your account</h4>
                                <div class="row">
                                    <div class="col-9 d-block mx-auto">

                                        {{-- Success Message --}}
                                        @if (session('success_message'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success_message') }}
                                            </div>
                                        @endif

                                        {{-- Error Message --}}
                                        @if (session('error_message'))
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ session('error_message') }}
                                            </div>
                                        @endif

                                        {{-- Error Messages --}}
                                        @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif


                                        {{-- Login Form --}}
                                        <form method="POST" action="{{ route('login1') }}" id="loginForm">
                                            @csrf
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fe fe-user"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" name="email" placeholder="Email" id="email"
                                                    value="sufeedeveloper@gmail.com" required>
                                            </div>

                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fe fe-lock"></i>
                                                    </div>
                                                </div>
                                                <input type="password" class="form-control" name="password" value="123456"
                                                    id="password" placeholder="Password" required>
                                                <div class="input-group-append">
                                                    <button type="button" id="togglePassword" class="input-group-text">
                                                        <i class="fe fe-eye" id="eyeIcon"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit"
                                                        class="btn btn-secondary btn-block px-4">Login</button>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <a href="{{ route('forgotPassword') }}"
                                                        class="btn btn-link box-shadow-0 px-0 text-white-80">Forgot
                                                        password?</a>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <div class="text-center pt-4">
                                    <div class="font-weight-normal fs-16">You Don't have an account
                                        <a class="btn-link font-weight-normal text-white-80"
                                            href="{{ route('register') }}">Register Here</a>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="custom-btns text-center">
                                <button class="btn btn-icon" type="button"><span class="btn-inner-icon"><i
                                            class="fa fa-facebook-f"></i></span></button>
                                <button class="btn btn-icon" type="button"><span class="btn-inner-icon"><i
                                            class="fa fa-google"></i></span></button>
                                <button class="btn btn-icon" type="button"><span class="btn-inner-icon"><i
                                            class="fa fa-twitter"></i></span></button>
                                <button class="btn btn-icon" type="button"><span class="btn-inner-icon"><i
                                            class="fa fa-pinterest-p"></i></span></button>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-none d-md-flex align-items-center">
                    <img src="{{ asset('assets/images/png/login.png') }}" alt="img">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script src="{{asset('assets/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('assets/jquery-validation/additional-methods.min.js')}}"></script>

<script>
    $(document).ready(function () {


        $("#loginForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{Route('loginEmail')}}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            email: function () {
                                return $.trim($("#email").val()); 
                            }
                        }
                    },
                    normalizer: function (value) {
                        return $.trim(value); 
                    }
                }
            },
            messages: {
                email: {
                    required: "Please enter your email address.",
                    email: "Please enter a valid email address.",
                    remote: "Email not exist"
                }
            },
            submitHandler: function (form) {
                $("#loginForm button[type='submit']").attr("disabled", true);
                $("#loginForm button[type='submit']").html("<i class='fa fa-refresh fa-spin'></i>&nbsp;Processing...");
                form.submit();
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });



        /*Toggle password visibility*/
        $('#togglePassword').on('click', function () {
            var passwordField = $('#password');
            var eyeIcon = $('#eyeIcon');

            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                eyeIcon.removeClass('fe fe-eye').addClass('fe fe-eye-off'); // Change to eye-off icon
            } else {
                passwordField.attr('type', 'password');
                eyeIcon.removeClass('fe fe-eye-off').addClass('fe fe-eye'); // Revert to eye icon
            }
        });
    });

</script>
@endsection