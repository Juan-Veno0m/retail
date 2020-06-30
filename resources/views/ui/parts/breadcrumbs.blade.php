<div class="container-fluid">
  <div class="row align-items-center">
    <div class="col-xl-3 align-self-end"><h2 class="title-breadcrumb">@yield('title')</h2></div>
    <div class="col-xl-9 align-self-end">
      <ol class="breadcrumb float-xl-right pb-0">
        <li class="breadcrumb-item">Inicio</li>
        <li class="breadcrumb-item" aria-current="page">@yield('title')</li>
        <li class="breadcrumb-item active" aria-current="page">{{$breadcrumb}}</li>
      </ol>
    </div>
  </div>
</div>
