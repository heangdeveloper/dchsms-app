@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Classroom</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Classroom</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="card mb-4">
        <div class="card-header bg-gradient-success py-3">
            <a id="addclass" class="btn btn-info shadow-sm btn-sm float-left">Add Class</a>
          <h4 class="text-center">Classroom</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="class-table" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Class Number</th>
                        <th>Grade</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div id="modal-form-class" class="modal fade">
    <div class="modal-dialog" role="document">
        <form method="POST" data-toggle="validator" enctype="multipart/form-data" autocomplete="off">
            {{ csrf_field() }} {{ method_field('POST') }}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title"></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                    <label>Room Number <span style="color: red;">*</span></label>
                    <input type="text" class="form-control form-control-sm" name="classnum" id="classnum" required>    
                </div>
                <div class="form-group">
                    <label>Grade <span style="color: red;">*</span></label>
                    <input type="text" class="form-control form-control-sm" name="grade" id="grade" required>    
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-sm btn-save">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script>
    var table = $('#class-table').DataTable({
        responsive: true,
		autoWidth: false,
		processing: true,
		serverSide: true,
        ajax: "{{ route('classroom.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'classnum', name: 'classnum'},
            {data: 'grade', name: 'grade'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#addclass').click(function() {
      save_method = "add";
      $('input[name=_method]').val('POST');
      $('#modal-form-class').modal('show');
      $('#modal-form-class form')[0].reset();
      $('.modal-title').text('Add Class');
    });

    function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form-class form')[0].reset();
            $.ajax({
                url: "{{ url('classroom') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form-class').modal('show');
                    $('.modal-title').text('Edit Class');

                    $('#id').val(data.id);
                    $('#classnum').val(data.classnum);
                    $('#grade').val(data.grade);
                },
                error: function() {
                    alert("Nothing Data");
                }
            });
        }

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
                    url: "{{ url('classroom') }}" + '/' + id,
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

    $(function() {
            $('#modal-form-class form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('classroom') }}";
                    else url = "{{ url('classroom') . '/' }}" + id;

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#modal-form-class form').serialize(),
                        success: function(data) {
                            $('#modal-form-class').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: "Data has been inserted!",
                                type: "success",
                                timer: '1500'
                            })
                        },
                        error: function() {
                            swal({
                                title: 'Oops...',
                                text: "Please input your data!",
                                type: "warning",
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
        });
</script>
@endsection