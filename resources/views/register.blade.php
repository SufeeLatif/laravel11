@extends('layouts.master2')

@section('css')

<style>

    .invalid-feedback{
        color:white !important;
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
                                    <strong>Register</strong></h2>
                                <h4 class="text-white-80 mb-7 text-center">Create New Account</h4>
                                <div class="row">
                                    <div class="col-9 d-block mx-auto">
                                        {{-- Success Message --}}
                                        @if (session('message_success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('message_success') }}
                                            </div>
                                        @endif

                                        {{-- Error Message --}}
                                        @if (session('message_error'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Error!</strong> {{ session('message_error') }}.
                                            </div>
                                        @endif



                                        {{-- Registration Form --}}
                                        <form method="POST" action="{{ route('register') }}" id="registrationForm">
                                            @csrf


                                            <!-- First Name -->
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fe fe-user"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('first_name') is-invalid @enderror"
                                                    name="first_name" placeholder="First Name"
                                                    value="{{ old('first_name') }}" required>
                                                @error('first_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Last Name -->
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fe fe-user"></i>
                                                    </div>
                                                </div>
                                                <input type="text"
                                                    class="form-control @error('last_name') is-invalid @enderror"
                                                    name="last_name" placeholder="Last Name"
                                                    value="{{ old('last_name') }}" required>
                                                @error('last_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Email -->
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fe fe-mail"></i>
                                                    </div>
                                                </div>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" placeholder="Email" value="{{ old('email') }}"
                                                    required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <!-- Password -->
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fe fe-lock"></i>
                                                    </div>
                                                </div>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" id="password" placeholder="Password" required>
                                                <div class="input-group-append">
                                                    <button type="button" id="togglePassword" class="input-group-text">
                                                        <i class="fe fe-eye" id="eyeIcon"></i>
                                                    </button>
                                                </div>
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fe fe-lock"></i>
                                                    </div>
                                                </div>
                                                <input type="password"
                                                    class="form-control @error('cpassword') is-invalid @enderror"
                                                    name="cpassword" id="confirmPassword" placeholder="Confirm Password"
                                                    required>
                                                <div class="input-group-append">
                                                    <button type="button" id="toggleConfirmPassword"
                                                        class="input-group-text">
                                                        <i class="fe fe-eye" id="confirmEyeIcon"></i>
                                                    </button>
                                                </div>
                                                @error('cpassword')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <!-- Submit Button -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit"
                                                        class="btn btn-secondary btn-block px-4">Create New
                                                        Account</button>
                                                </div>
                                            </div>
                                        </form>

                                        {{-- Forgot Password Link --}}
                                        <div class="col-12 text-center">
                                            <a href="{{ route('forgotPassword') }}"
                                                class="btn btn-link box-shadow-0 px-0 text-white-80">Forgot
                                                password?</a>
                                        </div>
                                    </div>
                                </div>

                                {{-- Login Link --}}
                                <div class="text-center pt-4">
                                    <div class="font-weight-normal fs-16">You already have an account?
                                        <a class="btn-link font-weight-normal text-white-80"
                                            href="{{ route('login') }}">Login Here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Image --}}
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



        $("#registrationForm").validate({
            rules: {

                email: {
                    required: true,
                    email: true,
                    remote: "{{Route('registerEmail')}}"

                }

            },
            messages: {

                email: {
                    remote: "Email exist already"
                }

            },
            submitHandler: function (form) {
                $("#registrationForm button[type='submit']").attr("disabled", true);
                $("#registrationForm button[type='submit']").html("<i class='fa fa-refresh fa-spin'></i>&nbsp;Process....");
                form.submit(); // <- use 'form' argument here.
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



        // Toggle visibility for Password field
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

        // Toggle visibility for Confirm Password field
        $('#toggleConfirmPassword').on('click', function () {
            var confirmPasswordField = $('#confirmPassword');
            var confirmEyeIcon = $('#confirmEyeIcon');

            if (confirmPasswordField.attr('type') === 'password') {
                confirmPasswordField.attr('type', 'text');
                confirmEyeIcon.removeClass('fe fe-eye').addClass('fe fe-eye-off'); // Change to eye-off icon
            } else {
                confirmPasswordField.attr('type', 'password');
                confirmEyeIcon.removeClass('fe fe-eye-off').addClass('fe fe-eye'); // Revert to eye icon
            }
        });
    });


</script>
@endsection