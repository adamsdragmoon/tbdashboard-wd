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
                                            <th>Info Member</th>
                                            <th>Detail Rekening</th>
                                            <th>Jumlah Wede</th>
                                            <th>Info Process</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data ?? [] as $d)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>
                                                <span class="h5">{{ $d->agent }} </span><br>
                                                Dibuat Oleh : {{ $d->createdby }} <br>
                                                Tanggal Dibuat : <br> 
                                                {{ $d->tglwktdibuat}} 
                                            </td>
                                            
                                            <td>
                                                Tanggal Request : <br> 
                                                {{ $d->tglwktrequest }} <br>
                                                MemberID : {{  $d->memberid }} <br>
                                                Last Saldo : {{  number_format($d->saldomember) }}
                                            </td>
                                            <td>
                                                {{ $d->namarek}} <br> 
                                                {{ $d->namabank }} <br> 
                                                {{ $d->norek }}
                                            </td>
                                            <td><strong class="h5">{{ number_format($d->jumlahwd) }}</strong></td>
                                            {{-- <td><div class="h4">{{ $d->status }}</div></td> --}}
                                            
                                            <td>
                                                Tanggal Proses : <br> 
                                                {{ $d->tglwktdiproses}} <br>
                                                Diproses Oleh : {{  $d->diproses_oleh }}
                                            </td>
                                            <td>
                                            
                                                @if ($d->diproses_oleh === auth()->user()->username)
                                                <div class="d-flex gap-2 d-md-flex justify-content-md-end mt-2">
                                                <form action="/fin/updatepending/{{ $d->req_uuid }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-success">
                                                        <i data-feather="check-square"></i><span>Success</span>
                                                    </button>
                                                </form>
                                                <form action="/fin/rejectpending/{{ $d->req_uuid }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger">
                                                        <i data-feather="x-square"></i><span>Reject</span>
                                                    </button>
                                                </form>
                                                </div> 
                                                    
                                                @endif
                                                
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

        </div>
    </div>
</div>

@endsection