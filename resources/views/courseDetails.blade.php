@extends('layouts.studentLayout')

@section('page title')
    {{$course->course_name}} | Details
@endsection

@section('styles')
    <link rel="stylesheet" href="/csdetail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-inner">
                <h1>{{ $course->course_name }}</h1>
                <p>{{ $course->course_code }} - Academic year : {{ strtoupper($course->study_year) }}</p>
                <p>Dr.{{ $course->professor->user->first_name }} {{ $course->professor->user->last_name }}</p>
            </div>
        </div>
        
        <a href="/courses/{{$course->id}}/lectures" class="card">
            <div class="card-icon">
                <div class="card-icon pdf">
                    <i class="fas fa-file-pdf"></i>
                </div>
            </div>
            <div class="card-inner">
                <h1 style="color: black">Lectures</h1>
                <p>Click here to see the lectures.</p>
            </div>
        </a>

        <a href="/courses/{{$course->id}}/assignments" class="card">
            <div class="card-icon">
                <div class="card-icon exam">
                    <i class="fas fa-book"></i>
                </div>
            </div>
            <div class="card-inner">
                <h1 style="color: black">Assignments</h1>
                <p>Click here to see the assignments.</p>
            </div>
        </a>

        @if (Auth::user()->role->role_name == "Doctor" && $course->status === 'active')
        <div class="card">
            <div class="card-icon">
                <div class="card-icon exam">
                    <i class="fas fa-plus"></i>
                </div>
            </div>
            <div class="card-inner">
                <h1 style="color: black"> <a href="/courses/{{$course->id}}/add-lecture">Add Lecture</a> </h1>
                <p>Click here to add lecture.</p>
                <h1 style="color: black"><a href="https://docs.google.com/forms/u/0/?tgif=d" target="_blank">Add Assignment</a></h1>
                <p>Click here to add assignments.</p>
            </div>
        </div>
        <a href="/courses/{{$course->id}}/students" class="card">
            <div class="card-icon">
                <div class="card-icon pdf">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>
            <div class="card-inner">
                <h1 style="color: black">Students</h1>
                <p>Click here to see the students registered in this course.</p>
            </div>
        </a>
        @endif

        @if ($course->status === 'archived')
            <div style="text-align: center;margin: auto">
                <p style="font-weight: 100; font-size: 1.5rem">Course <strong>{{$course->course_name }}</strong> is archived</p>
                <i style="font-size: 6rem;color: #AAA" class="menu-icon fa fa-archive"></i>
            </div>
        @endif

        @if (Auth::user()->role->role_name == "Admin")
        <form action="/admin/delete-course/{{$course->id}}" method="post">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <input class="btn btn-md btn-danger" type="submit" value="Delete">
        </form>
        <a href="/admin/edit-course/{{$course->id}}" class="btn btn-md btn-info">Edit</a>
        @endif

        @if (Auth::user()->role->role_name == "Student")
        @foreach (Auth::user()->student->degrees as $degree)
            @if($degree->course_id == $course->id)
            <p style="text-align: center">Course degree : {{ $degree->degree}}</p>
            @else
            <p style="text-align: center">Course degree : in progress</p>

            @endif
        @endforeach
           
        @endif

    </div>
@endsection