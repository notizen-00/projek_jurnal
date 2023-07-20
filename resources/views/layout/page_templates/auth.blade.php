@include('layout.navbars.navs.auth')


@include('layout.sidebar')

<div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="1000">
    <div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">
      <div class="nav-item dropdown">
        <a class="nav-link bg-danger dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Close</a>
        <div class="dropdown-menu mt-0">
          <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all">Close All</a>
          <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all-other">Close All Other</a>
        </div>
      </div>
      <a class="nav-link bg-light" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a>
      {{-- <ul class="navbar-nav overflow-hidden" role="tablist"></ul> --}}
      <ul class="navbar-nav" role="tablist">
        <li class="nav-item active" role="presentation"><a class="nav-link active" data-toggle="row" id="tab-index" href="#panel-index" role="tab" aria-controls="panel-index" aria-selected="true">Dashboard   </a></li>
      </ul>
      <a class="nav-link bg-light" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a>
      <a class="nav-link bg-light" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="panel-index" role="tabpanel" aria-labelledby="tab-index"><iframe src="{{ url('dashboard') }}" style="height: 671px;"></iframe></div>
      <div class="tab-empty">
        <h2 class="display-4">No tab selected!</h2>
      </div>
      <div class="tab-loading">
        <div>
          <h2 class="display-4"><center><i class="fa fa-sync fa-spin"></i> </center><br> Mohon Tunggu ... </h2>

        </div>
      </div>
    </div>
  </div>
  
@include('layout.footer')
