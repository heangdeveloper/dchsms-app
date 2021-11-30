@extends('layout.app')
@section('content')

  <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Teacher Class</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Teacher Class</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  <div class="card">
    <div class="card-header bg-gradient-success py-3">
      <a class="btn btn-info shadow-sm btn-sm float-left" id="addteacherclass">Add Class</a>
      <h4 class="font-weight-bold text-center text-light">Teacher Class List</h4>
    </div>
    <div class="card-body">
      <table class="table table-bordered" id="teaclass">
        <thead>
          <tr>
            <th>#</th>
            <th>Teacher Name</th>
            <th>Room</th>
            <th>Grade</th>
            <th>Subject</th>
            <th>Option</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

{{-- Form add teacher class --}}
<div id="modal-form-teacher-class" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" id="form_add">
            {{ csrf_field() }}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title"></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                  <input type="hidden" value="{{ Auth::user()->campus_id }}" name="branches">
                <div class="form-group">
                    <label>Teacher</label>
                    <select class="form-control form-control-sm" name="teacher" id="teacher" autofocus required>
                        <option value="">Choose Teacher</option>
                        @foreach($teacher as $row)
                          <option value="{{ $row->id }}">{{ $row->fname }} {{ $row->lname }}</option>
                        @endforeach
                    </select>
                    <span class="help-block with-errors"></span>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>
                                <a href="#" class="btn btn-primary btn-sm addRow"><i class="fas fa-plus-circle"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="tbodyrow">
                        <tr>
                            <td>
                                <select class="form-control form-control-sm" name="class[]" id="class" autofocus required>
                                    <option value="">Choose Class</option>
                                    @foreach($classroom as $row)
                                      <option value="{{ $row->id }}">Classroom: {{ $row->classnum }} Grade: {{ $row->grade }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control form-control-sm" name="subject[]" id="subject" autofocus required>
                                    <option value="">Choose Subject</option>
                                    @foreach($subject as $row)
                                      <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <a href="#" class="btn btn-danger btn-sm remove"><i class="fas fa-times-circle"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-save">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>


{{-- update teacher class --}}

    <div id="modal-update-teacher-class" class="modal fade">
      <div class="modal-dialog" role="document">
         <form method="POST">
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
                  <input type="hidden" value="{{ Auth::user()->campus_id }}" name="branches">
                  <div class="form-group">
                      <label>Teacher</label>
                      <select class="form-control form-control-sm" name="teacher" id="upteacher" autofocus required>
                          <option value="">Choose Teacher</option>
                          @foreach($teacher as $row)
                              <option value="{{$row->id}}">{{$row->fname}} {{$row->lname}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Class</label>
                    <select class="form-control form-control-sm" name="class" id="upclass" autofocus required>
                            <option value="">Choose Class</option>
                            @foreach($classroom as $row)
                              <option value="{{ $row->id }}">Classroom: {{ $row->classnum }} Grade: {{ $row->grade }}</option>
                            @endforeach
                        </select>
                  </div>
                  <div class="form-group">
                    <label>Subject</label>
                    <select class="form-control form-control-sm" name="subject" id="upsubject" autofocus required>
                            <option value="">Choose Subject</option>
                            @foreach($subject as $row)
                              <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary btn-sm btn-save">Update</button>
                </form>
              </div>
        </div>
      </div>
    </div>

@endsection

@section('footer')
	<script type="text/javascript">
		var table = $('#teaclass').DataTable({
      responsive: true,
      autoWidth: false,
      processing: true,
      serverSide: true,
      ajax: "{{ route('teacher_class.index') }}",
      columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
        {data: 'full_name', name: 'full_name'},
        {data: 'classnum', name: 'classnum'},
        {data: 'grade', name: 'grade'},
        {data: 'name', name: 'name'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
      ]
    });

    $('#addteacherclass').click(function() {
      save_method = "add";
      $('input[name=_method]').val('POST');
      $('#modal-form-teacher-class').modal('show');
      $('#modal-form-teacher-class form')[0].reset();
      $('.modal-title').text('Add Teacher Class');
    });



    // Add Mulit Form
   $('.addRow').click(function() {
          var tr = '<tr>' +
                '<td>' +
                  '<select class="form-control form-control-sm" name="class[]" id="class" autofocus required>' +
                    '<option value="">Choose Class</option>' +
                    '@foreach($classroom as $row)' +
                      '<option value="{{ $row->id }}">Classroom: {{ $row->classnum }} Grade: {{ $row->grade }}</option>' +
                    '@endforeach' +
                  '</select>' +
                '</td>' +
                '<td>' +
                  '<select class="form-control form-control-sm" name="subject[]" id="subject" autofocus required>' +
                    '<option value="">Choose Subject</option>' +
                    '@foreach($subject as $row)' +
                      '<option value="{{$row->id}}">{{$row->name}}</option>' +
                    '@endforeach' +
                  '</select>' +
                '</td>' +
                '<td>' +
                  '<a href="#" class="btn btn-danger btn-sm remove"><i class="fas fa-times-circle"></i></a>' +
                '</td>' +
              '</tr>';
            $('.tbodyrow').append(tr);
        });

        $(document).on('click', '.remove', function () {
          var last = $('.tbodyrow tr').length;
          if (last == 1) {
              swal({
                  title: 'Oops...',
                  text: "Can not delete the last row!",
                  type: "error",
                  timer: '1500'
              })
          } else {
              $(this).parent().parent().remove();
          }
      });

      // Add Data
      $(function() {
            $('#modal-form-teacher-class form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    $.ajax({
                        url: "{{ route('teacher_class.store') }}",
                        type: "POST",
                        data: $('#modal-form-teacher-class form').serialize(),
                        success: function(data) {
                            $('#modal-form-teacher-class').modal('hide');
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
                        },
                        complete: function() {
                          $('#form_add').each(function() {
                            this.reset();
                          })
                        },
                    });
                    return false;
                }
            });
        });


      // Delete Data
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
                  url: "{{ url('teacher_class') }}" + '/' + id,
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

      // Edit Data
      function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-update-teacher-class form')[0].reset();
        $.ajax({
            url: "{{ url('teacher_class') }}" + '/' + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#modal-update-teacher-class').modal('show');
                $('.modal-title').text('Edit Teacher Class');
                $('#id').val(data.id);
                $('#upteacher').val(data.teaid);
                $('#upclass').val(data.claid);
                $('#upsubject').val(data.subid);
                $('#upstime').val(data.stime);
                $('#upetime').val(data.etime);
            },
            error: function() {
                swal({
                    title: 'Oops...',
                    text: "Nothing Data",
                    type: "error",
                    timer: '1500'
                })
            }
        });
      }

      // Update Data
      $(function() {
            $('#modal-update-teacher-class form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    $.ajax({
                        url: "{{ url('teacher_class') . '/' }}" + id,
                        type: "POST",
                        data: $('#modal-update-teacher-class form').serialize(),
                        success: function(data) {
                            $('#modal-update-teacher-class').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: "Data has been Updated!",
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