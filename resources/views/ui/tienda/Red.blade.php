@extends('master-ui')
@section('title', 'Mi Red de empresarios')
@section('description','Tienda en linea Yolkan')
@section('content')
  <div class="container py-4">
    <div class="row px-3 justify-content-center">
      <div class="col-lg-7 px-0">
        <h1 class="custom-font">Mi Red de empresarios</h1>
      </div>
    </div>
  </div>
  <!-- table -->
  <div class="container pb-5">
    <div class="card card row mx-1 justify-content-center">
      <div class="card-body">
        @include('ui.parts.searchnet')
        <div class="row table-responsive">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">No.Empresario</th>
                <th scope="col">Nombre</th>
                <th scope="col">Nivel</th>
                <th scope="col">Consumo mensual</th>
                <th scope="col">Detalles</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($red as $key => $l)
                <tr data-id="{{$l->AsociadosID}}">
                  <th scope="row">{{$l->NoEmpresario}}</th>
                  <td>{{$l->ApellidoPaterno.' '.$l->ApellidoMaterno.' '.$l->Nombre}}</td>
                  <td>
                    @if ($l->t1 == $asociado->AsociadosID)
                      <span class="badge badge-primary">Nivel 1</span></td>
                    @elseif ($l->t2 == $asociado->AsociadosID)
                      <span class="badge badge-success">Nivel 2</span></td>
                    @elseif ($l->t3 == $asociado->AsociadosID)
                      <span class="badge badge-secondary">Nivel 3</span></td>
                    @endif
                  <td>
                    @if (count($consumo))
                      <?php $flag=0; ?>
                      @foreach ($consumo as $key => $c)
                        @if ($c->AsociadosID == $l->AsociadosID)
                          ${{number_format($c->Puntos*10,2)}} <?php $flag=1;?>
                        @endif
                      @endforeach
                      @if ($flag==0) $0.00 @endif
                    @else
                      No disponible
                    @endif
                  </td>
                  <td><button type="button" class="btn btn-light"><i class="fas fa-eye"></i></button></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {{$red->links()}}
      </div>
      <div class="card-footer"><a href="{{url('Cuenta')}}" class="btn btn-warning" name="back"><< Regresar</a></div>
    </div>
  </div>
@endsection
@section('scripts')
@endsection
