{{-- @dd($grabbed_data) --}}

@extends('layouts.main')

@section('content')

<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">       
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget">
                    <div widget-heading>
                        <h3>Profile</h3>
                    </div>
                    <div class="widget-content">
                        <p class="widget-total-stats"></p>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

                <div class="widget">
                    <div widget-heading>
                        <h3>User General Information</h3>
                    </div>
                    <div class="widget-content">
                        <div class="form">
                            <span>
                                Unique ID : {{ $user->uuid }} <br>
                                Created at : {{ $user->created_at }} <br>
                                Last Update at : {{ $user->updated_at }} <br>
                                Nama : {{ $user->name }} <br>
                                Username : {{ $user->username }} <br>
                                Department : {{ $user->department }} <br>

                                Active : {{ ($user->is_active === 1) ? 'Yes' : 'No' }} <br>
                                Role : {{ $user->role }} <br>

                                @php
                                    $userAgent = json_decode($user->agent);
                                @endphp

                                Agent : <br>
                                @foreach ($userAgent as $agent=>$value)
                                    {{ trim($agent,"'") }}, 
                                @endforeach
                            </span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


@endsection