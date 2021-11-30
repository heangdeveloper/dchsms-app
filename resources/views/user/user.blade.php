@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index')}}">Home</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="card">
        <div class="card-header bg-gradient-success">
            <h4 class="m-0 font-weight-bold text-center text-light">User List</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="users">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Branch</th>
                        <th>Status</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="edituser">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }} {{ method_field('POST') }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title"></h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <input type="hidden" id="userid" name="userid">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Fullname</label>
                                    <input type="text" class="form-control form-control-sm" id="fname" name="fname">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control form-control-sm" id="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Campus</label>
                                    <select class="form-control form-control-sm" id="campus" name="campus">
                                        <option>Choose Campus</option>
                                        @foreach($compuses as $c)
                                            <option value="{{ $c->id }}">{{ $c->name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control form-control-sm" id="role" name="role">
                                        <option>Choose Role</option>
                                        @foreach($role as $r)
                                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Avatar</label>
                                    <input type="file" class="form-control" id="img" name="img">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="active">Active</option>
                                        <option value="unactive">UnActive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm btn-save">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script type="text/javascript">
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        var table = $('#users').DataTable({
            responsive: true,
			autoWidth: false,
			processing: true,
			serverSide: true,
            ajax: "{{ route('user.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {
					data: 'avatar',
					name: 'avatar',
					render: function(data, type, full, meta) {
						if (data == 'default.png') {
							return "<img src={{ asset('dist/img/default.svg') }} width='50' class='img-thumbnail rounded-circle' />";
						} else {
							return "<img src={{ asset("storage/user/") }}/" + data + " width='50' class='img-thumbnail rounded-circle' />";
						}
					},
					orderable: false
				},
                {data: 'fullname', name: 'fullname'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'name_en', name: 'name_en'},
                {
					data: 'status',
					name: 'status',
					render: function(data, type, full, meta) {
						if (data == 'active') {
								return "<span class='badge badge-pill badge-primary'>" + data + "</span>";
						} else {
							return "<span class='badge badge-pill badge-danger'>" + data + "</span>";
						}
					},
				},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            order: [[0, 'desc']]
        });

        // when click button edit data

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#edituser form')[0].reset();
            $.ajax({
                url: "{{ url('user') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#edituser').modal('show');
                    $('.modal-title').text('Edit User');

                    $('#userid').val(data.id);
                    $('#fname').val(data.fullname);
                    $('#email').val(data.email);
                    $('#campus').val(data.campus_id);
                    $('#role').val(data.role_id);
                    $('#status').val(data.status);
                },
                error: function() {
                    alert("Nothing Data");
                }
            });
        }

        // when click button update data
        $(function() {
            $('#edituser form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#userid').val();
                    $.ajax({
                        url: "{{ url('user') . '/' }}" + id,
                        type: "POST",
                        data: $('#edituser form').serialize(),
                        success: function(data) {
                            $('#edituser').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: "Data has been Update!",
                                type: "success"
                            })
                        },
                        error: function(data) {
                            console.log(data)
                            swal({
                                title: 'Oops...',
                                text: "Something went wrong!",
                                type: "error"
                            })
                        }
                    });
                    return false;
                }
            });
        });

        function deleteData(id) {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(function() {
            $.ajax({
                url: "{{ url('user') }}" + '/' + id,
                type: "POST",
                data: {'_method' : 'DELETE', '_token' : csrf_token},
                success: function(data) {
                    table.ajax.reload();
                    swal({
                        title: 'Success!',
                        text: "Data has been deleted!",
                        type: "success",
                        timer: '1500'
                    })
                },
                error: function() {
                    swal({
                        title: 'Oops...',
                        text: "Something went wrong!",
                        type: "error",
                        timer: '1500'
                    })
                }
            })
        })
    }
    </script>
@endsection