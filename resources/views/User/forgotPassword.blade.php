@extends('layouts.master2')
@section('css')
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
										<h2 class="display-4 mb-2 font-weight-bold error-text text-center"><strong>Forgot Password</strong></h2>
										<h4 class="text-white-80 mb-7 text-center">Forgot Password</h4>
										<div class="row">
											<div class="col-9 d-block mx-auto">
												@if(session('success'))
												    <div class="alert alert-success">
												        {{ session('success') }}
												    </div>
												@endif

												@if($errors->any())
												    <div class="alert alert-danger">
												        <ul>
												            @foreach ($errors->all() as $error)
												                <li>{{ $error }}</li>
												            @endforeach
												        </ul>
												    </div>
												@endif
												<form method="POST" action="{{ route('forgotPassword') }}" id="forgotPasswordForm">
		                                            @csrf
		                                            <div class="input-group mb-4">
		                                                <div class="input-group-prepend">
		                                                    <div class="input-group-text">
		                                                        <i class="fe fe-mail"></i>
		                                                    </div>
		                                                </div>
		                                                <input class="form-control" name="email" placeholder="Enter Email" type="email" required>
		                                            </div>

		                                            <button type="submit" class="btn btn-secondary btn-block px-4">
		                                                <i class="fe fe-send"></i> Send
		                                            </button>
		                                        </form>
											</div>
										</div>
										
									</div>
									{{-- <div class="custom-btns text-center">
										<button class="btn btn-icon" type="button"><span class="btn-inner-icon"><i class="fa fa-facebook-f"></i></span></button>
										<button class="btn btn-icon" type="button"><span class="btn-inner-icon"><i class="fa fa-google"></i></span></button>
										<button class="btn btn-icon" type="button"><span class="btn-inner-icon"><i class="fa fa-twitter"></i></span></button>
										<button class="btn btn-icon" type="button"><span class="btn-inner-icon"><i class="fa fa-pinterest-p"></i></span></button>
									</div> --}}
								</div>
							</div>
						</div>
						<div class="col-md-6 d-none d-md-flex align-items-center">
							<img src="{{ asset('assets/images/png/login.png')}}" alt="img">
						</div>
					</div>
				</div>
			</div>
        </div>
@endsection
@section('js')
@endsection