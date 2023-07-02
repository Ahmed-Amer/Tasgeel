<?php

namespace App\Http\Controllers\adminController;

use App\Models\Role;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Professor;
use App\Models\Department;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\isCourseRegisterActive;

class adminPagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard()
    {
        $courses = Course::count();
        $professors = Professor::count();
        $students = Student::count();
        $enrollments = Enrollment::count();
        $departments = Department::count();
        $admins  = User::where('role_id', '==', 1)->get();
        
        // $isActive = isCourseRegisterActive::where('id', 1)->first();
        $data = [
            'courses' => $courses,
            'professors' => $professors,
            'students' => $students,
            'enrollments' => $enrollments,
            // 'register' => $isActive->isActive,
        ];
        return View('adminView.dashboard')->with('data', $data);
    }

    public function coursesPage()
    {
        $courses = Course::all();
        $isActive = isCourseRegisterActive::where('id', 1)->first();
        return View('adminView.courses')->with([
            'courses' => $courses,
            'register' => $isActive->isActive,
        ]);
    }

    public function adminsPage()
    {
        $admins = User::whereHas('role', function ($query) {
            $query->where('role_name', 'Admin');
        })->get();
        return View('adminView.admins')->with('admins', $admins);
    }

    public function professorsPage()
    {
        $professors = User::whereHas('role', function ($query) {
            $query->where('role_name', 'Doctor');
        })->get();
        return View('adminView.professors')->with('professors', $professors);
    }

    public function studentsPage(Request $request)
    {
        $year = $request->year;
        // $students = User::whereHas('role', function ($query) {
        //     $query->where('role_name', 'Student');
        // })
        // ->orderBy('first_name')
        // ->orderBy('last_name')
        // ->get();
        $students = Student::where('study_year' , $year)->get();
        return View('adminView.students')->with('students', $students);
        
    }

    public function addCourse()
    {
        $departments = Department::all();
        $professors = Professor::all();
        $courses = Course::all();
        return View('adminView.addCourse')->with('data', [
            'depts' => $departments,
            'profs' => $professors,
            'courses' => $courses
        ]);
    }

    public function addStudent()
    {
        return View('adminView.addStudent');
    }

    public function addAdmin()
    {
        return View('adminView.addAdmin');
    }

    public function addProf()
    {
        $depts = Department::all();
        return View('adminView.addProf')->with('departments', $depts);
    }

    public function updateDoctor($id)
    {
        $user = User::find($id);
        $departments = Department::all();
        return View('adminView.updateProfessor')->with([
            'user' => $user,
            'departments' => $departments,
        ]);
    }

    public function departments()
    {
        $depts = Department::all();
        return View('adminView.departments')->with('departments', $depts);
    }

    public function addDept()
    {
        return View('adminView.addDept');
    }


    public function updateStudent($id)
    {
        $user = User::findOrFail($id);
        return View('adminView.updateStudent')->with([
            'user' => $user
        ]);
    }
}
