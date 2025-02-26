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
            <li class="breadcrumb-item"><a href="#"><i class="fe fe-layout mr-2 fs-14"></i>Users</a></li>
            <!-- <li class="breadcrumb-item active" aria-current="page"><a href="#">User<</a></li> -->
        </ol>
    </div>
    <div class="page-rightheader">
        <div class="btn btn-list">

            @if (Session::has('userAccessArr.userList') && Session::get('userAccessArr.userList') == 1)

                <a href="{{Route('userCreate')}}" class="btn btn-info"><i class="fe fe-plus mr-1"></i> Create </a>

            @endif

        </div>
    </div>
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

    <div class="col-12">


        <div class="card">
            <div class="card-header">
                <div class="card-title">Users</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="usertable">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">Name</th>
                                <th class="wd-15p border-bottom-0">Email</th>
                                <th class="wd-15p border-bottom-0">Status</th>
                                <th class="wd-15p border-bottom-0">Action</th>


                            </tr>
                        </thead>

                        <tbody>

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
        $('#usertable').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_',
            },
            processing: true,
            serverSide: true,
            ajax: '{{ route('userListDatatable') }}',
            columns: [
                {
                    data: null, // No actual data
                    name: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + 1; // Row number (index + 1)
                    }
                },                 { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            order: [[0, 'desc']] // Set default sorting to descending by the 'id' column (column index 0)

        });
    });


    /* Handle checkbox status change*/
    $(document).on('change', 'input[name="statusUpdate"]', function () {
        var id = $(this).data('id'); // Get the user ID from the data-id attribute
        var newStatus = $(this).prop('checked') ? 1 : 0; // Determine new status (1 for checked, 0 for unchecked)

        var base_url = '{!! Route('userStatus') !!}';
        


        // Send the updated status to the server via AJAX
        $.ajax({
            url: base_url + '/' + id,  // Modify with your route
            method: 'POST',
            data: {
                "status": newStatus,
                "_token": "{{ csrf_token() }}",
            },
            success: function (response) {
                // Optionally handle success (like showing a success message or updating UI)
                if (response.success) {

                    $.growl.notice({
                        title: "Success",
                        message: response.success_message
                    });

                } else {

                    $.growl.error({
                        title: "Error",
                        message: response.error_message
                    });

                }
            },
            error: function () {
                alert('An error occurred while updating the status.');
            }
        });
    });




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
            var base_url = '{!! Route('userDelete') !!}';

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

                        // Redraw the DataTable after deletion
                        var table = $('#usertable').DataTable();
                        table.ajax.reload();
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


    




</script>

<script>
    $(document).ready(function () {

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