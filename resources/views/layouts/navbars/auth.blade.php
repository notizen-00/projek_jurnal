<div class="sidebar" data-color="black" data-active-color="info">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/logo-small.png">
            </div>
        </a>
        <a href="#" class="simple-text logo-normal">
            {{ __('FASTDERM') }}

        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="dropdown-widget">
                <a class=""
                    href="{{ route('page.index', 'dashboard') }}">
                    <i class="nc-icon nc-layout-11"></i>
                    <p class="d-none">{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-widget" href="{{ route('laporan.index') }}" data-toggle="tooltip" data-placement="right" title="Laporan">
                    <i class="nc-icon nc-book-bookmark"></i>
                    <p class="d-none">{{ __('Laporan') }}</p>
                </a>
            </li>

            <hr style="border-top:solid 1px white">
            <li class="nav-item">
                <a class="nav-widget" href="{{ route('kas.index') }}" data-toggle="tooltip" data-placement="right" title="Kas & Bank">
                    <i class="nc-icon nc-bank"></i>
                    <p class="d-none">{{ __('Kas & Bank') }}</p>
                  
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-widget" href="{{ route('penjualan.index') }}" data-toggle="tooltip" data-placement="right" title="Data Penjualan">
                    <i class="nc-icon nc-tag-content"></i>
                    <p class="d-none">{{ __('Penjualan') }}</p>
                </a>
               
            </li>
            <li class="nav-item">
                <a class="nav-widget" href="{{ route('pembelian.index') }}" data-toggle="tooltip" data-placement="right" title="Data Pembelian">
                    <i class="nc-icon nc-cart-simple"></i>
                    <p class="d-none">{{ __('Pembelian') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-widget" href="{{ route('pengeluaran.index') }}" data-toggle="tooltip" data-placement="right" title="Data Pengeluaran">
                    <i class="nc-icon nc-money-coins"></i>
                    <p class="d-none">{{ __('Biaya') }}</p>
                </a>
            </li>
            <hr style="border-top:solid 1px white">
            <li class="dropdown-widget ">
                <a class="nav-widget" href="#">
                    <i class="nc-icon nc-circle-10"></i>
                    <p class="d-none">{{ __('Kontak') }}</p>
                </a>
                <div class="dropdown-content-widget bg-light">
                    <div class="card rounded-right border border-dark" style="width: 40rem;">
                        <div class="card-body">
                            <h5 class="card-title">Menu Kontak </h5>
                            <hr>
                            <div class="card-columns" width="100%">
                                @foreach(\Theme_helper::get_submenu(6) as $i)
                                    <div class="card border border-success bg-lightsuccess">
                                        <div class="card-body text-center">
                                           <center> <img class="card-img-top" src="{{ $i->icon_submenu }}" style="max-width:40px"></center>
                                        </div>
                                        <div class="card-footer">
                                            <small>
                                            <a class="nav-widget card-link text-dark text-center"
                                                href="{{ url($i->url_submenu) }}">
                                                {{ $i->nama_submenu }}
                                            </a>
                                            </small>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown-widget">
                <a class="nav-widget" href="#">
                    <i class="nc-icon nc-box"></i>
                    <p class="d-none">{{ __('Produk') }}</p>
                </a>
                    <div class="dropdown-content-widget bg-light">
                        <div class="card rounded-right border border-dark" style="width: 40rem;">
                            <div class="card-body">
                                <h5 class="card-title">Menu Persediaan </h5>
                                <hr>
                                <div class="card-columns" width="100%">
                                    @foreach(\Theme_helper::get_submenu(2) as $i)
                                        <div class="card border border-success bg-lightsuccess">
                                            <div class="card-body text-center">
                                               <center> <img class="card-img-top" src="{{ $i->icon_submenu }}" style="max-width:40px"></center>
                                            </div>
                                            <div class="card-footer">
                                                <small>
                                                <a class="nav-widget card-link text-dark text-center"
                                                    href="{{ url($i->url_submenu) }}">
                                                    {{ $i->nama_submenu }}
                                                </a>
                                                </small>
                                            </div>
                                        </div>
                                    @endforeach
    
                                </div>
    
                            </div>
                        </div>
                    </div>
              
            </li>
            <li class="dropdown-widget">
                <a class="nav-widget" href="{{ route('account.index') }}">
                    <i class="nc-icon nc-badge"></i>
                    <p class="d-none">{{ __('Daftar Akun') }}</p>
                </a>
                <div class="dropdown-content-widget bg-light">
                    <div class="card rounded-right border border-dark" style="width: 40rem;">
                        <div class="card-body">
                            <h5 class="card-title">Menu Akun </h5>
                            <hr>
                            <div class="card-columns" width="100%">
                                @foreach(\Theme_helper::get_submenu(5) as $i)
                                    <div class="card border border-success bg-lightsuccess">
                                        <div class="card-body text-center">
                                           <center> <img class="card-img-top" src="{{ $i->icon_submenu }}" style="max-width:40px"></center>
                                        </div>
                                        <div class="card-footer">
                                            <small>
                                            <a class="nav-widget card-link text-dark text-center"
                                                href="{{ url($i->url_submenu) }}">
                                                {{ $i->nama_submenu }}
                                            </a>
                                            </small>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>

            </li>
            <hr style="border-top:solid 1px white">
            <li class="element ">
                <a class="nav-widget"
                    href="{{ route('page.index', 'dashboard') }}">
                    <i class="nc-icon nc-settings-gear-65"></i>
                    <p class="d-none">{{ __('Settings') }}</p>
                </a>
            </li>

            <li class="element">
                <a class="toggle-widget">
                    <i class="nc-icon nc-minimal-right"></i>
                </a>
            </li>
            <!-- <div class="d-flex justify-content-center">
                <i class="nc-icon nc-minimal-left minimal_btn" style="cursor:pointer;"></i>
            </div> -->
        </ul>
    </div>
</div>
