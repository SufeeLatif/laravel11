@extends('layouts.master')
@section('css')
    <!-- Data table css -->
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatable/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <!-- Slect2 css -->
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">User</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fe fe-layout mr-2 fs-14"></i>User Roles</a></li>
                <!-- <li class="breadcrumb-item active" aria-current="page"><a href="#">User Roles<</a></li> -->
            </ol>
        </div>
        <div class="page-rightheader">
            <div class="btn btn-list">
                <a data-toggle="modal" data-target="#modal-default-role" href="#" class="btn btn-info"><i
                        class="fe fe-plus mr-1"></i> Create </a>
                <!-- <a href="#" class="btn btn-danger"><i class="fe fe-printer mr-1"></i> Print </a> -->
                <!-- <a href="#" class="btn btn-warning"><i class="fe fe-shopping-cart/ mr-1"></i> Buy Now </a> -->
            </div>
        </div>
    </div>
    <!--End Page header-->
@endsection
@section('content')
    <!-- Row -->
    <div class="row">


        @if (Session::has('error_message'))
            <div class="alert alert-secondary dark alert-dismissible fade show" role="alert"><strong>Error
                    ! </strong> {{ Session::get('error_message') }}.
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (Session::has('success_message'))
            <div class="alert alert-success dark alert-dismissible fade show" role="alert"><strong>Success
                    ! </strong> {{ Session::get('success_message') }}.
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
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

        <div class="col-12">


            <div class="card">
                <div class="card-header">
                    <div class="card-title">User Roles</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" id="example2">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">Title</th>
                                    <th class="wd-15p border-bottom-0">Action</th>


                                </tr>
                            </thead>

                            <tbody>
                                @if (!empty($UserRoles))
                                    <?php $count = 1; ?>
                                    @foreach ($UserRoles as $UserRole)
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $UserRole['title'] }}</td>





                                            <td>

                                                @if (Auth::user()->user_type == 1)
                                                    <a href="{{ Route('userRoleAccess') }}/{{ $UserRole['id'] }}"
                                                        title="Access">
                                                        <i class="fa fa-unlock fa-2x"></i>
                                                    </a>
                                                    &nbsp;
                                                    &nbsp;
                                                @endif


                                                @if (Session::has('userAccessArr.userRoleUpdate') && Session::get('userAccessArr')['userRoleUpdate'] == 1)

                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#modal-default-{{ $UserRole['id'] }}"
                                                        href="{{ url('/') }}" title="Update"><i
                                                            class="fa fa-edit fa-2x"></i></a>
                                                    &nbsp;
                                                    &nbsp;
                                                @endif


                                                @if (Session::has('userAccessArr.userRoleDelete') && Session::get('userAccessArr')['userRoleDelete'] == 1)
                                                    
                                                    <a href="javascript:void(0)" class="confirmDelete"
                                                        recordid="{{ Route('userRoleDelete') }}/{{ $UserRole['id'] }}"
                                                        title="Delete">
                                                        <i class="fa fa-trash fa-2x"></i>
                                                    </a>
                                                    &nbsp;
                                                    &nbsp;
                                                @endif


                                            </td>

                                        </tr>

                                        {{-- Update Form --}}
                                        <div class="modal fade bd-example-modal-sm"
                                            id="modal-default-{{ $UserRole['id'] }}" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"><b>Update</b> Details
                                                        </h4>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ Route('userRoleUpdate') }}/{{ $UserRole['id'] }}"
                                                        method="post" id="UpdateUserRoleForm{{ $UserRole['id'] }}"
                                                        class="UpdateUserRoleForm">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row">


                                                                <div class="col-md-12">
                                                                    <div class="form-group">

                                                                        <label for="">Title</label>
                                                                        <input type="text" name="title"
                                                                            class="form-control"
                                                                            @if (!empty($UserRole['title'])) value="{{ $UserRole['title'] }}" @endif
                                                                            required>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button"
                                                                    data-bs-dismiss="modal">Close
                                                                </button>
                                                                <button class="btn btn-primary" type="submit">Submit
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                        <?php $count++; ?>
                                    @endforeach
                                @endif

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- /Row -->

    </div>
    </div><!-- end app-content-->
    </div>


    <div class="modal fade fade bd-example-modal-sm" id="modal-default-role" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><b>Add</b>
                    </h4>
                    <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ Route('userRoleCreate') }}" method="post" id="AddUserRoleForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">


                            <div class="col-md-12">
                                <div class="form-group">

                                    <label for="">Title</label>
                                    <input type="text" name="title" value="" class="form-control" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal" title="">Close
                        </button>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@endsection
@section('js')
    <!-- INTERNAL Data tables -->
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.js') }}"></script>

    <!-- INTERNAL Select2 js -->
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

    
    
    <script>
        /*registration-form validation*/
        $("#AddUserRoleForm").validate({

            rules: {

                title: {
                    required: true,
                    remote: "{{ Route('userCheckRole') }}"

                },


            },
            messages: {

                title: {
                    remote: "Role already exist"
                }

            },

            submitHandler: function(form) { // <- pass 'form' argument in
                $("#AddUserRoleForm button[type='submit']").attr("disabled", true);
                $("#AddUserRoleForm button[type='submit']").html(
                    "<i class='fa fa-refresh fa-spin'></i>&nbsp;Process....");
                form.submit(); // <- use 'form' argument here.
            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }

        });
    </script>
@endsection
