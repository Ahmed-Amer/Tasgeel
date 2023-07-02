@extends('layouts.adminLayout')

@section('page title')
    Admin Dashboard
@endsection

@section('content')
<div class="content mt-3">

    <div class="col-sm-6 col-lg-3">
        <div class="social-box first">
            <i class="fas fa-book"></i>
            <ul>
                <li>
                    <span>Courses</span>
                </li>
                <li>
                    <span class="count">{{$data['courses']}}</span>
                </li>
            </ul>
        </div>
    </div>


    <div class="col-sm-6 col-lg-3">
        <div class="social-box second">
            <i class="fa fa-user-graduate"></i>
            <ul>
                <li>
                    <span>Professors</span>
                </li>
                <li>
                    <span class="count">{{$data['professors']}}</span>
                </li>
            </ul>
        </div>
    </div>


    <div class="col-sm-6 col-lg-3">
        <div class="social-box third">
            <i class="fa fa-users"></i>
            <ul>
                <li>
                    <span>Students</span>
                </li>
                <li>
                    <span class="count">{{$data['students']}}</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="social-box fourth">
            <i class="fa fa-award"></i>
            <ul>
                <li>
                    <span>Enrollments</span>
                </li>
                <li>
                    <span class="count">{{$data['enrollments']}}</span>
                </li>
            </ul>
        </div>
    </div>



    


</div>
@endsection