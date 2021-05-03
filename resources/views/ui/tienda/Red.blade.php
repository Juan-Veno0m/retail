@extends('master-ui')
@section('title', 'Mi Red de empresarios')
@section('description','Tienda en linea Yolkan')
@section('content')
  <style>
    .two > td > .caret:before {
      content: "\2192";
      color: black;
      display: inline-block;
      margin-right: 6px;
    }
    .three > td > .caret:before {
      content: "\2193";
      color: black;
      display: inline-block;
      margin-right: 6px;
      margin-left: 24px;
    }
  </style>
  <div class="container py-4">
    <div class="row px-3 justify-content-center">
      <div class="col-lg-7 px-0">
        <h1 class="custom-font">Mi Red de empresarios</h1>
      </div>
    </div>
  </div>
  <!-- table -->
  <div class="container pb-5">
    <div class="card mx-1 justify-content-center">
      <div class="card-body">
        @include('ui.parts.searchnet')
        <div class="row table-responsive">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">No.Empresario</th>
                <th scope="col">Nombre</th>
                <th scope="col">Puntos</th>
                <th scope="col">Detalles</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $arr = array(); $Id = $asociado->AsociadosID; $total = 0;
                foreach ($red as $item) {
                  $arr[]= array('id'=>$item->AsociadosID,'Asociado'=>$item->NoEmpresario,
                  'Nombre'=>$item->Nombre.' '.$item->ApellidoPaterno.' '.$item->ApellidoMaterno,'parent_id'=>$item->t1);
                  }
                /* function */
                function buildTree(array $elements, $parentId) {
                  $branch = array();
                  foreach ($elements as $element) {
                      if ($element['parent_id'] == $parentId) {
                          $children = buildTree($elements, $element['id']);
                          if ($children) {
                              $element['children'] = $children;
                          }
                          $branch[] = $element;
                      }
                  }

                  return $branch;
                }
                $tree = buildTree($arr,$Id);
              ?>
              <!-- Root Element -->
              <tr class="table-success">
                <td>{{$asociado->NoEmpresario}}</td>
                <td>{{$asociado->Nombre.' '.$asociado->ApellidoPaterno.' '.$asociado->ApellidoMaterno}}</td>
                <td>
                  @if (count($consumo))
                    <?php $flag=0; ?>
                    @foreach ($consumo as $key => $c)
                      @if ($c->AsociadosID == $asociado->AsociadosID)
                        {{$c->Puntos}} <?php $total+=$c->Puntos; $flag=1;?>
                      @endif
                    @endforeach
                    @if ($flag==0) 0 @endif
                  @else
                    No disponible
                  @endif
                </td>
                <td><button type="button" class="btn btn-light"><i class="fas fa-eye"></i></button></td>
              </tr>
              <!-- end -->
              @foreach ($tree as $item)
                <tr>
                  <td>{{$item['Asociado']}}</td>
                  <td>{{$item['Nombre']}}</td>
                  <td>
                    @if (count($consumo))
                      <?php $flag=0; ?>
                      @foreach ($consumo as $key => $c)
                        @if ($c->AsociadosID == $item['id'])
                          {{$c->Puntos}} <?php $total+=$c->Puntos; $flag=1;?>
                        @endif
                      @endforeach
                      @if ($flag==0) 0 @endif
                    @else
                      No disponible
                    @endif
                  </td>
                  <td><button type="button" class="btn btn-light"><i class="fas fa-eye"></i></button></td>
                  @if (isset($item['children']))
                    @foreach ($item['children'] as $two)
                      <tr class="two">
                        <td><span class="caret"></span>{{$two['Asociado']}}</td>
                        <td>{{$two['Nombre']}}</td>
                        <td>
                          @if (count($consumo))
                            <?php $flag=0; ?>
                            @foreach ($consumo as $key => $c)
                              @if ($c->AsociadosID == $two['id'])
                                {{$c->Puntos}} <?php $total+=$c->Puntos; $flag=1;?>
                              @endif
                            @endforeach
                            @if ($flag==0) 0 @endif
                          @else
                            No disponible
                          @endif
                        </td>
                        <td><button type="button" class="btn btn-light"><i class="fas fa-eye"></i></button></td>
                        @if (isset($two['children']))
                          @foreach ($two['children'] as $three)
                            <tr class="three">
                              <td><span class="caret"></span>{{$three['Asociado']}}</td>
                              <td>{{$three['Nombre']}}</td>
                              <td>
                                @if (count($consumo))
                                  <?php $flag=0; ?>
                                  @foreach ($consumo as $key => $c)
                                    @if ($c->AsociadosID == $three['id'])
                                      {{$c->Puntos}} <?php $total+=$c->Puntos; $flag=1;?>
                                    @endif
                                  @endforeach
                                  @if ($flag==0) 0 @endif
                                @else
                                  No disponible
                                @endif
                              </td>
                              <td><button type="button" class="btn btn-light"><i class="fas fa-eye"></i></button></td>
                            </tr>
                          @endforeach
                        @endif
                      </tr>
                    @endforeach
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        <a href="{{url('Cuenta')}}" class="btn btn-warning" name="back"><< Regresar</a>
        <button class="btn btn-link float-right">Total de Puntos: {{$total}}</button>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
@endsection
