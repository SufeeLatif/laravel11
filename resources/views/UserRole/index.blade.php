@extends('layouts.master')
@section('css')
   

<!-- Data table css -->
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/datatable/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<!-- Slect2 css -->
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

<!-- INTERNAL Notifications  Css -->
<link href="{{asset('assets/plugins/notify/css/jquery.growl.css')}}" rel="stylesheet" />

<link href="{{asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">

<!--- INTERNAL Sweetalert css-->
<link href="{{asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet" />


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


        {{-- @if (Session::has('error_message'))
            <div class="alert alert-secondary dark alert-dismissible fade show" role="alert"><strong>Error
                    ! </strong> {{ Session::get('error_message') }}.
                <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (Session::has('success_message'))
            <div class="alert alert-success dark alert-dismissible fade show" role="alert"><strong>Success
                    ! </strong> {{ Session::get('success_message') }}.
                <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}

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

                                                    <a data-toggle="modal"
                                                        data-target="#modal-default-{{ $UserRole['id'] }}"
                                                        href="{{ url('/') }}" title="Update"><i
                                                            class="fa fa-edit fa-2x"></i></a>
                                                    &nbsp;
                                                    &nbsp;
                                                @endif


                                                @if (Session::has('userAccessArr.userRoleDelete') && Session::get('userAccessArr')['userRoleDelete'] == 1)
                                                    
                                                <a href="javascript:void(0)" class="confirmDeleteIt" 
                                                data-id="{{ $UserRole['id'] }}" 
                                                data-url="{{ route('userRoleDelete') }}">
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
                                                        <button class="btn-close" type="button" data-dismiss="modal"
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
                                                                    data-dismiss="modal">Close
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
{{--
<script src="{{ asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script> --}}
<script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.js') }}"></script>

<!-- INTERNAL Select2 js -->
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>



<script src="{{asset('assets/plugins/notify/js/jquery.growl.js')}}"></script>
<script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>

<script>
    $(document).ready(function () {


        /* Confirm Delete for All */
        
        /* Confirm Delete for All */
    $(document).on("click", ".confirmDeleteIt", function () {
    var deleteId = $(this).attr('data-id');

    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        background: '#000',  // Black background
        customClass: {
            popup: 'custom-swal-popup',
            confirmButton: 'custom-swal-btn',
            cancelButton: 'custom-swal-btn'
        }
    }, function(isConfirm) {  // SweetAlert 1.x callback
        if (isConfirm) {
            // Get the base URL for the delete route
            var base_url = '{!! Route('userRoleDelete') !!}';

            $.ajax({
                url: base_url,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    deleteId: deleteId
                },
                dataType: 'json',
                success: function (resp) {
                    if (resp.status) {
                        swal({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Deleted Successfully',
                            showConfirmButton: false,
                            timer: 1500,
                            background: '#000',  // Black background
                            color: '#fff'  // White text color
                        });

                       location.reload();
                       
                    } else {
                        swal({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Error occurred while deleting',
                            showConfirmButton: false,
                            timer: 1500,
                            background: '#000',  // Black background
                            color: '#fff'  // White text color
                        });
                    }
                },
                error: function (xhr, status, error) {
                    swal({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Server Error',
                        text: 'Please try again later.',
                        showConfirmButton: false,
                        timer: 1500,
                        background: '#000',  // Black background
                        color: '#fff'  // White text color
                    });
                }
            });
        }
    });
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
</script>

    
@endsection
