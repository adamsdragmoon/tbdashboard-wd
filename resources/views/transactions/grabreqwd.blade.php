{{-- @dd($grabbed_data) --}}

@extends('layouts.main')
@section('content')

<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">        
        <div class="row layout-top-spacing">

            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget ">
                    <div widget-heading>
                        <h3>Welcome Back, @auth <span style="color: black">{{ auth()->user()->name }}</span> @endauth</h3>
                    </div>
                    <div class="widget-content">
                        <p class="widget-total-stats">{{ $title }}</p>
                    </div>
                </div>
            </div>

            <div class="col-xl col-md-6 col-sm-12 col-12 layout-spacing">
                <form action="" method="POST">
                    @csrf
                    <div class="widget bg-info">
                        <div widget-heading>
                            {{-- <h3>Grab All</h3> --}}
                        </div>
                        <div class="widget-content">
                            <div class="row ">
                            <p class="widget-total-stats text-center text-white">Grab All Request WD with all type of transactions.</p>
                            <button class="btn col-8 mx-auto"><i data-feather="download"></i>Grab Now</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @if (session()->has('errorGrab'))
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                
                <div class="alert alert-light-danger alert-dismissible fade show border-0 mb-4" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                    <strong>Warning!</strong> {{ session('errorGrab') }}</button>
                </div> 
             
            </div>
            @endif

            @if (session()->has('success'))
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                
                <div class="alert alert-light-success alert-dismissible fade show border-0 mb-4" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                    <strong>Success!</strong> {{ session('success') }}</button>
                </div> 
             
            </div>
            @endif

            {{-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget">
                    <div widget-heading>
                        <h3>Grab All Bank</h3>
                    </div>
                    <div class="widget-content">
                        <p class="widget-total-stats">Grab All Request WD with only transaction for Bank.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget">
                    <div widget-heading>
                        <h3>Grab All eWallet</h3>
                    </div>
                    <div class="widget-content">
                        <p class="widget-total-stats">Grab All Request WD with only transaction for eWallet.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget">
                    <div widget-heading>
                        <h3>Grab Bank</h3>
                    </div>
                    <div class="widget-content">
                        <p class="widget-total-stats">Grab All Request WD with only transaction for selected bank.</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget">
                    <div widget-heading>
                        <h3>Grab eWallet</h3>
                    </div>
                    <div class="widget-content">
                        <p class="widget-total-stats">Grab All Request WD with only transaction for selected eWallet.</p>
                    </div>
                </div>
            </div> --}}

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-three">

                    <div class="widget-heading">
                        <h5 class="">Grabbed Withdrawal List</h5>
                    </div>

                    <div class="widget-content">
                        <div class="table-responsive">
                            <table class="table table-scroll">
                                <thead style="color: black">
                                    <tr>
                                        <th><div class="th-content">No</div></th>
                                        <th><div class="th-content">Timestamp</div></th>
                                        <th><div class="th-content">Agent</div></th>
                                        <th><div class="th-content">Member Info</div></th>
                                        <th><div class="th-content">Informasi Rekening</div></th>
                                        <th><div class="th-content">Jumlah WD</div></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grabbed_data as $data)
                                    <tr>
                                        <td>
                                            <div>
                                                {{ $loop->iteration }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p class="text-muted">
                                                    
                                                    created by : {{ $data['createdby']}}<br>
                                                    created at : <br>
                                                    {{ $data->created_at->format('d M Y H:i:s') }} <br>
                                                    requested at : <br>
                                                    {{ $data->tglwktrequest }}
                                                </p>
                                                
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <strong class="h4">{{ $data['agent']}}</strong>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="product-name">
                                                <div class="align-self-center">
                                                    <p class="prd-name">memberid : <span class="h5">{{ $data->memberid}}</span></p>
                                                    <p class="prd-category text-primary">
                                                        Last saldo member : {{ number_format($data->saldomember)}} 
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                    
                                        <td>
                                            <div class="h5">
                                                {{ $data->namarek}} <br> {{ $data->namabank}} {{ $data->norek }}
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="text-end" >
                                                    <span class="display-6 text-end">{{ number_format($data['jumlahwd'])}}</span> <br>
                                                    
                                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                            <form action="/fin/cancel-grabwd/{{ $data->req_uuid}}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="badge bg-danger">
                                                                    <i data-feather="x" class="text-white"></i>
                                                                    <span>Cancel</span>
                                                                </button>
                                                                </form>
                                                        
                                                            <form action="/fin/show-grabwd/{{ $data->req_uuid}}" method="GET">
                                                                @csrf    
                                                                <button class="badge bg-primary" autofocus>
                                                                    <i data-feather="check" class="text-white"></i>
                                                                    <span>Process</span>
                                                                </button>
                                                            </form>
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
    </div>
</div>
                

@endsection