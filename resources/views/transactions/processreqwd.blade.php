{{-- @dd($process_data ) --}}

@extends('layouts.main')

@section('content')

<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">        
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-three">

                    <div class="widget-heading">
                        <h3 class="">{{ $title }}</h3>
                    </div>

                    <div class="widget-content">
                        <div class="table-responsive">
                            <table class="table table-scroll">
                                <thead>
                                    <tr>
                                        <th><div class="text-start">Items</div></th>
                                        <th><div class="text-start">Descriptions</div></th>
                                        <th><div class="text-start">Notes</div></th>

                                    </tr>
                                </thead>
                                <tbody>
                                
                                    <tr>
                                        <td>
                                            <div class="">
                                                Agent
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                            {{ $process_data->agent}}<br>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                Created By : {{ $process_data->createdby}} <br>
                                                Created At : {{ $process_data->created_at}} <br>
                                                Requested At : {{ $process_data->tglwktrequest}} 
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">
                                            <hr>
                                        </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <td>
                                            <div class="">
                                                Informasi Member
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                Member ID : <span class="h5">{{ $process_data->memberid}} </span><br>
                                                Last Saldo Member : {{ number_format($process_data->saldomember)}}
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    
                                    
                                    
                                    <tr>
                                        <td colspan="3">
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="">
                                                Informasi Rekening
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <span class="h3">{{ $process_data->namarek}} </span>  <br> 
                                                {{ $process_data->namabank}} {{ $process_data->norek }}
                                            </div>
                                        </td>
                                        <td>
                                            Tujuan Transfer : <br>
                                            <div class="h3">{{ $tujuantransfer }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr >
                                        <td >
                                            <div class="">
                                                Jumlah WD
                                            </div>
                                        </td>
                                        <td>
                                            Jumlah Wede : 
                                            <div class="h4">
                                                {{ number_format($process_data->jumlahwd)}}
                                            </div>
                                        </td>
                                        <td>
                                            Jumlah Transfer : <br>
                                            <div class="display-6" name="jumlahtransfer" id="jumlahtransfer"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <form action="/fin/process-grabwd/{{ $process_data->req_uuid }}" method="POST" onsubmit="return confirmSubmit()">
                        @csrf
                        <div class="d-flex gap-2 d-md-flex">
                        <div class="form-group col-8">
                            <label>Catatan Proses</label>
                            <input type="text" class="form-control" name="catatanproses" placeholder="Catatan atau Referensi dari proses transaksi">
                        </div>
                        <div class="form-group col-4">
                            <label>Biaya Proses</label>
                            <input type="text" class="form-control" name="biayaproses" id="biayaproses" placeholder="Biaya Proses" autofocus required>
                        </div>
                        </div>  
                    <div class="d-flex gap-2 d-md-flex justify-content-md-end mt-2">    
                        <button type="submit" class="btn btn-success"><i data-feather="check-square" class="text-white"></i>Success</button>
                    </div>
                </form>
            </div>

            

            <hr>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="d-flex gap-2 d-md-flex justify-content-md-end">
                    
                    
                
                    <form action="/fin/pending-grabwd/{{ $process_data->req_uuid }}" method="POST">
                        @csrf
                    <button type="submit" class="btn btn-info"><i data-feather="clock" class="text-white"></i>Pending</button>
                    </form>
 
                    <form action="/fin/reject-grabwd/{{ $process_data->req_uuid }}" method="POST">
                        @csrf
                    <button type="submit" class="btn btn-danger"><i data-feather="x-square" class="text-white"></i>Reject</button>
                    </form>
                    
                    <a href="/fin/grab-reqwd" class="btn btn-warning"><i data-feather="arrow-left-circle" class="text-white"></i>Cancel</a>
                    
                </div>
            </div>


        </div>

    </div>
</div>

<script>
    document.getElementById('biayaproses').addEventListener('input', function(e) {
        var biayaproses = e.target.value;
        var jumlahwd = {{ $process_data['jumlahwd'] }};
        var jumlahtransfer = jumlahwd - biayaproses;
        document.getElementById('jumlahtransfer').textContent = jumlahtransfer;
    });

    function confirmSubmit() {
    var r = confirm("Apakah yakin ingin melanjutkan Process WD dengan Status SUCCESS ?");
        if (r == true) {
            return true;
        } else {
            return false;
        }
    }
</script>

@endsection

