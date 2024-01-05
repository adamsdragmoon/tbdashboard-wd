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

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Data from Panel</h4>
                            </div>                                                                        
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">

                        <form>
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <div class="form-group mb-4">
                                        <label for="exampleFormControlTextarea1"></label>
                                        <textarea class="form-control" name="datapanel" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <button type="submit" class="btn btn-primary">Convert</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Request Withdrawal Forms</h4>
                            </div>                                                                        
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">

                        <form>
                            
                            <div class="row mb-4">
                                <div class="col-lg-4 col-sm-12">
                                <label for="input-tglwktreq">Timestamp Request Wede</label>
                                <input type="datetime" class="form-control" name="tglwktrequest" id="input-tglwktreq" placeholder="yyyy-mm-dd hh:mm:ss">
                                </div>
                                <div class="col-lg col-sm-12">
                                <label for="input-agent">Nama Agent</label>
                                <input type="datetime" class="form-control" name="agent" id="input-agent" placeholder="Kode Nama Agent">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-3 col-sm-12">
                                <label for="input-tglwktreq">MemberID</label>
                                <input type="datetime" class="form-control" name="tglwktrequest" id="input-tglwktreq" placeholder="Member ID">
                                </div>
                                <div class="col-lg-3 col-sm-12">
                                <label for="input-agent">Last Saldo Member</label>
                                <input type="datetime" class="form-control" name="agent" id="input-agent" placeholder="Last Saldo Member">
                                </div>
                                <div class="col-lg col-sm-12">
                                <label for="input-agent">Jumlah Wede</label>
                                <input type="datetime" class="form-control display-6" name="agent" id="input-agent" placeholder="Jumlah Wede">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-lg-3 col-sm-12">
                                <label for="input-tglwktreq">Nama Rekening</label>
                                <input type="datetime" class="form-control" name="tglwktrequest" id="input-tglwktreq" placeholder="Nama Rekening">
                                </div>
                                <div class="col-lg-2 col-sm-12">
                                <label for="input-agent">Jenis Akun</label>
                                <input type="datetime" class="form-control" name="agent" id="input-agent" placeholder="Jenis Akun">
                                </div>
                                <div class="col-lg-2 col-sm-12">
                                <label for="input-agent">Nama Bank</label>
                                <input type="datetime" class="form-control display-6" name="agent" id="input-agent" placeholder="Nama Bank">
                                </div>
                                <div class="col-lg col-sm-12">
                                <label for="input-agent">Nomor Rekening</label>
                                <input type="datetime" class="form-control display-6" name="agent" id="input-agent" placeholder="Nomor Rekening">
                                </div>
                            </div>
                            
                            
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button class="btn btn-warning">Clear</button>
                        </form>
                    </div>
                </div>x
            </div>

        </div>
    </div>
</div>

@endsection