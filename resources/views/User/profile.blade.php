@extends('layouts.master')
@section('css')
	<!-- INTERNAL Select2 css -->
	<link href="{{asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />

	<link href="{{asset('assets/plugins/notify/css/jquery.growl.css')}}" rel="stylesheet" />

	<style>
		.widget-user-image {
			position: relative;
			display: inline-block;
			width: 150px;
			/* Fixed width */
			height: 150px;
			/* Fixed height */
			overflow: hidden;
			/* Crop any overflow */
			border-radius: 50%;
			/* Circular shape */
		}

		.upload-btn-container {
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			display: none;
			justify-content: center;
			align-items: center;
			background: rgba(0, 0, 0, 0.4);
			border-radius: 50%;
		}

		.widget-user-image:hover .upload-btn-container {
			display: flex;
		}

		.upload-btn {
			padding: 10px 20px;
			background-color: #007bff;
			color: #fff;
			border-radius: 5px;
			cursor: pointer;
			text-align: center;
		}

		.upload-btn:hover {
			background-color: #0056b3;
		}

		.upload-btn input[type="file"] {
			display: none;
		}

		#avatarPreview {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}

		.error {
			color: red;
			font-size: 12px;
			margin-top: 5px;
		}

		.is-invalid {
			border: 2px solid red;
		}

		input.is-invalid,
		select.is-invalid,
		textarea.is-invalid {
			border: 2px solid red;
		}
	</style>

@endsection
@section('page-header')
	<!--Page header-->
	<div class="page-header">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">Edit Profile</h4>
			<ol class="breadcrumb">
				{{-- <li class="breadcrumb-item"><a href="#"><i class="fe fe-layers mr-2 fs-14"></i>Pages</a></li> --}}
				{{-- <li class="breadcrumb-item active" aria-current="page"><a href="#">EditProfile</a></li> --}}
			</ol>
		</div>
		{{-- <div class="page-rightheader">
			<div class="btn btn-list">
				<a href="#" class="btn btn-info"><i class="fe fe-settings mr-1"></i> General Settings </a>
				<a href="#" class="btn btn-danger"><i class="fe fe-printer mr-1"></i> Print </a>
				<a href="#" class="btn btn-warning"><i class="fe fe-shopping-cart mr-1"></i> Buy Now </a>
			</div>
		</div> --}}
	</div>
	<!--End Page header-->
@endsection
@section('content')
	<!-- Row -->
	<div class="row">

		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<div class="col-xl-3 col-lg-4">

			<form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data" id="userImageForm">
				@csrf
				<div class="card box-widget widget-user">
					<div class="widget-user-image mx-auto mt-5">


						@php
							$defaultImage = 'assets/images/users/2.jpg';
							$userImage = 'uploads/profile_img/' . ($user->image ?? '');
							$imagePath = file_exists(public_path($userImage)) ? $userImage : $defaultImage;
						@endphp

						<img id="avatarPreview" alt="User Avatar" class="rounded-circle mr-3" src="{{ asset($imagePath) }}">


						<div class="upload-btn-container">
							<input type="file" class="form-control-file" id="site_image_1" name="image"
								style="display: none;">
							<label for="site_image_1" class="upload-btn">Change</label>
						</div>

					</div>
					<div class="card-body text-center pt-2">
						<div class="pro-user">



							<h3 class="pro-user-username text-dark mb-1 fs-22">{{$user->first_name}}</h3>


							{{-- <h6 class="pro-user-desc text-muted">Web Designer</h6>
							<div class="text-center mb-4">
								<span><i class="fa fa-star text-warning"></i></span>
								<span><i class="fa fa-star text-warning"></i></span>
								<span><i class="fa fa-star text-warning"></i></span>
								<span><i class="fa fa-star-half-o text-warning"></i></span>
								<span><i class="fa fa-star-o text-warning"></i></span>
							</div> --}}


							<button type="submit" id="updateButton" class="btn btn-primary mt-3"
								style="display:none;">Update</button>
						</div>
					</div>
					{{-- <div class="card-footer p-0">
						<div class="row">
							<div class="col-sm-6 border-right text-center">
								<div class="description-block p-4">
									<h5 class="description-header mb-1 font-weight-bold text-dark number-font">689k</h5>
									<span class="text-muted">Followers</span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="description-block text-center p-4">
									<h5 class="description-header mb-1 font-weight-bold text-dark number-font">3,765</h5>
									<span class="text-muted">Following</span>
								</div>
							</div>
						</div>
					</div> --}}
				</div>

			</form>

			<form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data" id="editPasswordForm">
				@csrf
				<input type="hidden" name="form_type" value="password_update">

				<div class="card">
					<div class="card-header">
						<div class="card-title">Edit Password</div>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="form-label">Current Password</label>
							<div class="input-group">
								<input type="password" name="current_password" id="current_password" class="form-control password-field" required>
								@error('current_password')
									<div class="text-danger">{{ $message }}</div>
								@enderror
								<div class="input-group-append">
									<span class="input-group-text toggle-password" style="cursor: pointer;">
										<i class="fa fa-eye"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="form-label">New Password</label>
							<div class="input-group">
								<input type="password" name="new_password" id="new_password" class="form-control password-field" required>
								@error('new_password')
									<div class="text-danger">{{ $message }}</div>
								@enderror
								<div class="input-group-append">
									<span class="input-group-text toggle-password" style="cursor: pointer;">
										<i class="fa fa-eye"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="form-label">Confirm Password</label>
							<div class="input-group">
								<input type="password" name="confirm_password" id="confirm_password" class="form-control password-field" required>
								@error('password')
									<div class="text-danger">{{ $message }}</div>
								@enderror
								<div class="input-group-append">
									<span class="input-group-text toggle-password" style="cursor: pointer;">
										<i class="fa fa-eye"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer text-right">
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</div>
			</form>



		</div>
		<div class="col-xl-9 col-lg-8">

			<form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data" id="profileForm">
				@csrf
				<input type="hidden" name="form_type" value="profile_update">

				<div class="card">
					<div class="card-header">
						<div class="card-title">Edit Profile</div>
					</div>
					<div class="card-body">
						<div class="card-title font-weight-bold">Basci info:</div>
						<div class="row">
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label">First Name</label>


									<input type="text" class="form-control" placeholder="First Name" name="first_name"
										value="{{ old('first_name', $user->first_name) }}" required>

									@error('first_name')
										<div class="text-danger">{{ $message }}</div>
									@enderror

								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label">Last Name</label>

									<input type="text" class="form-control" placeholder="Last Name" name="last_name"
										value="{{ old('last_name', $user->last_name) }}" required>


									@error('last_name')
										<div class="text-danger">{{ $message }}</div>
									@enderror

								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label">Email address</label>
									<input type="email" class="form-control" placeholder="Email" name="email"
										value="{{ old('email', $user->email) }}" readonly>
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label">Mobilev</label>
									<input type="tel" class="form-control" placeholder="Mobile Number" name="mobile"
										value="{{ old('phone', $user->mobile) }}" required>

									@error('mobile')
										<div class="text-danger">{{ $message }}</div>
									@enderror

								</div>
							</div>
							{{-- <div class="col-md-12">
								<div class="form-group">
									<label class="form-label">Address</label>
									<input type="text" class="form-control" placeholder="Home Address">
								</div>
							</div>
							<div class="col-sm-6 col-md-4">
								<div class="form-group">
									<label class="form-label">City</label>
									<input type="text" class="form-control" placeholder="City">
								</div>
							</div>
							<div class="col-sm-6 col-md-3">
								<div class="form-group">
									<label class="form-label">Postal Code</label>
									<input type="number" class="form-control" placeholder="ZIP Code">
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label class="form-label">Country</label>
									<select class="form-control select2">
										<optgroup label="Categories">
											<option data-select2-id="5">--Select--</option>
											<option value="1">Germany</option>
											<option value="2">Real Estate</option>
											<option value="3">Canada</option>
											<option value="4">Usa</option>
											<option value="5">Afghanistan</option>
											<option value="6">Albania</option>
											<option value="7">China</option>
											<option value="8">Denmark</option>
											<option value="9">Finland</option>
											<option value="10">India</option>
											<option value="11">Kiribati</option>
											<option value="12">Kuwait</option>
											<option value="13">Mexico</option>
											<option value="14">Pakistan</option>
										</optgroup>
									</select>
								</div>
							</div> --}}
						</div>
						{{-- <div class="card-title font-weight-bold mt-5">External Links:</div>
						<div class="row">
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label">Facebook</label>
									<input type="text" class="form-control" placeholder="https://www.facebook.com/">
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label">Google</label>
									<input type="text" class="form-control" placeholder="https://www.google.com/">
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label">Twitter</label>
									<input type="text" class="form-control" placeholder="https://twitter.com/">
								</div>
							</div>
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label">Pinterest</label>
									<input type="text" class="form-control" placeholder="https://in.pinterest.com/">
								</div>
							</div>
						</div> --}}
						<div class="card-title font-weight-bold mt-5">About:</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="form-label">About Me</label>
									<textarea rows="5" class="form-control" name="about_user"
										placeholder="Enter About your description">{{$user->about_user}}</textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer text-right">
						<button type="submit" class="btn  btn-primary">Updated</button>
						{{-- <a href="#" class="btn btn-danger">Cancle</a> --}}
					</div>
				</div>

			</form>
		</div>
	</div>
	<!-- End Row-->

	</div>
	</div><!-- end app-content-->
	</div>
@endsection
@section('js')


	<script src="{{asset('assets/plugins/notify/js/jquery.growl.js')}}"></script>

	<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
	<script src="{{asset('assets/js/select2.js')}}"></script>

	<script src="{{asset('assets/jquery-validation/jquery.validate.js')}}"></script>
	<script src="{{asset('assets/jquery-validation/additional-methods.min.js')}}"></script>



	<script>
		$(document).ready(function () {


			$(".toggle-password").click(function () {
				let input = $(this).closest('.input-group').find(".password-field");
				let icon = $(this).find("i");

				if (input.attr("type") === "password") {
					input.attr("type", "text");
					icon.removeClass("fa-eye").addClass("fa-eye-slash");
				} else {
					input.attr("type", "password");
					icon.removeClass("fa-eye-slash").addClass("fa-eye");
				}
			});

			$("#editPasswordForm").validate({

				rules: {
					current_password: {
					required: true,
					remote: {
						url: "{{ route('checkCurrentPassword') }}",
						type: "POST",
						data: {
							"_token": "{{ csrf_token() }}",
							current_password: function () {
								return $("#current_password").val();
							}
						}
					}
				},
				new_password: {
					required: true,
					minlength: 6
				},
				confirm_password: {
					required: true,
					equalTo: "#new_password"
				}
			},
			messages: {
				current_password: {
					required: "Please enter your current password.",
					remote: "The current password is incorrect."
				},
				new_password: {
					required: "Please enter a new password.",
					minlength: "Your password must be at least 8 characters long."
				},
				confirm_password: {
					required: "Please confirm your new password.",
					equalTo: "New password and confirmation password do not match."
				}
			},

				submitHandler: function (form) {
					$("#editPasswordForm button[type='submit']").attr("disabled", true);
					$("#editPasswordForm button[type='submit']").html("<i class='fa fa-refresh fa-spin'></i>&nbsp;Process....");
					form.submit(); // <- use 'form' argument here.
				},


				errorElement: 'span',
				errorPlacement: function (error, element) {
					error.addClass('invalid-feedback');
					element.closest('.form-group').append(error);
				},
				highlight: function (element, errorClass, validClass) {
					$(element).addClass('is-invalid');
				},
				unhighlight: function (element, errorClass, validClass) {
					$(element).removeClass('is-invalid');
				}

			});

			$("#profileForm").validate({

				submitHandler: function (form) {
					$("#profileForm button[type='submit']").attr("disabled", true);
					$("#profileForm button[type='submit']").html("<i class='fa fa-refresh fa-spin'></i>&nbsp;Process....");
					form.submit(); // <- use 'form' argument here.
				},


				errorElement: 'span',
				errorPlacement: function (error, element) {
					error.addClass('invalid-feedback');
					element.closest('.form-group').append(error);
				},
				highlight: function (element, errorClass, validClass) {
					$(element).addClass('is-invalid');
				},
				unhighlight: function (element, errorClass, validClass) {
					$(element).removeClass('is-invalid');
				}

			});

			$("#userImageForm").validate({

				submitHandler: function (form) {
					$("#userImageForm button[type='submit']").attr("disabled", true);
					$("#userImageForm button[type='submit']").html("<i class='fa fa-refresh fa-spin'></i>&nbsp;Process....");
					form.submit(); // <- use 'form' argument here.
				},


				errorElement: 'span',
				errorPlacement: function (error, element) {
					error.addClass('invalid-feedback');
					element.closest('.form-group').append(error);
				},
				highlight: function (element, errorClass, validClass) {
					$(element).addClass('is-invalid');
				},
				unhighlight: function (element, errorClass, validClass) {
					$(element).removeClass('is-invalid');
				}

			});


			@if (session('success_message'))
				$.growl.notice({
					title: "Success",
					message: "{{ session('success_message') }}"
				});
			@endif

			@if (session('error_message'))
				$.growl.error({
					title: "Error",
					message: "{{ session('error_message') }}"
				});
			@endif


			$('#site_image_1').change(function (event) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#avatarPreview').attr('src', e.target.result);
					$('#updateButton').show(); // Show Update button
				};

				if (event.target.files.length > 0) {
					reader.readAsDataURL(event.target.files[0]);
				}
			});
		});
	</script>

@endsection