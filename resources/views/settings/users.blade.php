{{-- @dd($grabbed_data) --}}

@extends('layouts.main')
@section('content')

<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">        
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget">
                    <div widget-heading>
                        <h3>Welcome Back, @auth {{ auth()->user()->name }} @else guest @endauth</h3>
                    </div>
                    <div class="widget-content">
                        <p class="widget-total-stats">{{ $title }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 layout-spacing">
                <div class="widget">
                    <div widget-heading>
                        <h5>Add User</h5>
                        @if (session()->has('success'))
                            <div class="alert alert-light-success alert-dismissible fade show border-0 mb-4" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                                <strong>Success!</strong> {{ session('success') }}</button>
                            </div> 
                        @endif
                        
                        <hr>
                    </div>
                    <div class="widget-content">
                        <form action="/user" method="post">
                            @csrf
                            <div class="row g-3 mb-4">
                                {{-- <div class="col-sm-5">
                                    <input type="text" class="form-floating" id="name" placeholder="Full Name" aria-label="Name">
                                </div> --}}
                                {{-- <div class="col-sm-4 form-floating">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="email address">
                                    <label for="floatingInput">Email address</label>
                                </div> --}}
                                <div class="col-sm-4 form-floating">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                                    <label for="name">Nama</label>
                                </div>
                                <div class="col-sm-3 form-floating">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="username">
                                    <label for="username">Username</label>
                                </div>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <select id="inputrole" name="role" class="form-select" placeholder="Choose Role...">
                                        <option >Choose Role...</option>
                                        <option value="user">User</option>
                                        <option value="superuser">Super User</option>
                                        <option value="admin">Admin</option>
                                        <option value="superadmin">Super Admin</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="inputdepartment" name="department" class="form-select">
                                        <option selected>Choose Department...</option>
                                        <option value="all">All</option>
                                        <option value="cs">Customer Service</option>
                                        <option value="fin">Finance</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="maxwd" id="maxwd" placeholder="Max WD" aria-label="maxwd">
                                </div>
                                <div class="col-sm">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" aria-label="password">
                                </div>

                            </div>
                            <div class="row">
                                <fieldset class="row g-4">
                                    <legend class=" col-lg-12 col-sm-12 pt-0 h4 text-center">Agent</legend>
                                    <div class="d-grid gap-4 d-md-flex">

                                        @foreach ($dataagen as $dta)

                                        <div class="form-check" >
                                            <input class="form-check-input" type="checkbox" name="agent['{{ $dta->kodeagent }}']">
                                            <label class="form-check-label text-muted" for="gridCheck1">
                                                {{ $dta->namaagent }}
                                            </label>
                                        </div>
                                            
                                        @endforeach

                                    </div>
                                </fieldset>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="switch form-switch-custom switch-inline form-switch-primary form-switch-custom inner-label-toggle mb-sm-0 mb-3">
                                        <div class="input-checkbox"   >
                                            <span class="switch-chk-label label-left">Inactive</span>
                                            <input class="switch-input" type="checkbox" role="switch" name="is_active" id="isactive" 
                                            onchange="this.checked ? this.closest('.inner-label-toggle').classList.add('show') : this.closest('.inner-label-toggle').classList.remove('show')">
                                            <span class="switch-chk-label label-right">Active</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">
                    <table id="zero-config" class="table dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th> 
                                <th>Username</th> 
                                <th>Role</th>
                                <th>Department</th> 
                                <th>Agent</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->username }}
                                </td>
                                <td>
                                    {{ $user->role }}
                                </td>
                                <td>
                                    {{ $user->department }}
                                </td>
                                <td>
                                    <div class="">
                                        @php
                                            $agents = json_decode($user->agent, true);
                                        @endphp

                                        @if(is_array($agents))
                                            @foreach ($agents as $agent => $status)
                                                {{ trim($agent,"'") }}<br>
                                            @endforeach
                                        @else
                                            {{ $user->agent }}
                                        @endif
                                    </div>
                                    {{-- {{ $user->agent }} --}}
                                </td>
                                <td>
                                    <span class="badge outline-badge-{{ ($user->is_active === 1) ? 'success' : 'warning' }}">{{ ($user->is_active === 1) ? 'Active' : 'Not Active' }}</span>
                                </td>
                                <td>
                                    <div class="action-btn">
                                        <div class="flex">
                                            <a href="/settings/user/{{ $user->uuid }}/edit" class="btn btn-outline-info">View</a>
                                            <a href="/settings/user/{{ $user->uuid }}/delete" class="btn btn-outline-danger">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>





@endsection