<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function() {
    // Start Dashboard
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
    // End Dashboard

    // Start Student Register
    Route::resource('payment', 'PaymentController');
    Route::resource('register', 'StudentRegisterController');
    Route::resource('services_type', 'ServicesTypeController');
    Route::resource('discount_type', 'DiscountTypeController');
    Route::resource('product_services', 'ProductServicesController');
    Route::get('show_proservice/{idpaid}/{idyear}','ProductServicesController@show_proservice')->name('show_proservice');
    Route::get('select_info_by_iD/{id}', 'StudentRegisterController@selectInfoByID');
    Route::get('searchoverdue/{id}', 'StudentRegisterController@searchOverdue');
    Route::POST('selectTypePay','PaymentController@selectTypePay')->name('selectTypePay');
    // Route::POST('save_prosevice','StudentRegisterController@save_prosevice')->name('save_prosevice');
    // Route::delete('delete_service/{id}','StudentRegisterController@delete_service')->name('delete_service');
    Route::POST('save_payment','PaymentController@save_payment')->name('save_payment');
    Route::get('getinvoice','PaymentController@getinvoice')->name('getinvoice');
    Route::POST('searhByDate', 'StudentRegisterController@searhByDate')->name('searhByDate');
    Route::POST('viewDeposit_View','StudentRegisterController@viewDeposit_View')->name('viewDeposit_View');
    Route::GET('viewinvoice/{id_student}/{id_payment}','StudentRegisterController@viewInvoice')->name('viewinvoice');

    Route::get('search_cash_collection_report', 'Report\CashCollectionReportController@reportCashCollection');
    // End Student Register

    // Start Student
    Route::resource('student', 'StudentController');
    Route::post('getstuid','StudentController@getstuid')->name('getstuid');
    // End Student

    // Start Student Attendance
    Route::resource('student_attendance', 'Attendance\StudentAttendanceController');
    Route::get('student-attendance/{id}', 'Attendance\StudentAttendanceController@getclass');
    Route::get('stueditattendance', 'Attendance\StudentAttendanceController@editattendance')->name('stueditattendance');
    Route::get('search_student', 'Attendance\StudentAttendanceController@searchstudent')->name('search_student');
    Route::POST('stuattenup','Attendance\StudentAttendanceController@update')->name('stuattenup');
    Route::get('student-attendance-list/{id}', 'Attendance\StudentAttendanceController@getclass');
    Route::get('search_student_list', 'Attendance\StudentAttendanceController@liststuattendance')->name('search_student_list');
    // End Student Attendance

    // Start Employee Attendance
    Route::resource('employee_attendance', 'Attendance\EmployeeAttendanceController');
    Route::get('search_employee', 'Attendance\EmployeeAttendanceController@searchEmployee')->name('search_employee');
    Route::get('edit_employee_attendance', 'Attendance\EmployeeAttendanceController@editEmpAttendance')->name('edit_employee_attendance');
    Route::POST('Updateem','Attendance\EmployeeAttendanceController@Updateem')->name('Updateem');
    Route::get('listempattendance', 'Attendance\EmployeeAttendanceController@listEmpAttendance')->name('listempattendance');

    // End Employee Attendance

    // Start Score
    Route::resource('score', 'ScoreController');
    Route::get('listscore', 'ScoreController@getStudentClass')->name('listscore');
    Route::get('getteacherclass/{id}', 'ScoreController@getTeacherClass')->name('getteacherclass');
    // End Score

    // Start Employee
    Route::resource('employee', 'EmployeeController');
    Route::post('getempid','EmployeeController@getempid')->name('getempid');
    // End Employee

    // Start Teacher Class
    Route::resource('teacher_class', 'Classes\TeacherClassController');
    // End Teacher Class

    // Start Teacher Class
    Route::resource('student_class', 'Classes\StudentClassController');
    // End Teacher Class

    // Start School year
    Route::resource('schoolyear', 'SchoolYearController');
    // End School year

    // Start Curriculum
    Route::resource('curriculum', 'CurriculumController');
    // End Curriculum

    // Start Term
    Route::resource('term', 'TermController');
    // End Term

    // Start Classroom
    Route::resource('classroom', 'ClassRoomController');
    // End Classroom

    // Start Subject
    Route::resource('subject', 'SubjectController');
    // End Subject

    // Start Student Report
    Route::get('student_report', 'Report\StudentReportController@index')->name('student_report.index');
    Route::get('listnewstudent', 'Report\StudentReportController@searchNewStudent')->name('listnewstudent');
    Route::get('liststopstudent', 'Report\StudentReportController@searchStopStudent')->name('liststopstudent');
    Route::get('listskipstudent', 'Report\StudentReportController@searchSkipStudent')->name('listskipstudent');
    // End Student Report

    // Start Student Payment
    Route::get('cash_collection_report', 'Report\CashCollectionReportController@index')->name('cash_collection_report.index');
    Route::get('student_payment_report', 'Report\StudentPaymentController@index')->name('student_payment_report.index');
    // End Student Payment
    
    // Start Employee Report
    Route::get('employee_report', 'Report\EmployeeReportController@index')->name('employee_report.index');
    Route::get('search_employee_report', 'Report\EmployeeReportController@searchEmployeeReport')->name('search_employee_report');
    // End Employee Report

    // Start Score Report
    Route::get('score_report', 'Report\ScoreReportController@index')->name('score_report.index');
    // Route::get('getteacherclass/{id}', 'Report\ScoreReportController@getTeacherClass')->name('getteacherclass');
    Route::get('seachliststudentscore', 'Report\ScoreReportController@serchListStudentScore')->name('seachliststudentscore');
    // End Score Report

    // Start User
    Route::resource('user', 'UserController');
    Route::get('change_password', 'UserController@viewFormChangePassword')->name('change_password');
    Route::post('change_password', 'UserController@ChangePassword')->name('change_password');
    Route::post('change_profile', 'UserController@changProfile')->name('change_profile');
    // End User

});

Auth::routes(['register' => false]);

Route::get('/', function () {
    if(Auth::check()) {
        return redirect('/dashboard');
    } else {
        return view('auth.login');
    }
});
