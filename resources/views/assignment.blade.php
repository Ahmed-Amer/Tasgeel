@extends('layouts.studentLayout')

@section('page title')
    Assignments
@endsection

@section('styles')
    <link rel="stylesheet" href="/ass.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
@endsection

@section('content')
    <div class="container">

        @if (count($assignments) > 0)
            @foreach ($assignments as $assignment)
                <a href="link_for_lectures" class="card-link" target="_blank">
                    <div class="card">
                        <div class="card-icon">
                            <i class="fas fa-link"></i>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $assignment->title }}</h5>
                            <p class="card-text">{{ $assignment->description }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
        <p style="font-weight: 200; font-size: 22px; margin-top: 25px">There are no assignments for this course</p>
        @endif

    </div>
@endsection
