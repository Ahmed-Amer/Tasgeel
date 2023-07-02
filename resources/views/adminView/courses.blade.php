@extends('layouts.adminLayout')

@section('page title')
Courses
@endsection

@section('content')

<div class="row">
    <div class="col-md-10 mx-auto mt-2">
        {{-- messages --}}
        @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif

        @if (session('delete'))
        <div class="alert alert-danger">{{session('delete')}}</div>
        @endif
    </div>
</div>

<div class="content mt-3">

    <div style="margin: 0 0 15px 15px">
        <button class="btn btn-md btn-warning" onclick="@if($register == 0)activeCourses()@else deActiveCourses()@endif"
            type="submit">
            @if ($register == 0)Activate registeration @else Deactivate registeration @endif
        </button>
        <a href="/admin/add-course" class="btn btn-primary btn-md">Add Course</a>
    </div>

    @foreach ($courses as $course)
    <div class="col-lg-3 col-md-6">
        <a href="/courses/{{ $course->id }}">
            <div class="card" style="
                    border: 1px solid #ccc;
                    overflow: hidden;
                    white-space: nowrap;">
                <div class="card-body">
                    <div class="stat-widget-four">
                        <div class="stat-icon dib">
                            <i class="ti-server text-muted"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-heading">
                                    <span style="display: inline-block;
                                    max-width: 100%;
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    white-space: nowrap;">
                                        {{ $course->course_name }}
                                    </span>
                                </div>
                                <div class="stat-text">Dr.{{ $course->professor->user->first_name }}
                                    {{ $course->professor->user->last_name }}</div>
                                <small>{{ $course->course_code }} - Year : {{$course->study_year}}</small>
                                @if ($course->status === 'archived')
                                <span style="
                                color: #fff;
                                background-color: brown;
                                font-size: 0.8rem;
                                padding: 3px 10px;
                                border-radius: 5px;
                                position: absolute;
                                top: 5px;
                                right: 5px;
                                ">archived</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach



</div> <!-- .content -->
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script>
    function activeCourses()
    {
        var id = 1;

            $.ajax({
                url: '/admin/active-courses-register',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    // Show a pop-up message with the response
                    alert(response.message);
                    location.reload();
                },
                error: function(xhr) {
                    // Show a pop-up message with the error
                    alert('Error: ' + xhr.responseText);
                }
            });
    }
    function deActiveCourses()
    {
        var id = 1;

            $.ajax({
                url: '/admin/deactive-courses-register',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    // Show a pop-up message with the response
                    alert(response.message);
                    location.reload();
                },
                error: function(xhr) {
                    // Show a pop-up message with the error
                    alert('Error: ' + xhr.responseText);
                }
            });
    }
    // $(document).ready(function() {
    //     $('#ActiveButtton').click(function() {
    //         var id = 1;

    //         $.ajax({
    //             url: '/admin/active-courses-register',
    //             type: 'POST',
    //             data: {
    //                 id: id
    //             },
    //             success: function(response) {
    //                 // Show a pop-up message with the response
    //                 alert(response.message);
    //                 location.reload();
    //             },
    //             error: function(xhr) {
    //                 // Show a pop-up message with the error
    //                 alert('Error: ' + xhr.responseText);
    //             }
    //         });
    //     });

    //     $('#DeactiveButtton').click(function() {
    //         var id = 1;

    //         $.ajax({
    //             url: '/admin/deactive-courses-register',
    //             type: 'POST',
    //             data: {
    //                 id: id
    //             },
    //             success: function(response) {
    //                 // Show a pop-up message with the response
    //                 alert(response.message);
    //                 location.reload();
    //             },
    //             error: function(xhr) {
    //                 // Show a pop-up message with the error
    //                 alert('Error: ' + xhr.responseText);
    //             }
    //         });
    //     });
    // });
</script>
@endsection