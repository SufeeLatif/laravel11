@extends('layouts.master')

@section('css')
<!-- Data table css -->
<link href="{{  asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{  asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{  asset('assets/plugins/datatable/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<!-- Select2 css -->
<link href="{{  asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('page-header')
<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">Hi! Welcome Back</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('/' . $page = '#')}}">
                    <i class="fe fe-home mr-2 fs-14"></i>Home</a>
            </li>
        </ol>
    </div>
    <!-- Add User Button -->
    <div class="page-rightheader">
        <div class="btn btn-list">
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addUserModal">
                <i class="fe fe-user-plus mr-1"></i>Add User
            </a>
        </div>
    </div>
</div>
<!--End Page header-->
@endsection

@section('content')
<!-- Row -->
<div class="row">
    <div class="col-12">
        <!-- Responsive -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">List</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="users">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">Full Name</th>
                                <th class="wd-20p border-bottom-0">Email</th>
                                <th class="wd-10p border-bottom-0">Status</th>
                                <th class="wd-15p border-bottom-0">Created At</th>
                                <th class="wd-25p border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="outline-light"
                                            data-offstyle="outline-dark">
                                    </td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
</div>
<!-- /Row -->

<!-- Add User Modal Starts -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Content -->
                <form id="addUserForm" method="POST" action="{{ route('user.register') }}">
                    @csrf
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fe fe-user"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fe fe-user"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fe fe-user"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="name" placeholder="Name" required>
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fe fe-mail"></i>
                            </div>
                        </div>
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fe fe-lock"></i>
                            </div>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add User Modal Ends -->


@endsection

@section('js')
<!-- INTERNAL Data tables -->
<script src="{{  asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{  asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{  asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{  asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{  asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{  asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{  asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{  asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{  asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{  asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{  asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{  asset('assets/plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="{{  asset('assets/js/datatables.js') }}"></script>
<script>
    $(document).ready(function () {

        // Add user
        $('#addUserForm').on('submit', function (e) {
            e.preventDefault();

            const form = $(this);
            const formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('#addUserModal').modal('hide');
                    location.reload();
                },
                error: function (error) {
                    // Handle errors (e.g., validation errors)
                    console.error(error);
                    alert('An error occurred. Please try again.');
                }
            });
        });

        $(document).ready(function () {
            // Edit User
            $('#users').on('click', '.btn-edit', function () {
                const userId = $(this).data('id');
                const userName = $(this).data('name');
                const userEmail = $(this).data('email');

                // Populate the edit modal form
                $('#editUserId').val(userId);
                $('#editUserName').val(userName);
                $('#editUserEmail').val(userEmail);

                // Set form action dynamically
                $('#editUserForm').attr('action', `/users/${userId}`);

                // Show the edit modal
                $('#editUserModal').modal('show');
            });

            // Delete User
            $('#users').on('click', '.btn-delete', function () {
                const userId = $(this).data('id');

                // Set the form action dynamically
                $('#deleteUserForm').attr('action', `/users/${userId}`);

                // Show the delete modal
                $('#deleteUserModal').modal('show');
            });

            // Handle Edit Form Submission
            $('#editUserForm').on('submit', function (e) {
                e.preventDefault();

                const form = $(this);
                const formData = form.serialize();

                $.ajax({
                    url: form.attr('action'),
                    type: 'PUT',
                    data: formData,
                    success: function (response) {
                        $('#editUserModal').modal('hide');
                        location.reload(); // Reload to reflect changes
                    },
                    error: function (error) {
                        console.error(error);
                        alert('An error occurred. Please try again.');
                    }
                });
            });

            // Handle Delete Form Submission
            $('#deleteUserForm').on('submit', function (e) {
                e.preventDefault();

                const form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    type: 'DELETE',
                    success: function (response) {
                        $('#deleteUserModal').modal('hide');
                        location.reload(); // Reload to reflect changes
                    },
                    error: function (error) {
                        console.error(error);
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    });
</script>


<!-- INTERNAL Select2 js -->
<script src="{{  asset('assets/plugins/select2/select2.full.min.js') }}"></script>
@endsection