@extends('layouts.main')

@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">        

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget">
                    <div widget-heading>
                        <h3>Welcome Back, @auth {{ auth()->user()->name }} @else "" @endauth</h3>
                    </div>
                    <div class="widget-content">
                        <p class="widget-total-stats">ini halaman {{ $title }}</p>
                    </div>
                </div>
            </div>

            
                <div class="col-12 ">
                    <form action="/settings/providers/create" method="post">
                        @csrf
                        <div class="form-group">
                            {{-- <p>Use input <code>type="text"</code>.</p> --}}
                            <div class="row">
                                <div class="col-3">
                                    <p>Kode Game Provider</p>
                                    <label for="t-text" class="visually-hidden">Text</label>
                                    <input id="t-text" type="text" name="kodeprovider" placeholder="Kode Provider" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <p>Nama Game Provider</p>
                                    <label for="t-text" class="visually-hidden">Text</label>
                                    <input id="t-text" type="text" name="namaprovider" placeholder="Nama Provider" class="form-control" required>
                                </div>
                                <div class="col-12 mt-3">
                                    <p>Daftar Game <code>(jika brand game lebih dari satu, pisahkan dengan tanda koma ",")</code></p>
                                    <input id="t-text" type="text" name="game" placeholder="Daftar Game" class="form-control" >
                                </div>
                            </div>
                            <button type="submit" name="" class="mt-4 btn btn-primary">Tambah Provider</button>
                        </div>
                    </form>
                </div>                                        
            

            <div class="searchable-container list mt-5">
            <div class="col-xl-4 col-lg-5 col-md-5 col-sm-7 filtered-list-search layout-spacing align-self-center">
                <form class="form-inline my-2 my-lg-0">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" class="form-control product-search" id="input-search" placeholder="Search Agents...">
                    </div>
                </form>
            </div>

            <div class="col-6">
                <div class="row">
                        @foreach ($providers as $provider)
                        
                        <div class="items">
                            <div class="user-name">
                                <p class="">
                                    {{ $provider->kodeprovider }} 
                                </p>
                            </div>
                            <div class="user-name">
                                <p class="">
                                    {{ $provider->namaprovider }}
                                </p>
                            </div>
                            <div class="action-btns">
                                <a href="/settings/provider/{{ $provider->kodeprovider }}" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
            </div>
            </div>




        </div>
    </div>
</div>


@endsection