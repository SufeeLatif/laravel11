@extends('layouts.master')

@section('title')
	{{ isset($user) && $user->id ? 'Update User' : 'Create User' }}
@endsection


@section('css')
	<!-- INTERNAL Select2 css -->
	<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

	<!-- INTERNAL Notifications  Css -->
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
			/* Ensure the image fills the width */
			height: 100%;
			/* Ensure the image fills the height */
			object-fit: cover;
			/* Crop and fill the container */
		}
	</style>
@endsection
@section('page-header')
	<!--Page header-->
	<div class="page-header">
		<div class="page-leftheader">
			<h4 class="page-title mb-0">User</h4>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="fe fe-layers mr-2 fs-14"></i>Users</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#">

						@if(isset($user) && $user->id)
							Update
						@else
							Create
						@endif
					</a></li>
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


		<div class="col-xl-9 col-lg-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						@if(isset($user) && $user->id)
							Update
						@else
							Create
						@endif

					</div>
				</div>

				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<form action="{{ isset($user) ? route('userUpdate', $user->id) : route('userCreate') }}" method="post"
					enctype="multipart/form-data" id="userForm">

					@csrf

					<div class="card-body">
						<div class="card-title font-weight-bold">Basic Info:</div>
						<div class="row">



							<!-- Image -->
							<div class="col-sm-6 col-md-6">
								<div class="text-center mb-5">
									<div class="widget-user-image position-relative">
										<!-- Default or uploaded avatar image -->

										@php
											$imagePath = 'uploads/profile_img/' . $user->image;
											$defaultImage = asset('assets/images/users/2.jpg');
											$imageExists = is_file(public_path($imagePath)) && file_exists(public_path($imagePath))
												? asset($imagePath)
												: $defaultImage;
										@endphp
										<img id="avatarPreview" alt="User Avatar" class="rounded-circle mr-3"
											src="{{ $imageExists }}">

										<!-- Hover button to change image -->
										<div class="upload-btn-container">
											<input type="file" class="form-control-file" id="avatar" name="avatar"
												style="display: none;" onchange="previewImage(event)">
											<label for="avatar" class="upload-btn">Change</label>
										</div>
									</div>
								</div>
							</div>




							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label" for="first_name">First Name</label>
									<input type="text" class="form-control" id="first_name" name="first_name"
										placeholder="First Name" value="{{ $user['first_name'] ?? old('first_name') }}"
										required>
									@error('first_name')
										<div class="text-danger">{{ $message }}</div>
									@enderror
								</div>
							</div>

							<!-- Last Name -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label" for="last_name">Last Name</label>
									<input type="text" class="form-control" id="last_name" name="last_name"
										placeholder="Last Name" value="{{ $user['last_name'] ?? old('last_name') }}"
										required>
									@error('last_name')
										<div class="text-danger">{{ $message }}</div>
									@enderror
								</div>
							</div>

							<!-- Email -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label" for="email">Email Address</label>

									<input type="email" class="form-control" id="email" name="email" placeholder="Email"
										value="{{ $user['email'] ?? old('email') }}" required @if(isset($user) && $user->id)
										disabled @endif>

									@error('email')
										<div class="text-danger">{{ $message }}</div>
									@enderror
								</div>
							</div>

							<!-- Mobile Number -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label" for="mobile">Mobile </label>
									<input type="text" class="form-control" id="mobile" name="mobile"
										placeholder="Mobile Number" value="{{ $user['mobile'] ?? old('mobile') }}" required>
									@error('mobile')
										<div class="text-danger">{{ $message }}</div>
									@enderror
								</div>
							</div>


							<!-- User Roles Dropdown -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label" for="user_role">User Role</label>
									<select class="form-control" id="user_role" name="user_role" required>
										<option value="">Select User Role</option>
										@foreach($UserRoles as $role)
											<option value="{{ $role['id'] }}" @if(isset($user) && $user->user_type == $role['id'])
											selected @endif>
												{{ $role['title'] }}
											</option>
										@endforeach
									</select>
									@error('user_role')
										<div class="text-danger">{{ $message }}</div>
									@enderror
								</div>
							</div>

							<!-- Gender Dropdown -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label" for="gender">Gender</label>
									<select class="form-control" id="gender" name="gender" required>
										<option value="">Select Gender</option>
										<option value="0" @if(isset($user) && $user->gender == 0) selected @endif>Male
										</option>
										<option value="1" @if(isset($user) && $user->gender == 1) selected @endif>Female
										</option>
										<option value="2" @if(isset($user) && $user->gender == 2) selected @endif>Other
										</option>
									</select>
									@error('gender')
										<div class="text-danger">{{ $message }}</div>
									@enderror
								</div>
							</div>


						</div>

						{{-- @if(!isset($user) || empty($user->id)) --}}
						<!-- Password Section -->
						<div class="card-title font-weight-bold mt-5">Password:</div>
						<div class="row">
							<!-- New Password -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label" for="password">New Password</label>
									<div class="input-group">
										<input type="password" class="form-control" id="password" name="password"
											placeholder="Enter new password" @if(!isset($user) || empty($user->id)) required
											@endif>
										<div class="input-group-append">
											<button type="button" class="btn btn-outline-secondary"
												onclick="togglePassword('password')">
												<i class="fa fa-eye" id="eye-password"></i>
											</button>
										</div>
									</div>
									@error('password')
										<div class="text-danger">{{ $message }}</div>
									@enderror
								</div>
							</div>

							<!-- Confirm Password -->
							<div class="col-sm-6 col-md-6">
								<div class="form-group">
									<label class="form-label" for="password_confirm">Confirm Password</label>
									<div class="input-group">
										<input type="password" class="form-control" id="password_confirm"
											name="password_confirm" placeholder="Enter confirm password" @if(!isset($user) || empty($user->id)) required @endif>
										<div class="input-group-append">
											<button type="button" class="btn btn-outline-secondary"
												onclick="togglePassword('password_confirm')">
												<i class="fa fa-eye" id="eye-password_confirm"></i>
											</button>
										</div>
									</div>
									@error('password_confirm')
										<div class="text-danger">{{ $message }}</div>
									@enderror
								</div>
							</div>
						</div>
						{{-- @endif --}}


					</div>

					<!-- Form Footer with Buttons -->
					<div class="card-footer text-right">
						<button type="submit" class="btn btn-primary">
							@if(isset($user) && $user->id > 0) Update @else Create @endif
						</button>
						<!-- <a href="{{ route('userList') }}" class="btn btn-danger">Cancel</a> -->
					</div>
				</form>




			</div>
		</div>
	</div>
	<!-- End Row-->

	</div>
	</div><!-- end app-content-->
	</div>
@endsection
@section('js')
	<!-- INTERNAL Select2 js -->
	<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
	<script src="{{ asset('assets/js/select2.js') }}"></script>

	<script src="{{asset('assets/plugins/notify/js/jquery.growl.js')}}"></script>


	<script src="{{asset('assets/jquery-validation/jquery.validate.js')}}"></script>
	<script src="{{asset('assets/jquery-validation/additional-methods.min.js')}}"></script>


	<script>
		$(document).ready(function () {



			// Mobile number formatting: 92-324-2193100
			$('#mobile').on('input', function () {
				var value = $(this).val();

				// Remove all non-numeric characters
				value = value.replace(/\D/g, '');

				// Ensure the number starts with '92' (country code)
				if (value.length > 0 && value[0] !== '9') {
					value = '92' + value.slice(1);
				}

				// Format the mobile number as 92-324-2193100
				if (value.length > 2) {
					value = value.slice(0, 2) + '-' + value.slice(2);
				}
				if (value.length > 6) {
					value = value.slice(0, 6) + '-' + value.slice(6, 13);
				}

				// Update the input field with the formatted value
				$(this).val(value);
			});


			$("#userForm").validate({

				submitHandler: function (form) {
					$("#userForm button[type='submit']").attr("disabled", true);
					$("#userForm button[type='submit']").html("<i class='fa fa-refresh fa-spin'></i>&nbsp;Process....");
					form.submit();
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
					message: "{{ session('success_message') }}" // Wrapped in quotes
				});
			@endif

			@if (session('error_message'))
				$.growl.error({
					title: "Error",
					message: "{{ session('error_message') }}" // Wrapped in quotes
				});
			@endif


				});


		function togglePassword(id) {
			var passwordField = document.getElementById(id);
			var eyeIcon = document.getElementById('eye-' + id);

			if (passwordField.type === "password") {
				passwordField.type = "text";
				eyeIcon.classList.remove("fa-eye");
				eyeIcon.classList.add("fa-eye-slash");
			} else {
				passwordField.type = "password";
				eyeIcon.classList.remove("fa-eye-slash");
				eyeIcon.classList.add("fa-eye");
			}
		}


		function previewImage(event) {
			// Get the file input and the preview image element
			var reader = new FileReader();
			var avatarPreview = document.getElementById('avatarPreview');

			// When the file is read successfully, set the src of the preview image
			reader.onload = function () {
				avatarPreview.src = reader.result;
			};

			// Read the selected file as a Data URL (base64)
			if (event.target.files[0]) {
				reader.readAsDataURL(event.target.files[0]);
			}
		}
	</script>

@endsection