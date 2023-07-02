@extends('layouts.studentLayout')

@section('page title')
Course Register
@endsection

@section('styles')
<link rel="stylesheet" href="/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
@endsection

@section('content')
<div class="container">
    <h2 class="h2 pb-3 mt-4 mb-4" style="font-weight: 200; border-bottom: 1px solid #ccc">Available courses</h2>

    @for ($i = 0; $i < count($courses); $i++) <div class="card d-block">
        <div class="d-flex">
            <a onclick="@if($actives[$i])deleteRegisteredCourse({{$courses[$i]->id}})@else registerCourse({{$courses[$i]->id}})@endif"
                style="background: none; border: none">
                <div class="card-icon @if ($actives[$i]) active @endif">
                    <i class="fas fa-plus"></i>
                </div>
            </a>
            <div class="card-content">
                <h2 class="card-title">{{ $courses[$i]->course_name }} - {{ $courses[$i]->course_code }}</h2>
                <p class="card-description">
                    Dr.{{ $courses[$i]->professor->user->first_name }}
                    {{ $courses[$i]->professor->user->last_name }} - Academic year : {{$courses[$i]->study_year}}

                    @if ($courses[$i]->study_year === 'third' || $courses[$i]->study_year === 'fourth')
                    - Dept : {{ $courses[$i]->department->department_name }}
                    @endif
                </p>

            </div>
        </div>
</div>
@endfor
<p style="font-weight: 200; margin: 30px 10px">Note: You only have <strong>24 Hours</strong> to edit your enrollment after registeration.</p>

</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.all.min.js"
    integrity="sha512-kW/Di7T8diljfKY9/VU2ybQZSQrbClTiUuk13fK/TIvlEB1XqEdhlUp9D+BHGYuEoS9ZQTd3D8fr9iE74LvCkA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    Swal.fire({
                            icon: 'success',
                            title: 'Course Registeration',
                            text: response.message,
                            showConfirmButton : false ,
                        });
                        setTimeout(() => {
                        location.reload();
                    }, 2500);
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
                    Swal.fire({
                            icon: response.status,
                            title: 'Course Withdraw',
                            text: response.message,
                            showConfirmButton : false,
                        });
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                },
                error: function(xhr, status, error) {
                    alert('Error unregistering course:');
                }
            });
        }
</script>
@endsection