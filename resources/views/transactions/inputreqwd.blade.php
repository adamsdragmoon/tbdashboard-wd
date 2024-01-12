

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

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                @if (session()->has('error'))
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        
                        <div class="alert alert-light-danger alert-dismissible fade show border-0 mb-4" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                            <strong>Warning!</strong> {{ session('error') }}</button>
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
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow ">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Data from Panel {{ $provider }}</h4>
                            </div>                                                                        
                        </div>
                    </div>
                    <div class="widget-content widget-content-area p-4">

                        @if ($provider === 'idntoto')
                            <form>

                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-4">
                                            <label for="exampleFormControlTextarea1"></label>
                                            <textarea class="form-control" id="datapanel" name="datapanel" oninput="updateValueIDN()" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" onclick="clearTextArea()" class="btn btn-primary">Clear</button>
                                
                                
                            </form>

                        @elseif ($provider === 'idnsports')

                            <form>

                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-4">
                                            <label for="exampleFormControlTextarea1"></label>
                                            <textarea class="form-control" id="datapanel" name="datapanel" oninput="updateValueIDNSports()" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" onclick="clearTextArea()" class="btn btn-primary">Clear</button>
                                
                                
                            </form>

                        @elseif ($provider === 'nexus')

                            <form>

                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-4">
                                            <label for="exampleFormControlTextarea1"></label>
                                            <textarea class="form-control" id="datapanel" name="datapanel" oninput="updateValueNEXUS()" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" onclick="clearTextArea()" class="btn btn-primary">Clear</button>
                                
                                
                            </form>


                            
                        @else

                        <form>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <div class="form-group mb-4">
                                        <label for="exampleFormControlTextarea1"></label>
                                        <textarea class="form-control" id="datapanel" name="datapanel" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="button" onclick="clearTextArea()" class="btn btn-primary">Clear</button>
                        </form>


                        @endif
                        
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Request Withdrawal Forms</h4>
                            </div>                                                                        
                        </div>
                    </div>
                    <div class="widget-content widget-content-area p-4">

                        <form action="/cs/input-reqwd/create" method="POST">
                            @csrf
                            <div class="row mb-4">
                                @if ($provider === 'sbo' || $provider === 'nexus')
                                <div class="col-lg-4 col-sm-12">
                                    <label for="tglwktrequest">Timestamp Request Wede</label>
                                    <input type="text" class="form-control" name="tglwktrequest" id="tglwktrequest" value="{{ now()->format('Y-m-d H:i:s') }}">
                                </div>
                                @else
                                <div class="col-lg-4 col-sm-12">
                                    <label for="tglwktrequest">Timestamp Request Wede</label>
                                    <input type="datetime" class="form-control" name="tglwktrequest" id="tglwktrequest" placeholder="yyyy-mm-dd hh:mm:ss">
                                </div>
                                @endif


                                @if ($provider === 'sbo' || $provider === 'nexus')

                                @php
                                    $useragen = json_decode(auth()->user()->agent);
                                    $kodeagen = array_keys(get_object_vars($useragen));
                                    $kodeagen = array_map(function($item) {
                                        return str_replace("'", "", $item);
                                    }, $kodeagen);
                                @endphp

                                <div class="col-lg col-sm-12">
                                <label for="agent">Nama Agent</label>
                                @foreach($kodeagen as $kode)
                                <input class="form-control" name="agent" id="agent" value="{{ $kode }}">
                                 @endforeach
                                </div>

                                @else
                                <div class="col-lg col-sm-12">
                                <label for="agent">Nama Agent</label>

                                @php
                                    $useragen = json_decode(auth()->user()->agent);
                                    $kodeagen = array_keys(get_object_vars($useragen));
                                    $kodeagen = array_map(function($item) {
                                        return str_replace("'", "", $item);
                                    }, $kodeagen);
                                @endphp

                                {{-- @dd($kodeagen); --}}

                                <input class="form-control" list="dataagent" name="agent" id="agent" placeholder="Search Agent...">
                                    <datalist id="dataagent">
                                        @foreach($kodeagen as $kode)
                                            <option value="{{ $kode }}">{{ $kode }}</option>
                                        @endforeach
                                    
                                    {{-- @foreach ($agents as $agent)
                                    <option value="{{ $agent->kodeagent }}">{{ $agent->namaagent }}</option>
                                    @endforeach --}}
                                    </datalist>
                                </div>
                                @endif
                                
                                
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-3 col-sm-12">
                                <label for="memberid">MemberID</label>
                                <input type="text" class="form-control" name="memberid" id="memberid" placeholder="Member ID">
                                </div>
                                <div class="col-lg-3 col-sm-12">
                                <label for="saldomember">Last Saldo Member</label>
                                <input type="text" class="form-control" name="saldomember" id="saldomember" placeholder="Last Saldo Member">
                                </div>
                                <div class="col-lg col-sm-12">
                                <label for="jumlahwd">Jumlah Wede</label>
                                <input type="text" class="form-control display-6" name="jumlahwd" id="jumlahwd" placeholder="Jumlah Wede">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-3 col-sm-12">
                                <label for="namarek">Nama Rekening</label>
                                <input type="text" class="form-control" name="namarek" id="namarek" placeholder="Nama Rekening">
                                </div>
                                <div class="col-lg-2 col-sm-12">
                                <label for="kategorirek">Jenis Akun</label>
                                <input type="text" class="form-control" name="kategorirek" id="kategorirek" value="default">
                                </div>
                                <div class="col-lg-2 col-sm-12">
                                <label for="namabank">Nama Bank</label>
                                <input type="text" class="form-control display-6" name="namabank" id="namabank" placeholder="Nama Bank">
                                </div>
                                <div class="col-lg col-sm-12">
                                <label for="norek">Nomor Rekening</label>
                                <input type="text" class="form-control display-6" name="norek" id="norek" placeholder="Nomor Rekening">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" onclick="clearFieldInput()"  class="btn btn-warning">Clear</button>
                        </form>
                    </div>
                </div>
            </div>

            

        </div>
        <div class="row layout-px-spacing">

                <div class="middle-content container-xxl p-0">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget">
                                <div widget-heading>
                                    {{-- <h3>Rekap Transaksi Success</h3> --}}
                                </div>
                                <div class="widget-content">
                                   <h4>Total Transaksi Per Agent : <span class="h3">{{ number_format($totalreqall) }}</span></h4>
                                   <p>Transaksi termasuk : Open, Process, Pending, Success</p>
                                    
                                </div>
                            </div>
                        </div>

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

                        
    
                    {{-- </div> --}}

                </div>

            </div>
    </div>
</div>

<script>
var datapanelValue = '';

function clearTextArea() {
    document.getElementById("datapanel").value = "";
}

function clearFieldInput() {
    document.getElementById("tglwktrequest").value = "";
    document.getElementById("memberid").value = "";
    document.getElementById("saldomember").value = "";
    document.getElementById("jumlahwd").value = "";
    document.getElementById("namarek").value = "";
    document.getElementById("namabank").value = "";
    document.getElementById("norek").value = "";
    document.getElementById("kategorirek").value = "";
    document.getElementById("agent").value = "";
}

function updateValueIDN() {
    let datapanelValue = document.getElementById("datapanel").value;
    // console.log(datapanelValue); 
    // const str = "`" + datapanelValue + "`";
    const str = datapanelValue;
    
    const regex_a = /\n/g
    const a = str.split(regex_a)
    const line1 = a[0]
    const line2 = a[1]
    const line3 = a[2]
    const line4 = a[3]
    
    
    const m = line1.match(/\w+/g)
    const memberid = m[0]
    
    w = line2.split(/\t/g)
    waktu_request = w[1]
    jumlah_request = Number(w[2].replace(/[,.\s]/g,""))
    saldo_member_string = Number(w[3].replace(/[,\s]/g,""))
    saldo_member = Math.floor(Number(saldo_member_string))
    
    b = line4.split(/,\s/g)
    nama_bank = b[0].replace(/[,.\s]/g,"")
    no_rek = b[1]
    nama_rek = b[2]
    

    document.getElementById("tglwktrequest").value = waktu_request;
    document.getElementById("memberid").value = memberid;
    document.getElementById("saldomember").value = saldo_member;
    document.getElementById("jumlahwd").value = jumlah_request;
    document.getElementById("namarek").value = nama_rek;
    document.getElementById("namabank").value = nama_bank;
    document.getElementById("norek").value = no_rek;
    document.getElementById("kategorirek").value = "default";
    document.getElementById("agent").value = "{{ implode(', ', $kodeagen) }}";

}

function updateValueIDNSports() {

    let datapanelValue = document.getElementById("datapanel").value;
    const str = datapanelValue;

    const regex_a = /\t/g
    const a = str.split(regex_a)
    const member_id = a[0]
    
    const akun = a[1]
    const nb = akun.match(/\w+/g)
    const nama_bank = nb[0]
    
    const nr = akun.split(/\s/g)
    const no_rek = nr[1].replace(/-/g,"")
    const nama = a[1].split(nr[1])
    const nama_rek = nama[1].replace(/\s/,"")
    
    const jumlah_request = Number(a[2].replace(/,/g,""))
    const saldo_member = Number(a[3])
    const part = a[4]
    const parts = a[4].split(" ");
    const dateParts = parts[0].split("/");
    const waktu_request = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]} ${parts[1]}`;

    
    document.getElementById("tglwktrequest").value = waktu_request;
    document.getElementById("memberid").value = member_id;
    document.getElementById("saldomember").value = saldo_member;
    document.getElementById("jumlahwd").value = jumlah_request;
    document.getElementById("namarek").value = nama_rek;
    document.getElementById("namabank").value = nama_bank;
    document.getElementById("norek").value = no_rek;
    document.getElementById("kategorirek").value = "default";
    document.getElementById("agent").value = "{{ implode(', ', $kodeagen) }}";

}

function updateValueNEXUS() {
    let datapanelValue = document.getElementById("datapanel").value;
    const str = datapanelValue;

    const regex_a = /\t/g;
    const a = str.split(regex_a);

    
    const wktpart = a[0];
    const wktparts = a[0].split(/\n/g);
    const dateParts = wktparts[0].split("-");
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const monthNumber = months.indexOf(dateParts[1]) + 1;
    const monthString = monthNumber < 10 ? '0' + monthNumber : monthNumber.toString();
    // const waktu_request = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]} ${wktparts[1]}`;
    const waktu_request = `${dateParts[2]}-${monthString}-${dateParts[0]} ${wktparts[1]}`;
    const member_id = a[2];
    const saldo_member = Number(a[9].replace(/,/g,""));
    const jumlah_request = Number(a[7].replace(/,/g,""));
    const nama_rek = a[6];

    const detail_rek = a[5];
    // const nama_bank = detail_rek.match(/[a-zA-Z]\w+/g)[4];
    const matches = detail_rek.match(/[a-zA-Z]\w+/g);
    const nama_bank = matches && matches.length > 4 ? matches[4] : matches[3];

    // const matches = detail_rek.match(/[a-zA-Z]\w+/g);
    // const nama_bank = matches && matches.length > 2 ? matches[2] : null;
    const no_rek = detail_rek.match(/\d\w+/g)[0];

    console.log(waktu_request);
    console.log(member_id);
    console.log(saldo_member);
    console.log(jumlah_request);
    console.log(nama_rek);
    console.log(nama_bank);
    console.log(no_rek);

    document.getElementById("tglwktrequest").value = waktu_request;
    document.getElementById("memberid").value = member_id;
    document.getElementById("saldomember").value = saldo_member;
    document.getElementById("jumlahwd").value = jumlah_request;
    document.getElementById("namarek").value = nama_rek;
    document.getElementById("namabank").value = nama_bank;
    document.getElementById("norek").value = no_rek;
    document.getElementById("kategorirek").value = "default";
    document.getElementById("agent").value = "{{ implode(', ', $kodeagen) }}";
}

</script>

@endsection