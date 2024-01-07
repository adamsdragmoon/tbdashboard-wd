{{-- @dd($datareqagent) --}}

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
                    {{-- <div class="page-meta">
                        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Withdrawal</a></li>
                                <li class="breadcrumb-item active" aria-current="page">All Transactions</li>
                            </ol>
                        </nav>
                    </div> --}}
                    <!-- /BREADCRUMB -->
    
                    {{-- <div class="row layout-top-spacing"> --}}
                    
                        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                            <div class="widget-content widget-content-area br-8">
                                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Agen</th> <!-- Nama Agent dan username cs -->
                                            <th>Diminta Oleh</th> <!-- Waktu Request dan Waktu Input -->
                                            <th>Dibuat Oleh</th> <!--MemberID dan Last Saldo Member -->
                                            <th>Diproses Oleh</th> <!-- Nama Bank, No. Rek.-->
                                            <th>Jumlah Wede</th>
                                            <th>Status Wede</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data ?? [] as $d)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>
                                                <span class="h5">{{ $d->agent }} </span><br>
                                                
                                            </td>
                                            <td>
                                                Tanggal Request : <br> {{ $d->tglwktrequest }} <br>
                                                MemberID : {{  $d->memberid }} <br>
                                                Last Saldo : {{  number_format($d->saldomember) }} <br>
                                                {{ $d->namarek}} <br> 
                                                {{-- {{ $d->kategorirek }}  --}}
                                                {{ $d->namabank }} {{ $d->norek }}
                                            </td>
                                            <td>
                                                Tanggal Input : <br> {{ $d->created_at}} <br>
                                                cs : {{ $d->createdby }}
                                            </td>
                                            <td>
                                                Tanggal Proses : <br> {{ $d->updated_at}} <br>
                                                Diproses Oleh : <br>
                                                {{ $d->updatedby }}
                                            </td>
                                            <td><strong class="h5">{{ number_format($d->jumlahwd) }}</strong></td>
                                            <td><div class="h4">{{ $d->status }}</div></td>
                                            {{-- <td>
                                                <a href="/reports/statuswd/{{ $d->uuid }}" class="badge bg-info"><i data-feather="eye"></i></a>
                                            </td> --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget">
                                <div widget-heading>
                                    {{-- <h3>Rekap Transaksi Success</h3> --}}
                                </div>
                                <div class="widget-content">
                                   <h4>Total Transaksi Per Agent : <span class="h3">{{ number_format($totalallperagent) }}</span></h4>
                                   <p>Transaksi : Open, Process, Pending, Success</p>

                                   <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Keterangan</th>
                                            <th class="text-center" scope="col">Nilai</th>
                                        </tr>
                                    </thead>
                                        <tr>
                                            <td>Total Transaksi Open</td>
                                            <td class="text-end">{{  number_format($totalopen) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Transaksi Process</td>
                                            <td class="text-end">{{  number_format($totalprocess) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Transaksi Pending</td>
                                            <td class="text-end">{{  number_format($totalpending) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Transaksi Success</td>
                                            <td class="text-end">{{  number_format($totalsuccess) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Transaksi Reject</td>
                                            <td class="text-end">{{  number_format($totalreject) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Grand Total</td>
                                            <td class="text-end">{{  number_format($grandtotal) }}</td>
                                        </tr>
                                    <tbody>
                                    </tbody>
                                </table>
                                    
                                </div>
                            </div>
                        </div>
    
                    {{-- </div> --}}

                </div>

            </div>

        </div>
    </div>
</div>

@endsection