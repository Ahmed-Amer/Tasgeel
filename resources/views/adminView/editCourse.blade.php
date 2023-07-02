@extends('layouts.adminLayout')

@section('page title')
Edit Course
@endsection

@section('content')
<form method="POST" action="/admin/update-course/{{$data['course']->id}} " class="form">
    <input type="hidden" name="_method" value="PUT">
    @csrf
    <h3 style="text-align: center">Edit Course</h3>
    <div class="flex">
        <label>
            <input name="course_name" value="{{ $data['course']->course_name }}" required="" type="text" class="input">
            <span>Name</span>
            @error('course_name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </label>

        <label>
            <input name="course_code" value="{{ $data['course']->course_code }}" required="" placeholder="" type="text"
                class="input">
            <span>Code</span>
            @error('course_code')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </label>
    </div>
    <label>
        <select class="form-select input" name="study_year" id="academaic_year">
            <option @if($data['course']->study_year === 'general') {{'selected'}} @endif value="general">General..
            </option>
            <option @if($data['course']->study_year === 'first') {{'selected'}} @endif value="first">First year</option>
            <option @if($data['course']->study_year === 'second') {{'selected'}} @endif value="second">Second year
            </option>
            <option @if($data['course']->study_year === 'third') {{'selected'}} @endif value="third">Third year</option>
            <option @if($data['course']->study_year === 'fourth') {{'selected'}} @endif value="fourth">Fourth year
            </option>
        </select>
        <span>Academic year</span>
    </label>
    <label id="edit_depts">
        <select class="form-select input" type="number" name="department_id">
            @foreach ($data['depts'] as $dept)
            <option value="{{ $dept->id }}" @if($data['course']->department_id == $dept->id) {{'selected'}} @endif
                >
                {{ $dept->department_name }}
            </option>
            @endforeach
        </select>
        <span>Department</span>
    </label>
    <label>
        <select class="form-select input" type="number" name="professor_id">
            @foreach ($data['profs'] as $prof)
            <option value="{{ $prof->id }}" @if($data['course']->professor_id == $prof->id) {{'selected'}} @endif

                >
                Dr.{{ $prof->user->first_name }} {{ $prof->user->last_name }}
            </option>
            @endforeach
        </select>
        <span>Professor</span>
    </label>
    <div class="d-flex">
        <label>
            <select class="selectpicker" name="prerequisites[]" multiple aria-label="size 3 select example">
                @foreach ($data['courses'] as $course)

                <option value="{{ $course->id }}" 
                    @foreach ($data['prerequisites'] as $item) 
                        @if ($course->id == $item->prerequisite_id)
                            {{'selected'}}
                        @endif
                    @endforeach

                >
                    {{ $course->course_name }} - {{ $course->course_code }}
                </option>
                @endforeach
            </select>
        </label>
        <span>Prerequiestes</span>
    </div>
    <label>
        <select class="form-select input" name="status">
            <option @if($data['course']->status === 'active') {{'selected'}} @endif value="active">Active</option>
            <option @if($data['course']->status === 'archived') {{'selected'}} @endif value="archived">Archived</option>
        </select>
        <span>Status</span>
    </label>
    <button type="submit" class="fancy" href="">Edit course</button>
</form>
@endsection

@section('scripts')
<script>
    let select = document.getElementById('academaic_year');
    let select2 = document.getElementById('edit_depts');

    if(select.value == 'third' || select.value == 'fourth'){
        select2.style.display = 'block';
    }else{
        select2.style.display = 'none';
    }

select.addEventListener('change', (e) => {
    let val = e.target.value;
    if(val == 'third' || val == 'fourth'){
        select2.style.display = 'block';
    }else{
        select2.style.display = 'none';
    }
})
</script>
@endsection