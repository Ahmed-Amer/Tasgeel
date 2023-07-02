<?php

namespace App\Http\Controllers\studentController;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Degree;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class studentController extends Controller
{
    public function __construct()
    {
        $this->middleware('student');
    }

    public function checkIfStudentCanRegisterThisCourse($courseId)
    {
        $course = Course::with('prerequisites')->find($courseId);

        if (!$course) {
            return false;
        }

        $prerequisiteIds = $course->prerequisites->pluck('id');

        $passedPrerequisites = Degree::where('student_id', Auth::user()->student->id)
            ->whereIn('course_id', $prerequisiteIds)
            ->where('degree', '>=', 50.00)
            ->count();

        if ($passedPrerequisites === $prerequisiteIds->count()) {
            return true;
        }

        return false;
    }

    public function courseReg(Request $request)
    {
        $courseId = $request->input('courseId');

        $enrollment = new Enrollment();
        $enrollment->course_id = $courseId;
        $enrollment->student_id = Auth::user()->student->id;

        $enrollment->save();

        // Return a response indicating success
        return response()->json([
            'message' => 'Course enrolled successfully',
            'id' => $courseId
        ]);
    }

    public function deleteRegisteredCourse(Request $request)
    {
        $courseId = $request->input('courseId');

        $enrollment = Enrollment::where('course_id', $courseId)
            ->where('student_id', Auth::user()->student->id)
            ->first();

        if ($enrollment) {
            $currentTime = Carbon::now();
            $last_create = Carbon::parse($enrollment->created_at);
            if($currentTime->diffInHours($last_create) < 24){
                
                $enrollment->delete();
                return response()->json([
                    'message' => 'Enrollment deleted successfully',
                    'status' => 'success'
                ]);
            }else{
                return response()->json([
                    'message' => "You can't edit your Enrollment",
                    'status' => 'error'
                ]);
            }            

        }

        return response()->json([
            'message' => 'Enrollment not found',
            'id' => $courseId
        ], 404);
    }
}
