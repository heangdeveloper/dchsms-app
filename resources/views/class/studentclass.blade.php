@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Student Class</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="card mb-4">
        <div class="card-header bg-gradient-success py-3">
          <a class="btn btn-info btn-sm float-left" id="addstudentclass">Add Class</a>
          <h4 class="m-0 font-weight-bold text-center text-light">Student Class List</h4>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <table class="table table-bordered table-striped" id="student_class">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Curriculum</th>
                            <th>Classroom</th>
                            <th>Grade</th>
                            <th>S-Time</th>
                            <th>E-Time</th>
                            <th>School Year</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
      </div>
    
<div id="modal-form-student-class" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" data-toggle="validator" enctype="multipart/form-data">
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
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Curriculum</label>
                            <select class="form-control form-control-sm" name="curriculum" id="curriculum" autofocus required>
                                <option value="">Choose Curriculum</option>
                                @foreach($curriculum as $row)
                                    <option value="{{ $row->id }}">{{ $row->curriculum_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>School Year</label>
                            <select class="form-control form-control-sm" name="schoolyear" id="schoolyear" autofocus required>
                                <option value="">Choose Academic Year</option>
                                @foreach($year as $row)
                                    <option value="{{ $row->id }}">{{ $row->year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>S-Time</label>
                            <input type="time" class="form-control form-control-sm" name="stime" id="stime" autofocus required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>E-Time</label>
                            <input type="time" class="form-control form-control-sm" name="etime" id="etime" autofocus required>
                        </div>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Class</th>
                            <th>
                                <a href="#" class="btn btn-primary btn-sm addRow"><i class="fas fa-plus-circle"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="tbodyrow">
                        <tr>
                            <td>
                                <select class="form-control form-control-sm" name="student[]" id="student" autofocus required>
                                    <option value="">Choose Student</option>
                                    @foreach($student as $row)
                                        <option value="{{ $row->id }}">{{ $row->full_name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control form-control-sm" name="classnumber[]" id="classnumber" autofocus required>
                                    <option value="">Choose Classroom</option>
                                    @foreach($classroom as $row)
                                        <option value="{{ $row->id }}">Classroom: {{ $row->classnum }} | Grade: {{ $row->grade }}</option>
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

{{-- update student class --}}

<div id="modal-update-student-class" class="modal fade">
        <div class="modal-dialog" role="document">
            <form method="POST" data-toggle="validator" enctype="multipart/form-data">
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
                        <label>Curriculum</label>
                        <select class="form-control form-control-sm" name="curriculum" id="upcurriculum" autofocus required>
                            <option value="">Choose Curriculum</option>
                            @foreach($curriculum as $row)
                                <option value="{{ $row->id }}">{{ $row->curriculum_name }}</option>
                            @endforeach
                        </select>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label>School Year</label>
                        <select class="form-control form-control-sm" name="schoolyear" id="upschoolyear" autofocus required>
                            <option value="">Choose School Year</option>
                            @foreach($year as $row)
                                <option value="{{ $row->id }}">{{ $row->year }}</option>
                            @endforeach
                        </select>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label>Start Time</label>
                        <input type="time" class="form-control form-control-sm" name="stime" id="upstime" autofocus required>
                    </div>
                    <div class="form-group">
                        <label>End Time</label>
                        <input type="time" class="form-control form-control-sm" name="etime" id="upetime" autofocus required>
                    </div>
                    <div class="form-group">
                        <label>Student Name</label>
                        <select class="form-control form-control-sm" name="student" id="upstudent" autofocus required>
                            <option value="">Choose Student</option>
                            @foreach($student as $row)
                                <option value="{{ $row->id }}">{{ $row->full_name }}</option>
                            @endforeach
                        </select>
                        <span class="help-block with-errors"></span>
                    </div>
                    <div class="form-group">
                        <label>Class</label>
                        <select class="form-control form-control-sm" name="class" id="upclass" autofocus required>
                            <option value="">Choose Class</option>
                            @foreach($classroom as $row)
                                <option value="{{ $row->id }}">Classroom: {{ $row->classnum }} | Grade: {{ $row->grade }}</option>
                            @endforeach
                        </select>
                        <span class="help-block with-errors"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm btn-save">Update</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
    <script type="text/javascript">
        var table = $('#student_class').DataTable({
            responsive: true,
			autoWidth: false,
			processing: true,
			serverSide: true,
            ajax: "{{ route('student_class.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'full_name', name: 'full_name'},
                {data: 'curriculum_name', name: 'curriculum_name'},
                {data: 'classnum', name: 'classnum'},
                {data: 'grade', name: 'grade'},
                {data: 'stime', name: 'stime'},
                {data: 'etime', name: 'etime'},
                {data: 'year', name: 'year'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        

        $('#addstudentclass').click(function() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form-student-class').modal('show');
            $('#modal-form-student-class form')[0].reset();
            $('.modal-title').text('Add Student Class');
        });

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-update-student-class form')[0].reset();
            $.ajax({
                url: "{{ url('student_class') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-update-student-class').modal('show');
                    $('.modal-title').text('Edit Student Class');

                    $('#id').val(data.id);
                    $('#upstudent').val(data.stu_id);
                    $('#upclass').val(data.class_id);
                    $('#upschoolyear').val(data.academic_year_id);
                    $('#upstime').val(data.stime);
                    $('#upetime').val(data.etime);
                    $('#upcurriculum').val(data.curriculum_id);
                },
                error: function() {
                    swal({
                        title: 'Oops...!',
                        text: "Nothing Data!",
                        type: "error",
                        timer: '1500'
                    })
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
                    url: "{{ url('student_class') }}" + '/' + id,
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
            $('#modal-form-student-class form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    $.ajax({
                        url: '{{ url('student_class') }}',
                        type: "POST",
                        data: $('#modal-form-student-class form').serialize(),
                        success: function(data) {
                            $('#modal-form-student-class').modal('hide');
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

        $(function() {
            $('#modal-update-student-class form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    $.ajax({
                        url: "{{ url('student_class') . '/' }}" + id,
                        type: "POST",
                        data: $('#modal-update-student-class form').serialize(),
                        success: function(data) {
                            $('#modal-update-student-class').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: "Data has been Update!",
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

        $('.addRow').click(function() {
            var tr = '<tr>' +
                        '<td>' +
                            '<select class="form-control form-control-sm" name="student[]" id="student" autofocus required>' +
                                ' <option value="">Choose Student</option>' +
                                '@foreach($student as $row)' +
                                    '<option value="{{$row->id}}">{{ $row->full_name }}</option>' +
                                '@endforeach' +
                            '</select>' +
                            '<span class="help-block with-errors"></span>' +
                        '</td>' +
                        '<td>' +
                            '<select class="form-control form-control-sm" name="classnumber[]" id="classnumber" autofocus required>' +
                                '<option value="">Choose Classroom</option>' +
                                '@foreach($classroom as $row)' +
                                    '<option value="{{$row->id}}">Classroom: {{$row->classnum}} Grade: {{$row->grade}}</option>' +
                                '@endforeach' +
                            '</select>' +
                            '<span class="help-block with-errors"></span>' +
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

    </script>
@endsection