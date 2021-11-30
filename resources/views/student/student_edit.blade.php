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
            <h1 class="m-0 text-dark">Student Edit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Student Edit</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

	<div class="card">
		<div class="card-header bg-gradient-success py-3">
			<h4 class="font-weight-bold text-center text-light">Student Edit Information</h4>
		</div>
		<div class="card-body">
            <form class="mt-3" action="{{ route('student.update', $d->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data" id="form-student">
                @csrf
                {{ method_field('PUT') }}
                <input type="hidden" value="{{ Auth::user()->campus_id }}" name="branches" id="branches">
                <input type="hidden" value="{{ $d->id }}" name="student_id">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>លេខសម្គាល់សិស្ស <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" readonly="" name="txtstuid" id="txtstuid" value="{{ $d->stuno }}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>នាមត្រកូល <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="txtsunamekh" id="txtsunamekh" value="{{ $d->sunamekh }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>នាមខ្លួន <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="txtfinamekh" id="txtfinamekh" value="{{ $d->finamekh }}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Surname <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="txtsunameen" id="txtsunameen" value="{{ $d->sunameen }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="txtfinameen" id="txtfinameen" value="{{ $d->finameen }}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>ភេទ</label>
                                        <select class="form-control form-control-sm" name="txtgender" id="txtgender">
                                            @if($d->gender == 'Male')
                                                <option value="Male">ប្រុស (Male)</option>
                                                <option value="Female">ស្រី (Female)</option>
                                            @else
                                                <option value="Female">ស្រី (Female)</option>
                                                <option value="Male">ប្រុស (Male)</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>ថ្ងៃខែឆ្នាំកំណើត <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-sm" name="txtdob" id="txtdob" value="{{ $d->dob }}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>លេខទូរសព្ទ <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="txttel" id="txttel" value="{{ $d->tel }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>ស្ថានភាពសិស្ស</label>
                                        <select class="form-control form-control-sm" name="txtstatus" id="txtstatus">
                                            @if($d->status == 'Studying')
                                                <option value="Studying">កំពុងសិក្សា (Studying)</option>
                                                <option value="Stop">ឈប់រៀន (Stop)</option>
                                                <option value="Suspension">ព្យួរការសិក្សា (Suspension)</option>
                                            @elseif($d->status == 'Stop')
                                                <option value="Stop">ឈប់រៀន (Stop)</option>
                                                <option value="Suspension">ព្យួរការសិក្សា (Suspension)</option>
                                                <option value="Studying">កំពុងសិក្សា (Studying)</option>
                                            @else
                                                <option value="Suspension">ព្យួរការសិក្សា (Suspension)</option>
                                                <option value="Stop">ឈប់រៀន (Stop)</option>
                                                <option value="Studying">កំពុងសិក្សា (Studying)</option>
                                            @endif
                                        </select>
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
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>ជនជាតិ</label>
                                                <select class="form-control form-control-sm" name="txtrace" id="txtrace">
                                                    @if($d->race == 'Khmer')
                                                        <option value="Khmer">ខ្មែរ</option>
                                                        <option value="Foreign">បរទេស</option>
                                                    @else
                                                        <option value="Foreign">បរទេស</option>
                                                        <option value="Khmer">ខ្មែរ</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>សញ្ជាតិ</label>
                                                <select class="form-control form-control-sm" name="txtnational" id="txtnational">
                                                    @if($d->national == 'Khmer')
                                                        <option value="Khmer">ខ្មែរ</option>
                                                        <option value="Foreign">បរទេស</option>
                                                    @else
                                                        <option value="Foreign">បរទេស</option>
                                                        <option value="Khmer">ខ្មែរ</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>រូបថត</label>
                                                <input type="file" class="form-control form-control-sm" name="photo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-3">
                                            <div class="form-group">
                                                <label>ខេត្ត​បច្ចុប្បន្ន <span class="text-danger">*</span></label>
                                                <input class="form-control form-control-sm" name="txtpro" id="txtpro" value="{{ $d->province }}"/>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="form-group">
                                                <label>ស្រុក​បច្ចុប្បន្ន <span class="text-danger">*</span></label>
                                                <input class="form-control form-control-sm" name="txtdist" id="txtdist" value="{{ $d->district }}"/>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="form-group">
                                                <label>ឃុំ/សង្កាត់​បច្ចុប្បន្ន <span class="text-danger">*</span></label>
                                                <input class="form-control form-control-sm" name="txtcomm" id="txtcomm" value="{{ $d->commune }}"/>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <div class="form-group">
                                                <label>ភូមិ​​បច្ចុប្បន្ន <span class="text-danger">*</span></label>
                                                <input class="form-control form-control-sm" name="txtvill" id="txtvill" value="{{ $d->village }}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-school">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>ជាសិស្សមកពីសាលា <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="txtfrom" id="txtfrom" value="{{ $d->from_school }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>ថ្នាក់ទី <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="txtlevel" id="txtlevel" value="{{ $d->level }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>ចុះឈ្មោះថ្ងៃទី <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control form-control-sm" name="txtdate" id="txtdate" value="{{ $d->date_admission }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-parent">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>ឈ្មោះឪពុក <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="fname" id="fname" value="{{ $d->farther_name }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>អាស័យដ្ឋានឪពុក <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="fa" id="fa" value="{{ $d->farther_address }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>មុខរបរឪពុក <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="fj" id="fj" value="{{ $d->father_job }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>ស្ថានភាពឪពុក</label>
                                                <select class="form-control form-control-sm" name="fs" id="fs">
                                                    @if($d->father_status == 'Alive')
                                                        <option value="Alive">នៅរស់</option>
                                                        <option value="Deceased">ស្លាប់</option>
                                                    @else
                                                        <option value="Deceased">ស្លាប់</option>
                                                        <option value="Alive">នៅរស់</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>ជនជាតិឪពុក</label>
                                                <select class="form-control form-control-sm" name="fr" id="fr">
                                                    @if($d->father_race == 'Khmer')
                                                        <option value="Khmer">ខ្មែរ</option>
                                                        <option value="Foreign">បរទេស</option>
                                                    @else
                                                        <option value="Foreign">បរទេស</option>
                                                        <option value="Khmer">ខ្មែរ</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>សញ្ជាតិឪពុក</label>
                                                <select class="form-control form-control-sm" name="fn" id="fn">
                                                    @if($d->father_national == 'Cambodia')
                                                        <option value="Cambodia">ខ្មែរ</option>
                                                        <option value="Foreign">បរទេស</option>
                                                    @else
                                                        <option value="Foreign">បរទេស</option>
                                                        <option value="Cambodia">ខ្មែរ</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>ឈ្មោះម្តាយ <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="mname" id="mname" value="{{ $d->mother_name }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>អាស័យដ្ឋានម្តាយ <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="ma" id="ma" value="{{ $d->mother_address }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>មុខរបរម្តាយ <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" name="mj" id="mj" value="{{ $d->mother_job }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>ស្ថានភាពម្តាយ</label>
                                                <select class="form-control form-control-sm" name="ms" id="ms">
                                                    @if($d->mother_status == 'Alive')
                                                        <option value="Alive">នៅរស់</option>
                                                        <option value="Deceased">ស្លាប់</option>
                                                    @else
                                                        <option value="Deceased">ស្លាប់</option>
                                                        <option value="Alive">នៅរស់</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>ជនជាតិម្តាយ</label>
                                                <select class="form-control form-control-sm" name="mr" id="mr">
                                                    @if($d->mother_race == 'Khmer')
                                                        <option value="Khmer">ខ្មែរ</option>
                                                        <option value="Foreign">បរទេស</option>
                                                    @else
                                                        <option value="Foreign">បរទេស</option>
                                                        <option value="Khmer">ខ្មែរ</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>សញ្ជាតិម្តាយ</label>
                                                <select class="form-control form-control-sm" name="mn" id="mn">
                                                    @if($d->mother_national == 'Cambodia')
                                                        <option value="Cambodia">ខ្មែរ</option>
                                                        <option value="Foreign">បរទេស</option>
                                                    @else
                                                        <option value="Foreign">បរទេស</option>
                                                        <option value="Cambodia">ខ្មែរ</option>
                                                    @endif
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
                            <button type="submit" class="btn btn-success float-right btn-sm"><i class="far fa-save"></i> Update</button>
                        </div>
                    </div>
                </div>
            </form>
		</div>
	</div>
@endsection