<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Empresario No. {{$e->NoEmpresario}} | Pedido # {{$orden->OrdenID+9249582}}</title>
    <style>
      /**
        Set the margins of the page to 0, so the footer and the header
        can be of the full height and width !
        **/
        @page {
            size: 21.59cm 27.94cm;
            margin: 0cm 0cm;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 1.2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 1.2cm;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Lato', sans-serif;
            color: #555;
        }

      .invoice-box table {
          width: 100%;
          line-height: inherit;
          text-align: left;
      }

      .invoice-box table td {
          padding: 5px;
          vertical-align: top;
      }

      .invoice-box table tr td:nth-child(2) {
          text-align: left;
      }

      .invoice-box table tr.top table td {
          padding-bottom: 20px;
      }

      .invoice-box table tr.top table td.title {
          font-size: 45px;
          line-height: 45px;
          color: #333;
      }

      .invoice-box table tr.information table td {
          padding-bottom: 40px;
      }

      .invoice-box table tr.heading td {
          background: #57b39c;
          border-bottom: 1px solid #ddd;
          font-weight: bold;
          color:#fff;
          vertical-align : middle;
          text-align:center;
          font-size: 16px;
      }
      .invoice-box table tr.heading span{font-size: 14px;}
      .invoice-box table tr.item td{
          border-bottom: 1px solid #eee;
      }

      .invoice-box table tr.item.last td {
          border-bottom: none;
      }
      .summary td{font-size: 14px; text-align: center; line-height: 1.2em;}
      .summary .total td:nth-child(2), .summary .total td:nth-child(3){
          background: #57b39c;
          color:#fff;
          font-weight: bold;
          width: 100px;
          border: none;
      }.summary{padding-top:20px;}
      .productos .quantity{text-align: center;}
      .productos .heading td {text-align: center; background: #fff;}
      .productos .totalp{text-align: center;}
      .productos td{background:rgba(0,0,0,.05)}
      .productos td, .productos th {
        border: 1px solid #fff;
      }
      .productos td, .productos th {
        padding: .75rem;
        vertical-align: top;
        border-top: 2px solid #fff;
      }
      .productos th{font-size: 12px;} .productos td{font-size: 11px;}
      .productos .item td:nth-child(3){text-align: center;}
      @media only screen and (max-width: 600px) {
          .invoice-box table tr.top table td {
              width: 100%;
              display: block;
              text-align: center;
          }

          .invoice-box table tr.information table td {
              width: 100%;
              display: block;
              text-align: center;
          }
      }

      /** RTL **/
      .rtl {
          direction: rtl;
          font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      }

      .rtl table {
          text-align: left;
      }

      .rtl table tr td:nth-child(3) {
          text-align: center;
      }
      footer {
        position: fixed;
        bottom: 30px;
        left: 80px;
        right: 80px;
        height: 50px;
        font-size: 16px;
        /** Extra personal styles **/
        border-top: dashed 1px #57b39c;
        padding-top:25px;
        text-align: center;
        line-height: 1.4em;
      }
    </style>
</head>
<body>
  <?php
    $meses = [1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio",
    7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"];
  ?>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="https://www.yolkan.net/img/label-yolkan@74.png">
                            </td>
                            <td><?php $dateSale = date_parse($orden->created_at); ?>
                                <b>Pedido # {{$orden->OrdenID+9249582}}</b><br>
                                {{ $dateSale['day'] }} de {{ $meses[$dateSale['month']] }} del {{ $dateSale['year'] }} <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <b>Yolkan</b><br>
                                Puebla, Pue.<br>
                                Tel: 222-960-1999
                            </td>

                            <td style="text-align: right">
                                Empresario No. {{$e->NoEmpresario}}<br>
                                <b>{{$e->ApellidoPaterno.' '.$e->ApellidoMaterno.' '.$e->Nombre}}</b><br>
                                Télefono: {{$e->Telefono}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0">
            <!-- Factura -->
            <tr class="heading">
                <td rowspan="2">Factura</td>
                <td rowspan="2"><span>Metodo de pago</span> //<br> <span>{{$pago->Tipo}}</span></td>
                <td rowspan="2"><span>Total</span> //<br> ${{$pago->Total}}</td>
            </tr>
            <!-- -->
          </table>
          <table cellpadding="0" cellspacing="0" class="productos">
            <tr>
                <th style="text-align:left;">SKU</th>
                <th style="text-align:left;">Producto</th>
                <th>Precio /U</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
            @foreach ($items as $key => $v)
              <tr class="item">
                <td>{{$v->ProductosID+3303}}</td>
                <td>{{substr($v->ProductosNombre,0,20).' '.$v->Cantidad.' '.$v->Unidad}}</td>
                <td>${{$v->Precio_lista}}</td>
                <td class="quantity">{{$v->quantity}}</td>
                <td class="totalp">${{$v->Precio_lista*$v->quantity}}</td>
              </tr>
              @if($loop->last)
                <tr class="item last">
                  <td>{{$v->ProductosID+3303}}</td>
                  <td>{{$v->ProductosNombre.' '.$v->Cantidad.' '.$v->Unidad}}</td>
                  <td>${{$v->Precio_lista}}</td>
                  <td class="quantity">{{$v->quantity}}</td>
                  <td class="totalp">${{$v->Precio_lista*$v->quantity}}</td>
                </tr>
              @endif
            @endforeach
          </table>
          <table cellpadding="0" cellspacing="0" class="summary">
            <tr>
              <td></td>
              <td>Subtotal</td>
              <td>${{number_format ($pago->TotalProductos,2)}}</td>
            @if($pago->CuponDesc)
              <tr>
                <td></td>
                <td>Cupón</td>
                <td>- ${{number_format ($pago->CuponDesc,2)}}</td>
              </tr>
            @endif
            <tr>
              <td></td>
              <td>Descuentos ({{$pago->Porcentaje}}%)</td>
              <td>- ${{number_format ($pago->Descuento,2)}}</td>
            </tr>
            <tr class="total">
              <td></td>
              <td>Total</td>
              <td>${{number_format($pago->Total,2)}}</td>
            </tr>
        </table>
    </div>
    <footer>
        ¡Gracias por tu compra!<br>
        <small>www.yolkan.net</small>
    </footer>
</body>
</html>
