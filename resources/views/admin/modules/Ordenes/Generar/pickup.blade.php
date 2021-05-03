<div class="collapse" id="PickupGrid">
  <small class="text-muted">Confirma la dirección de la tienda</small>
  <div class="row">
    <div class="col-12 mb-3">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" data-type="2" id="pickup">
        <label class="form-check-label" for="pickup">
          <span class="d-block" name="Fullname">Yolkan Puebla</span>
          <span class="d-block" name="address">Privada 37 Sur No.2115, Belisario Dominguez</span>
          <span class="d-block" name="city">CP: 72180 ,Puebla, Puebla.</span>
        </label>
      </div>
    </div>
    <div class="col-12">
      <div class="container-fluid">
        <div class="row">
          <div class="table-responsive">
            <table class="table table-sm w-auto" id="calendar">
              <thead class="thead-dark">
                <tr>
                  <th style="min-width: 80px;width: 80px;"></th>
                  <?php
                    $days = array('Dom', 'Lun', 'Mar', 'Mie','Jue','vie', 'Sab');
                    $date = date('d-m-Y');
                  ?>
                  @for ($i=1; $i <= 7; $i++)
                    <?php $current = date('Y-m-d', strtotime($date. ' + '.$i.' days')); ?>
                    <th data-date="{{$current}}">
                      <span class="day">{{date('d',strtotime($current))}}</span>
                      <span class="short">{{$days[date('w',strtotime($current))]}}</span>
                    </th>
                  @endfor
                </tr>
              </thead>
              <tbody>
                @for ($x=10; $x < 18; $x++)
                  <tr data-hour="{{$x}}">
                    <td class="hour" rowspan="4"><span>{{$x}}:00</span></td>
                    @for ($i=1; $i <= 7; $i++)
                      <?php $current = date('Y-m-d', strtotime($date. ' + '.$i.' days')); $week = date('w',strtotime($current)); ?>
                      @if ($week == 0 || $week == 6)<?php $class="disabled";?> @else <?php $class="item";?>@endif
                        <td class="{{$class}}" data-date="{{$current}}"></td>
                    @endfor
                  </tr>
                @endfor
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
