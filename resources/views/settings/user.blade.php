{{-- @dd($grabbed_data) --}}

@extends('layouts.main')

@section('content')

<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">       
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget">
                    <div widget-heading>
                        <h3>Edit User</h3>
                    </div>
                    <div class="widget-content">
                        <p class="widget-total-stats"></p>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                <form action="{{ route('user.update', $user) }}" method="POST" class="section general-info">
                    @csrf
                    @method('PUT')
                    <div class="info">
                        <h6 class="">General Information</h6>
                        
                        <div class="row">
                            <div class="col-lg-11 mx-auto">
                                <div class="col-xl-12 col-lg-12 col-md-12 mt-md-0 mt-4">
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
                                            <div class="row mt-4">
                                                

                                                {{-- <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control mb-3" id="password" placeholder="Write your email here" value="{{ $user->password }}">
                                                    </div>
                                                </div> --}}

                                                <!-- Password -->
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" required>
                                                </div>

                                                <!-- Password Confirmation -->
                                                <div class="form-group">
                                                    <label for="password_confirmation">Confirm Password</label>
                                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                                </div>

                                                
                                                

                                                <div class="col-md-12 mt-1">
                                                    <div class="form-group text-end">
                                                        {{-- <button class="btn btn-secondary">Save</button> --}}
                                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                                        <a href="/settings/users" class="btn btn-outline-danger">Cancel</a>
                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>


@endsection