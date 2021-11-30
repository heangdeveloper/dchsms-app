@extends('layout.app')
@section('header')
    <style>
        .form-control {
            height: 34px;
            font-size: 13px;
            border: 1px solid #f1f1f1;
            border-radius: 0;
        }
        label {
            font-size: 13px !important;
        }
        #idst {
            font-weight: bold;
            font-size: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Student</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="card shadow-sm">
    <div class="card-header bg-gradient-success">
        <h5 class="mt-2 font-weight-bold text-center text-light">ពាក្យសុំចូលរៀននៅឌូវី ឆាល់ឃែរ៍​ ហោស៌</h5>
        <h6 class="m-0 font-weight-bold text-center text-light">Dewey Childcare House Application for Admission</h6>
    </div>
    <div class="card-body">
        <form class="mt-3" action="{{ route('student.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data" id="form-student">
            @csrf
            <input type="hidden" value="{{ Auth::user()->campus_id }}" name="branches" id="branches">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-12 col-xl-6">
                                <div class="form-group">
                                    @foreach($sid as $i)
                                        @php $oid = sprintf('%04d',$i->id+1); @endphp
                                    @endforeach
                                    <label>លេខសម្គាល់សិស្ស <span class="text-danger">*</span></label>
                                    <p id="idst" hidden></p>
                                    @php if(isset($oid)){ @endphp
                                    <input type="text" class="form-control form-control-sm" name="txtstuid" id="txtstuid" value="{{ $oid }}">
                                    <input type="hidden" id="chkid" value="0">
                                    @php }else{ @endphp
                                    <input type="text" class="form-control form-control-sm" name="txtstuid" id="txtstuid" value="0001">
                                    <input type="hidden" id="chkid" value="0">
                                    @php } @endphp
                                </div>
                            </div>
                            <div class="col-12 col-xl-6">
                                <div class="form-group">
                                    <label>នាមត្រកូល <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="txtsunamekh" id="txtsunamekh" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-xl-6">
                                <div class="form-group">
                                    <label>នាមខ្លួន <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="txtfinamekh" id="txtfinamekh" required>
                                </div>
                            </div>
                            <div class="col-12 col-xl-6">
                                <div class="form-group">
                                    <label>Surname <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="txtsunameen" id="txtsunameen" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-xl-6">
                                <div class="form-group">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="txtfinameen" id="txtfinameen" required>
                                </div>
                            </div>
                            <div class="col-12 col-xl-6">
                                <div class="form-group">
                                    <label>ភេទ</label>
                                    <select class="form-control form-control-sm" name="txtgender" id="txtgender" required>
                                        <option value="Male">ប្រុស (Male)</option>
                                        <option value="Female">ស្រី (Female)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-xl-6">
                                <div class="form-group">
                                    <label>ថ្ងៃខែឆ្នាំកំណើត <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-sm" name="txtdob" id="txtdob" required>
                                </div>
                            </div>
                            <div class="col-12 col-xl-6">
                                <div class="form-group">
                                    <label>លេខទូរសព្ទ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" name="txttel" id="txttel" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" data-toggle="tab" href="#nav-info"><i class="fas fa-id-card"></i> Info</a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#nav-school"><i class="fas fa-school"></i> School</a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#nav-parent"><i class="fas fa-users"></i> Parent</a>
                            </div>
                        </nav>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="nav-info">
                                <div class="row mt-3">
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>ជនជាតិ</label>
                                            <select class="form-control form-control-sm" name="txtrace" id="txtrace">
                                                <option value="Khmer">ខ្មែរ</option>
                                                <option value="Foreign">បរទេស</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>សញ្ជាតិ</label>
                                            <select class="form-control form-control-sm" name="txtnational" id="txtnational">
                                                <option value="Khmer">ខ្មែរ</option>
                                                <option value="Foreign">បរទេស</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>រូបថត</label>
                                            <input type="file" class="form-control form-control-sm" name="photo">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-xl-3">
                                        <div class="form-group">
                                            <label>ខេត្ត​បច្ចុប្បន្ន <span class="text-danger">*</span></label>
                                            <input class="form-control form-control-sm" name="txtpro" id="txtpro" required/>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-3">
                                        <div class="form-group">
                                            <label>ស្រុក​បច្ចុប្បន្ន <span class="text-danger">*</span></label>
                                            <input class="form-control form-control-sm" name="txtdist" id="txtdist" required/>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-3">
                                        <div class="form-group">
                                            <label>ឃុំ/សង្កាត់​បច្ចុប្បន្ន <span class="text-danger">*</span></label>
                                            <input class="form-control form-control-sm" name="txtcomm" id="txtcomm" required/>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-3">
                                        <div class="form-group">
                                            <label>ភូមិ​​បច្ចុប្បន្ន <span class="text-danger">*</span></label>
                                            <input class="form-control form-control-sm" name="txtvill" id="txtvill" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-school">
                                <div class="row mt-3">
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>ជាសិស្សមកពីសាលា <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="txtfrom" id="txtfrom" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>ថ្នាក់ទី <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="txtlevel" id="txtlevel" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>ចុះឈ្មោះថ្ងៃទី <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control form-control-sm" name="txtdate" id="txtdate" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-parent">
                                <div class="row mt-3">
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>ឈ្មោះឪពុក <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="fname" id="fname" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>អាស័យដ្ឋានឪពុក <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="fa" id="fa" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>មុខរបរឪពុក <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="fj" id="fj" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>ស្ថានភាពឪពុក</label>
                                            <select class="form-control form-control-sm" name="fs" id="fs">
                                                <option value="Alive">នៅរស់</option>
                                                <option value="Deceased">ស្លាប់</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>ជនជាតិឪពុក</label>
                                            <select class="form-control form-control-sm" name="fr" id="fr">
                                                <option value="Khmer">ខ្មែរ</option>
                                                <option value="Foreign">បរទេស</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>សញ្ជាតិឪពុក</label>
                                            <select class="form-control form-control-sm" name="fn" id="fn">
                                                <option value="Cambodia">ខ្មែរ</option>
                                                <option value="Foreign">បរទេស</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>ឈ្មោះម្តាយ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="mname" id="mname" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>អាស័យដ្ឋានម្តាយ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="ma" id="ma" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>មុខរបរម្តាយ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" name="mj" id="mj" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>ស្ថានភាពម្តាយ</label>
                                            <select class="form-control form-control-sm" name="ms" id="ms">
                                                <option value="Alive">នៅរស់</option>
                                                <option value="Deceased">ស្លាប់</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>ជនជាតិម្តាយ</label>
                                            <select class="form-control form-control-sm" name="mr" id="mr">
                                                <option value="Khmer">ខ្មែរ</option>
                                                <option value="Foreign">បរទេស</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-4">
                                        <div class="form-group">
                                            <label>សញ្ជាតិម្តាយ</label>
                                            <select class="form-control form-control-sm" name="mn" id="mn">
                                                <option value="Cambodia">ខ្មែរ</option>
                                                <option value="Foreign">បរទេស</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success float-right btn-sm" name="submit" id="submit"><i class="fa fa-check" aria-hidden="true"></i> Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('footer')
    <script type="text/javascript">
        function chkstid() {
            var stuid = $('#txtstuid').val();
            if (stuid == '') {
                swal({
                    title: 'Error !!',
                    text: "Please Enter Student ID !",
                    type: "error",
                })
            } else {
                $.ajax({
                    url:'{{route('getstuid')}}',
                    type:'POST',
                    data:{'_token':'{{csrf_token()}}', 'stuid':stuid},
                    success:function(data){
                        if (data > 0) {
                            swal({
                                title: 'Error !!',
                                text: "The Student ID You Entered Already Exists !",
                                type: "error",
                                timer: '1500'
                            })
                            $('#txtstuid').css("border-color", "red")
                            $('#idst').css("color", "red")
                            $('#chkid').val(0)
                            document.getElementById("idst").innerHTML = "ID លេខ " + stuid + " មានរួចហើយ !";
                        } else {
                            $('#txtstuid').css("border-color", "#5cb85c")
                            $('#idst').css("color", "#5cb85c")
                            $('#chkid').val(1)
                            document.getElementById("idst").innerHTML = "ID អាចប្រើប្រាស់បាន !";
                        }
                    }
                });
            }
        }

        $('#txtstuid').change(function () {
            chkstid()
        })
    </script>
@endsection