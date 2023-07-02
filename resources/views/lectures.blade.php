@extends('layouts.studentLayout')

@section('page title')
@if (count($lectures) > 0)
{{ $lectures[0]->course->course_name }} |
@endif
Lectures
@endsection

@section('styles')
<link rel="stylesheet" href="/lec.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
@endsection

@section('content')
<div class="container">
    @if (count($lectures) > 0)
    @foreach ($lectures as $lecture)
    <div class="card">
        <div class="card-icon">
            <i class="fas fa-file-pdf"></i>
        </div>
        <div class="card-body">
            <div style="display: flex; justify-content:space-between;">
                <a href="/lecture/view/{{ $lecture->file_path }}" class="card-link" target="_blank">
                    <h5 class="card-title">{{ $lecture->title }}</h5>
                    <p class="card-text">{{ $lecture->description }}</p>
                </a>
                <button onclick="downloadFile('/lectures/{{ $lecture->file_path }}', '{{$lecture->title}}')"
                    type="button" class="btn btn-primary">
                    <div class="download-icon">
                        <i class="fas fa-download"></i>
                    </div>
                </button>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <p style="font-weight: 200; font-size: 22px; margin-top: 25px">There are no lectures for this course</p>
    @endif
</div>
<div class="container" style=" flex-direction: row;">
    <a href="/courses/{{$course_id}}" class="btn btn-md btn-primary">Back to Course</a>
    @if (Auth::user()->role->role_name == 'Doctor')
    <a href="/courses/{{$course_id}}/add-lecture" class="btn btn-md btn-info">Add Lecture</a>
    @endif
</div>
@endsection

@section('scripts')
<script>
    function downloadFile(url, name) {
            var link = document.createElement('a');
            link.href = url;
            link.download = name + '.pdf';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
</script>
@endsection