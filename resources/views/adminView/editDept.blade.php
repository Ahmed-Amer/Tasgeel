@extends('layouts.adminLayout')

@section('page title')
    Edit Department
@endsection

@section('content')
    <form  action="/admin/department/{{$dept->id}}/update" method="POST" class="form">
        @csrf
        <input type="hidden" name="_method" value="PUT">

        <h3 style="text-align: center">Edit Department</h3>

        <div class="flex">
            <label>
                <input name="department_name" value="{{$dept->department_name}}" required="" type="text" class="input">
                <span>Name</span>
            </label>

            <label>
                <input name="department_code" value="{{$dept->department_code}}" required="" placeholder="" type="text" class="input">
                <span>Code</span>
            </label>
        </div>



        <button type="submit" class="fancy" href="#">Update dpet</button>
    </form>
@endsection
