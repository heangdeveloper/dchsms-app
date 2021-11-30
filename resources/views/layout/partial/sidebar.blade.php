<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-success elevation-4">
    <a href="{{ route('dashboard.index') }}" class="brand-link">
      <img src="{{ asset('dist/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle">
      <span class="brand-text font-weight-light">Dewey Childcare House</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(Auth::user()->avatar == 'default.png' )
            <img src="{{ asset('dist/img/default.svg') }}" class="img-circle elevation-2" alt="User Image">
          @else
            <img src="{{ asset("storage/user/") . '/' . Auth::user()->avatar }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a class="d-block">{{ Auth::user()->fullname }}</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('dashboard.index')}}" class="nav-link {{ (request()->is('dashboard*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('register.index') }}" class="nav-link {{ (request()->is('register*', 'payment*')) ? 'active' : '' }}">
              <i class="nav-icon far fa-registered"></i>
              <p>
                Register
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview {{ (request()->is('student', 'student/create', 'student/*', 'student/*/edit')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('student', 'student/create', 'student/*', 'student/*/edit')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Student
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('student.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Student</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('student.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Student</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ (request()->is('employee', 'employee/create', 'employee/*/edit')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('employee', 'employee/create', 'employee/*/edit')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Employee
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('employee.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('employee.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Employee</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ (request()->is('teacher_class*', 'student_class*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('teacher_class*', 'student_class*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-school"></i>
              <p>
                Class
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('student_class.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Class</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('teacher_class.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Teacher Class</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ (request()->is('student_attendance*', 'employee_attendance*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('student_attendance*', 'employee_attendance*')) ? 'active' : '' }}">
              <i class="nav-icon far fa-check-square"></i>
              <p>
                Attendance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('student_attendance.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Attendance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('employee_attendance.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Attendance</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('score.index') }}" class="nav-link {{ (request()->is('score')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-medal"></i>
              <p>
                Score
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('classroom.index') }}" class="nav-link {{ (request()->is('classroom*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Classroom
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{ route('subject.index') }}" class="nav-link  {{ (request()->is('subject*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Subject
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{route('term.index')}}" class="nav-link  {{ (request()->is('term*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Term
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{route('schoolyear.index')}}" class="nav-link  {{ (request()->is('schoolyear*')) ? 'active' : '' }}">
              <i class="nav-icon far fa-hourglass"></i>
              <p>
                School Year
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{route('curriculum.index')}}" class="nav-link  {{ (request()->is('curriculum*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                Curriculum
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('student_report.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('score_report.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Score Report</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ (request()->is('user*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('user*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('user.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage User</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#logoutModal" class="nav-link" data-toggle="modal">
              <i class="fas fa-sign-out-alt nav-icon"></i>
                <p>Logout</p>
              </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>