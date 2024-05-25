@extends('layouts.app')
@section('content')
    <div class="jumbotron p-bg-lighter rounded-3 mt-5 mx-5 d-flex justify-content-evenly">

        <div class="left-side ps-3 z-2">

            <h1 class="fw-bold">
                Full-Stack Portfolio
            </h1>


            <p class="fs-4 w-50 fw-lighter">
                Welcome to my Full-Stack Web Developer Portfolio. Here I collect some of my major projects created in these
                years.
                I developed my skills throughtout a full-course with <span class="fw-semibold"
                    style="color: limegreen">Boolean</span>.
            </p>


        </div>

        <img class="jumbo-img z-1" src="{{ asset('storage/' . 'uploads/jumbo.png') }}" alt="">

    </div>


    <div class="content">

    </div>
@endsection
