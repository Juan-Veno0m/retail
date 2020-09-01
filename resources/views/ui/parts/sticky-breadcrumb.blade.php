<div class="sticked-breadcrumb">
  <div class="row">
    <ol class="breadcrumb pb-0 pl-0 bg-transparent">
      <li class="breadcrumb-item"><a href="{{ url()->previous() }}"><i class="fas fa-chevron-left"></i> regresar</a></li>
      <li class="breadcrumb-item"><a href="{{url('/tienda')}}">Tienda</a></li>
      <li class="breadcrumb-item"><a href="{{url('/'.str_replace(' ', '-', $producto->CategoriaNombre).'/node'.$producto->CategoriaID)}}">{{$producto->CategoriaNombre}}</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$producto->ProductosNombre.' '.$producto->Cantidad.' '.$producto->Unidad}}</li>
    </ol>
  </div>
</div>
