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
                        <p class="widget-total-stats">ini halaman {{ $title }}</p>
                    </div>
                </div>
            </div>

            <div class="searchable-container list">
            <div class="col-xl-4 col-lg-5 col-md-5 col-sm-7 filtered-list-search layout-spacing align-self-center">
                <form class="form-inline my-2 my-lg-0">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" class="form-control product-search" id="input-search" placeholder="Search Agents...">
                    </div>
                </form>
            </div>

            <div class="col-6">
                <div class="row">
                    @foreach ($gp as $provider)
                    
                    <div class="items">
                        <div class="user-name">
                            <p class="">
                                {{ $provider->kodeagent }} 
                                
                            </p>
                        </div>
                        <div class="user-name">
                            <p class="">
                                
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            </div>




        </div>
    </div>
</div>


@endsection