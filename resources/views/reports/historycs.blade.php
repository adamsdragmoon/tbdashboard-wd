@extends('layouts.main')

@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">                                             
                
        <div class="row layout-top-spacing">

            @auth

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget">
                    <div widget-heading>
                        <h3>Welcome Back, {{ auth()->user()->name }}</h3>
                    </div>
                    <div class="widget-content">
                        <p class="widget-total-stats">you are login as <span class="h5">{{ auth()->user()->role }}</span></p>
                    </div>

                </div>
            </div>

            <div class="row layout-px-spacing">

                <div class="middle-content container-xxl p-0">

                    <!-- BREADCRUMB -->
                    <div class="page-meta">
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Withdrawal</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{  $title }}</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- /BREADCRUMB -->
    
                    {{-- <div class="row layout-top-spacing"> --}}
                    
                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                            <div class="widget-content widget-content-area br-8">
                                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Laporan</th>
                                            <th>Info Opening</th>
                                            <th>Info Closing</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data ?? [] as $d)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>
                                                <span class="h5">{{ $d->tgltransaksiwd }} </span>
                                            </td>
                                            <td>
                                                Waktu Open : <br>
                                                {{ $d->created_at }} <br>
                                                Opened By : {{ $d->openby }}
                                            </td>
                                            <td>
                                                Waktu Close : <br>
                                                {{  $d->updated_at }} <br>
                                                Closed By : {{  $d->closingby }}
                                            </td>
                                            <td>
                                                <div class="h4">{{ $d->status }}</div>
                                            </td>
                                        
                                            <td>
                                                {{-- <a href="/reports/hariancs/{{ $d->firstreqwedeid }}-{{ $d->endreqwedeid }}" class="btn btn-info"><i data-feather="eye" class="text-white"></i><span> Show Transactions</span></a> --}}
                                                <a href="/settings/closing/{{ $d->id }}/listwd" class="btn btn-primary"><i data-feather="eye" class="file-text"></i>  Show Transaction</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
    
                    {{-- </div> --}}

                </div>
            </div>

            @else


            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget">
                    <div widget-heading>
                        <h3>Welcome,</h3>
                    </div>
                    <div class="widget-content">
                        <p class="widget-total-stats">you are login as guest. Please <a href="/login">Login</a>!</p>
                    </div>

                </div>
            </div>



            @endauth

            

        </div>
    </div>
</div>

@endsection