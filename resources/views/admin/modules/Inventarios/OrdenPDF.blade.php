<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orden No. {{$NOrden}} | {{$compras->EmpresaNombre}}</title>
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
      .productos tfoot tr td {background: #fff;border-bottom: solid 2px #57b39c;}
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
                            <td style="text-align: right; padding-top:20px;"><?php $dateSale = date_parse($compras->FechaCompra); ?>
                                <b>Orden No. {{$NOrden}}</b><br>
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
                                Proveedor <br>
                                <b>{{$compras->EmpresaNombre}}</b><br>
                                Tel: {{$compras->Telefono}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0">
            <tr class="heading">
                <td rowspan="2" colspan="3">Pedido</td>
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
            <?php $sub = 0; ?>
            @foreach ($items as $key => $v)
              <tr class="item">
                <td>{{$v->ProductosID+3303}}</td>
                <td>{{substr($v->ProductosNombre,0,20).' '.$v->Cantidad.' '.$v->Unidad}}</td>
                <td>${{$v->CostoUnitario}}</td>
                <td class="quantity">{{$v->quantity}}</td>
                <td class="totalp">${{number_format($v->CostoUnitario*$v->quantity,2)}}</td> <?php $sub= $v->CostoUnitario*$v->quantity + $sub; ?>
              </tr>
            @endforeach
            <tfoot>
              <tr>
                <td>Total de Productos: ({{count($items)}})</td>
              </tr>
            </tfoot>
          </table>
          <table cellpadding="0" cellspacing="0" class="summary">
            <tr>
              <td></td>
              <td>Subtotal</td>
              <td>${{number_format($sub,2)}}</td>
            <tr>
              <td></td>
              <td>Envío</td>
              <?php $envio='N.A'; if ($compras_envio->Costo!==null) {$envio = '$'.number_format($compras_envio->Costo,2);} ?>
              <td>{{$envio}}</td>
            </tr>
            <tr class="total">
              <td></td>
              <td>Total</td>
              <td>${{number_format($compras->Total,2)}}</td>
            </tr>
        </table>
    </div>
    <footer>
        <b>www.yolkan.net</b>
    </footer>
</body>
</html>
