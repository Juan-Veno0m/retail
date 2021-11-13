<?php
$medidaTicket = 180;

?>
<!DOCTYPE html>
<html>
<title>Ticket de Compra</title>
<head>
    <style>
        * {
            font-size: 12px;
            font-family: 'DejaVu Sans', serif;
        }

        h1 {
            font-size: 18px;
        }

        .ticket {
            margin: 2px;
        }
        tr,td, table{border-collapse: collapse; margin: 0 auto;}
        table > thead tr, th {border-top: 1px solid black;}
        table > tfoot tr, td { border:none;}
        table > tbody {border-bottom: 1px solid #000;}
        .heading{font-size: 12px;}
        .centrado {
            text-align: center;
            align-content: center;
        }
        .text-left{text-align: left;align-content: left;}
        .ticket {
            width: <?php echo $medidaTicket ?>px;
            max-width: <?php echo $medidaTicket ?>px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .ticket {
            margin: 0 5px;
            padding: 0;
        }

        body {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="ticket centrado">
        <h1>Yolkan</h1>
        <p>{{$venta->Tienda}}</p>
        <p>{{$venta->Direccion.' C.P. '.$venta->codigo_postal.' '.$venta->Ciudad.' ,' .$venta->estado}}</p>
        <p>Quejas y Sugerencias {{$venta->Telefono}}</p>
        <br>
        <table>
            <thead>
                <tr class="centrado">
                    <th class="heading">Cant</th>
                    <th class="heading">Articulo</th>
                    <th class="heading">Total</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($items as $key => $v)
                <tr>
                  <!-- Precio por kilo -->
                  @if ($v->PrecioBy == 1)
                    <?php $cantidad = $v->Cantidad.' g';
                      $precio =($v->Cantidad/1000) * $v->Precio; $pk = '$'.$v->Precio.' /kg';
                    ?>
                  @else <?php $cantidad = $v->Cantidad; $precio = $v->Cantidad * $v->Precio; $pk=''; ?>
                  @endif
                    <td class="text-left">{{$cantidad}}</td>
                    <td class="producto">{{substr($v->ProductosNombre,0,25).$pk}}</td>
                    <td class="ext-left">${{number_format($precio,2)}}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr><td colspan="3">&ensp;</td></tr>
              <tr>
                  <td class="text-left" colspan="2">Subtotal</td>
                  <td class="precio">
                      ${{number_format($venta->Total,2)}}
                  </td>
              </tr>
              <!-- descuento -->
              <tr>
                <td colspan="2" class="text-left">Descuento</td>
                <td>${{number_format($venta->Descuento,2)}}</td>
              </tr>
              <!-- pago -->
              <tr>
                <td colspan="2" class="text-left">Pago</td>
                <td>${{number_format($venta->Pago,2)}}</td>
              </tr>
              <!-- cambio -->
              <tr>
                <td colspan="2" class="text-left">Cambio</td>
                <td>${{number_format($venta->Cambio,2)}}</td>
              </tr>
              <!-- Metodo de pago -->
              <tr>
                <td colspan="2" class="text-left">Metodo de pago</td>
                <td>{{$venta->PaymentMethod}}</td>
              </tr>
            </tfoot>
        </table>
        <br>
        <h2>Ticket #{{$venta->No}}</h2>
        <p class="centrado">Le atendio: {{$venta->Usuario}} , Caja # {{$venta->Caja}}
        <p class="centrado">¡GRACIAS POR SU COMPRA!</p>
        <p>{{$venta->fecha_venta}}</p>
        <small>www.yolkan.net</small>
    </div>
</body>

</html>
