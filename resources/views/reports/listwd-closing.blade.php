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
                                            <th>Agen</th> <!-- Nama Agent dan username cs -->
                                            <th>Diminta Oleh</th>
                                            <th>Dibuat Oleh</th> <!-- Waktu Request dan Waktu Input -->
                                            <th>Diproses Oleh</th>
                                            <th>Jumlah Wede</th>
                                            <th>Status</th>
                                            {{-- <th>Status Wede</th> --}}
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data ?? [] as $d)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>
                                                <span class="h5">{{ $d->agent }} </span>
                                            </td>
                                            <td>
                                                Tanggal Request : <br> 
                                                {{ $d->tglwktrequest }} <br>
                                                MemberID : {{  $d->memberid }} <br>
                                                Last Saldo : {{  number_format($d->saldomember) }} <br>
                                                {{ $d->namarek}} <br> 
                                                {{ strtoupper($d->namabank) }} {{ $d->norek }}
                                            </td>
                                            <td>
                                                Tanggal Dibuat : <br> 
                                                {{ $d->tglwktdibuat}} <br>
                                                Dibuat Oleh : {{  $d->dibuat_oleh }} 
                                            </td>
                                            
                                            <td>
                                                Tanggal Diproses : <br>
                                                {{ $d->created_at }} <br>
                                                Diproses Oleh : {{ $d->diproses_oleh }}
                                            </td>
                                            
                                            <td><strong class="h5">{{ number_format($d->jumlahwd) }}</strong></td>
                                            {{-- <td><div class="h4">{{ $d->status }}</div></td> --}}
                                            {{-- <td>
                                                <a href="/reports/statuswd/{{ $d->uuid }}" class="badge bg-warning"><i data-feather="eye"></i>Update</a>
                                            </td> --}}
                                            <td> {{ $d->status}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
    
                    {{-- </div> --}}

                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget">
                        <div widget-heading>
                            <h3>Rekap Transaksi</h3>
                        </div>
                        <div class="widget-content">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            
                                            <th  scope="col">Keterangan</th>
                                            <th  scope="col">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Jumlah Transaksi Success</td>
                                            <td>{{ number_format($jumlahdata) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Transaksi Success</td>
                                            <td>{{ number_format($totaldata) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-5 layout-spacing">
                    <div class="widget">
                        <div widget-heading>
                            <h3>Rekap Transaksi Success Per Agen</h3>
                        </div>
                        <div class="widget-content">
                            
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama Agent</th>
                                            <th class="text-center" scope="col">Total Transaksi Success</th>
                                            <th class="text-center" scope="col">Jumlah Transaksi Success</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($agents as $agent)
                                        <tr>
                                            <td>{{  $agent->namaagent }}</td>
                                            <td class="text-center">{{ number_format($agent->totalTransaksiByStatus['success']['total']?? 0) }}</td>
                                            <td class="text-center">{{ number_format($agent->totalTransaksiByStatus['success']['jumlah']?? 0) }}</td>
                                            {{-- <td class="text-center">
                                                <span class="badge badge-light-success">Approved</span>
                                            </td> --}}
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                

            </div>

        </div>
    </div>
</div>

@endsection