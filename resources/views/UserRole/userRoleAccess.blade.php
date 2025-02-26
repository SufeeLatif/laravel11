@extends('layouts.master')
@section('css')
@endsection
		

@section('page-header')
						<!--Page header-->
						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title mb-0">Role Access</h4>
								{{-- <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Apps</a></li>
									<li class="breadcrumb-item active" aria-current="page"><a href="#">Session Time Out</a></li>
								</ol> --}}
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
							<div class="col-md-12">
								<div class="card">
									
                                    
									<div class="card-body">
										
                                        <div class="row">
                                            <div class="col-sm-12">
                                
                                                @if(Session::has('error_message'))
                                                User Access

                                
                                                    <div class="alert alert-secondary dark alert-dismissible fade show" role="alert"><strong>Error
                                                            ! </strong> {{Session::get('error_message')}}.
                                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                                                                data-bs-original-title="" title=""></button>
                                                    </div>
                                
                                                @endif
                                
                                                @if(Session::has('success_message'))
                                
                                                    <div class="alert alert-success dark alert-dismissible fade show" role="alert"><strong>Success
                                                            ! </strong> {{Session::get('success_message')}}.
                                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"
                                                                data-bs-original-title="" title=""></button>
                                                    </div>
                                
                                
                                                @endif
                                
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="card-title"><strong>{{$UserRoles->title}}</strong> Access</h5>
                                
                                                        
                                                    </div>
                                                    <div class="table-responsive">
                                                        <form method="post" action="{{Route('userRoleAccess')}}/{{$UserRoles->id}}">
                                                            @csrf
                                                            <div class="card-body p-0">
                                                                <table class="table">
                                                                    <thead>
                                                                    <tr>
                                
                                
                                                                        <th  colspan="5" align="center">
                                                                            <center>
                                
                                                                                &nbsp;&nbsp;&nbsp; <strong> Select All </strong> <input type="checkbox"
                                                                                                                                        name="selectAll">
                                                                            </center>
                                
                                                                        </th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                
                                                                    <tr>
                                                                        <th>
                                
                                                                        </th>
                                                                    </tr>
                                
                                
                                
                                                                    @if(!empty($UserModule))
                                
                                                                        <?php

    $UserModuleArr = $UserModule;
                                
                                                                        ?>
                                                                        @foreach($UserModule as $UserModul)
                                
                                                                            <tr>
                                                                                <td  colspan="5" align="center">
                                
                                                                                    <strong>{{ preg_replace('/(?<!\ )[A-Z]/', ' $0', (ucwords(str_replace("_", " ", $UserModul['module_parent']))))  }}</strong>
                                
                                
                                                                                </td>
                                                                            </tr>
                                
                                                                            <?php

        $UserModules = App\Models\UserModule::select('module_title')->distinct()->where('module_parent', $UserModul['module_parent'])->get()->toArray();
                                
                                                                            ?>
                                                                            @if(!empty($UserModules))
                                
                                                                                @foreach($UserModules as $UserModule)
                                                                                    <tr>
                                                                                        <td>
                                                                                            <strong>{{ preg_replace('/(?<!\ )[A-Z]/', ' $0', (ucwords(str_replace("_", " ", $UserModule['module_title']))))  }}</strong>
                                                                                            {{--<b>{{$UserModule['module_title']}}</b>--}}
                                
                                                                                            @if (Auth::user()->email == 'sufeedeveloper@outlook.com')
                                
                                                                                                <a title="Delete" href="javascript:void(0)"
                                                                                                   class="confirmDeleteModule" data-title="{{$UserModule['module_title']}}" >
                                                                                                    <i class="icofont icofont-ui-delete"></i></a>
                                                                                            @endif
                                
                                
                                                                                        </td>
                                
                                                                                        <?php

                $UserModulesActions = App\Models\UserModule::where('module_title', $UserModule['module_title'])->get()->toArray();
                                
                                                                                        ?>
                                                                                        @if(!empty($UserModulesActions))
                                
                                                                                            @foreach($UserModulesActions as $UserModulesAction)
                                
                                
                                                                                                <?php

                        $userModulesCount = App\Models\UserAccessManages::where('user_role_id', $UserRoles->id)->where('module_id', $UserModulesAction['id'])->get()->count();
                        if ($userModulesCount > 0) {
                            $checked = "checked";
                        } else {
                            $checked = "";
                        }
                                
                                                                                                ?>
                                                                                                <td>
                                                                                                    <input style="cursor: pointer" type="checkbox"
                                                                                                           {{$checked}}
                                                                                                           name="access[]"
                                                                                                           value="{{$UserModulesAction['id']}}"
                                                                                                           action_title="{{$UserModulesAction['action_title']}}">
                                
                                                                                                    {{ preg_replace('/(?<!\ )[A-Z]/', ' $0', (ucwords(str_replace("_", " ", $UserModulesAction['action_title']))))  }}
                                
                                                                                                </td>
                                
                                                                                            @endforeach
                                
                                
                                                                                        @endif
                                
                                                                                    </tr>
                                
                                                                                @endforeach
                                
                                
                                                                            @endif
                                
                                                                        @endforeach
                                
                                
                                                                    @endif
                                
                                
                                                                    <tr>
                                                                        <td>
                                
                                                                            <button class="btn btn-success"> Submit</button>
                                                                        </td>
                                                                    </tr>
                                
                                                                    </tbody>
                                
                                                                </table>
                                
                                                                <br>
                                
                                
                                                                <br>
                                
                                                            </div>
                                
                                                            <input type="hidden" readonly="" value="{{$UserRoles->id}}" name="userID">
                                                        </form>
                                
                                                    </div>
                                                </div>
                                            </div>
                                
                                
                                        </div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->

					</div>
				</div><!-- end app-content-->
            </div>
@endsection
@section('js')


        <script>
                 $(document).ready(function () {
                        $('input[name="selectAll"]').click(function () {
                            if ($(this).prop("checked") == true) {
                                console.log("Checkbox is checked.");
                                $("input[name='access[]']").prop('checked', true);
                            }
                            else if ($(this).prop("checked") == false) {
                                console.log("Checkbox is unchecked.");
                                $("input[name='access[]']").prop('checked', false);
                            }
                        });
                });

        </script>
@endsection