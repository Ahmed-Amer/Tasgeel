@extends('layouts.studentLayout')

@section('page title')
    Student | Profile
@endsection

@section('styles')
    <link rel="stylesheet" href="/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
@endsection

@section('content')
    <div class="container">
        <h2 class="h2 pb-3 mt-4 mb-4" style="font-weight: 200; border-bottom: 1px solid #ccc">Student Profile</h2>
        <p style="font-weight: 300">Student name : {{$student->user->first_name . " " . $student->user->last_name}}</p>
        <p style="font-weight: 300">Student email : {{$student->user->email}}</p>
        <p style="font-weight: 300">Student phone number : {{$student->user->phone_number}}</p>
        <p style="font-weight: 300">Student academic year : {{$student->study_year}}</p>
        <p style="font-weight: 300">Student GPA : {{$student->gpa ? $student->gpa : 'to be calculated'}}</p>

        <a href="/student/dashboard" class="btn btn-md btn-primary">check your enrollments</a>

    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/index.js"></script>
    <script>
        function registerCourse(courseId) {
            $.ajax({
                url: '/student/register',
                type: 'POST',
                dataType: 'json',
                data: {
                    courseId: courseId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert('Error registering course:');
                }
            });
        }

        function deleteRegisteredCourse(courseId) {
            $.ajax({
                url: '/student/delete-register',
                type: 'POST',
                dataType: 'json',
                data: {
                    courseId: courseId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert('Error unregistering course:');
                }
            });
        }
    </script>
@endsection
