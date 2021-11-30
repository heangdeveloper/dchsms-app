@extends('layout.app')
@section('content')

	<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Subject</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Subject</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="card">
        <div class="card-header bg-gradient-success">
            <a id="addsubject" class="btn btn-info shadow-sm btn-sm float-left">Add Subject</a>
            <h4 class="m-0 font-weight-bold text-center text-light">Subject List</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="subject-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject Name</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div id="modal-form-subject" class="modal fade">
      <div class="modal-dialog" role="document">
          <form method="POST" autocomplete="off">
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
                      <label>Subject Name</label>
                      <input type="text" class="form-control form-control-sm" name="subject" id="subject" autofocus required>
                      <span class="help-block with-errors"></span>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-sm btn-save">Save</button>
              </div>
          </form>
          </div>
      </div>
  </div>

@endsection

@section('footer')
	
	<script type="text/javascript">
		  var table = $('#subject-table').DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('subject.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

    $('#addsubject').click(function() {
      save_method = "add";
      $('input[name=_method]').val('POST');
      $('#modal-form-subject').modal('show');
      $('#modal-form-subject form')[0].reset();
      $('.modal-title').text('Add Subject');
    });

    function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form-subject form')[0].reset();
            $.ajax({
                url: "{{ url('subject') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form-subject').modal('show');
                    $('.modal-title').text('Edit Subject');

                    $('#id').val(data.id);
                    $('#subject').val(data.name);
                },
                error: function() {
                    alert("Nothing Data");
                }
            });
        }

    function deleteData(id) {
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
                    url: "{{ url('subject') }}" + '/' + id,
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
            $('#modal-form-subject form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('subject') }}";
                    else url = "{{ url('subject') . '/' }}" + id;

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $('#modal-form-subject form').serialize(),
                        success: function(data) {
                            $('#modal-form-subject').modal('hide');
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
                                text: "Something went wrong!",
                                type: "error",
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