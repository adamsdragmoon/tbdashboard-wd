@extends('layouts.main')

@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">        

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget">
                    <div widget-heading>
                        <h3>Welcome Back, @auth {{ auth()->user()->name }} @else "" @endauth </h3>
                    </div>
                    <div class="widget-content">
                        <p class="widget-total-stats">ini halaman {{ $title }}</p>
                    </div>
                    
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-8">
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Withdrawal</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{  $title }}</li>
                    </ol>
                </nav>
            </div>
            </div>

            <div class="col-4">
                <div class="d-flex gap-2 d-md-flex justify-content-md-end mt-2">
                
                <button class="btn btn-warning"><i data-feather="toggle-right" class="text-white"></i>  Suspend App</button>
                
                {{-- <form action="/settings/closing/opendaily" method="POST">
                        @csrf
                    <button type="submit" class="btn btn-info"><i data-feather="toggle-right" class="text-white"></i>  New Shift</button>
                </form> --}}
                </div>
                
            </div>

            <div class="col-xl-12 col-lg-12 col-sm-12 mt-2 layout-spacing">
                            <div class="widget-content widget-content-area br-8">
                                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Transaction Date</th> 
                                            {{-- <th>Summary Transaction</th>
                                            <th>Record Transaction ID</th>  --}}
                                            <th>User Log</th>
                                            <th>Status Transaction</th>
                                            <th></th>
                                            <th></th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data ?? [] as $d)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>
                                                {{-- <span class="h6">{{ $d->tgltransaksiwd->format("d/m/Y") }}</span> --}}
                                                <span class="h6">{{ \Carbon\Carbon::parse($d->tgltransaksiwd)->format("d/m/Y") }}</span> <br>
                                                Start : {{ $d->created_at }} <br>
                                                End : {{ is_null($d->endreqwedeid) ? "" : $d->updated_at }}
                                            </td>
                                            {{-- <td>
                                                Jumlah Transaksi : {{ $d->jumlahtransaksiwd }} <br>
                                                Total Transaksi : {{ $d->totaltransaksiwd}} <br>
                                                Total Pengeluaran Kas : {{ $d->totalpengeluarankaswd}} <br>
                                                Total Penerimaan Kas : {{ $d->totalpenerimaankaswd}}
                                            </td>
                                            <td>
                                                Last Transaksi : {{  $d->lastidtransaksiwd }} <br>
                                                First Transaksi : {{ $d->firstidtransaksiwd  }} <br>
                                                End Transaksi : {{  $d->endidtransaksiwd }}
                                            </td> --}}
                                            <td>
                                                opened by : {{ $d->openby}} <br>
                                                closed by : {{ $d->closingby}} 
                                            </td>
                                            <td>
                                                <span class="h3">{{  $d->status }}</span>
                                            </td>
                                            <td>
                                                <a href="/settings/closing/{{ $d->id }}/listwd" class="btn btn-primary"><i data-feather="eye" class="file-text"></i>  Show Transaction</a>
                                            </td>
                                            <td>
                                                
                                                @if ($d->status === 'Active')
                                                    @can('access-deleteShift')
                                                    <form action="/settings/closing/delete" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger mb-2"><i data-feather="x-square" class="text-white"></i> Delete</button>
                                                    </form>
                                                    @endcan
                                                    
                                                    @can('access-closeShift')
                                                    <form action="/settings/closing/daily" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-info"><i data-feather="toggle-right" class="text-white"></i>  Closing</button>
                                                    </form>
                                                    @endcan
                                                @endif
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