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
                                                {{ $d->created_at}} <br>
                                                Dibuat Oleh : {{  $d->createdby }} 
                                            </td>
                                            
                                            <td>
                                                Tanggal Diproses : <br>
                                                {{ $d->updated_at }} <br>
                                                Diproses Oleh : {{ $d->updatedby }}
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

                

        </div>
    </div>
</div>



@endsection