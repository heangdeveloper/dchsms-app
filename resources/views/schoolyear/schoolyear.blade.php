@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">School Year</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index')}}">Home</a></li>
              <li class="breadcrumb-item active">School Year</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="card">
        <div class="card-header bg-gradient-success">
            <a id="addschoolyear" class="btn btn-info shadow-sm btn-sm float-left">Add Year</a>
            <h4 class="m-0 font-weight-bold text-center text-light">School Year List</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="school-year-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>School Year</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div id="modal-form-school-year" class="modal fade">
    <div class="modal-dialog" role="document">
        <form method="POST" enctype="multipart/form-data" autocomplete="off">
            {{ csrf_field() }} {{ method_field('POST') }}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title"></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="academic_year_id" name="academic_year_id">
                <div class="form-group">
                    <label>School Year</label>
                    <input type="text" class="form-control form-control-sm" name="schoolyear" id="schoolyear">
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
        var table = $('#school-year-table').DataTable({
            responsive: true,
			autoWidth: false,
			processing: true,
			serverSide: true,
            ajax: "{{ route('schoolyear.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'year', name: 'year'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

    $('#addschoolyear').click(function() {
      save_method = "add";
      $('input[name=_method]').val('POST');
      $('#modal-form-school-year').modal('show');
      $('#modal-form-school-year form')[0].reset();
      $('.modal-title').text('Add School Year');
    });

    function editForm(academic_year_id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form-school-year form')[0].reset();
            $.ajax({
                url: "{{ url('schoolyear') }}" + '/' + academic_year_id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form-school-year').modal('show');
                    $('.modal-title').text('Edit School Year');

                    $('#academic_year_id').val(data.id);
                    $('#schoolyear').val(data.year);
                },
                error: function() {
                    alert("Nothing Data");
                }
            });
        }

    function deleteData(academic_year_id) {
            // var popup = confirm("Are you sure for delete this data ?");
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
                    url: "{{ url('schoolyear') }}" + '/' + academic_year_id,
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
            $('#modal-form-school-year form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#academic_year_id').val();
                    if (save_method == 'add') url = "{{ url('schoolyear') }}";
                    else url = "{{ url('schoolyear') . '/' }}" + id;

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#modal-form-school-year form').serialize(),
                        success: function(data) {
                            $('#modal-form-school-year').modal('hide');
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
                                text: "Nothing Data!",
                                type: "info",
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