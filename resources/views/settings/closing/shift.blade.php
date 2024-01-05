@extends('layouts.main')

@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">        

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget">
                    <div widget-heading>
                        <h3>Welcome Back, @auth {{ auth()->user()->name }} @else "" @endauth </h3>
                    </div>
                    <div class="widget-content">
                        <p class="widget-total-stats">ini halaman {{ $title }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection