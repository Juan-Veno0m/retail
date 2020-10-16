<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Image;
use DB;
use PDF;

class InventariosController extends Controller
{

    public function index(Request $request)
    {
        // Filter
        $q = $request->input('q');
        $c = $request->input('categoria');
        $p = $request->input('proveedor');
        // productos
        $productos = DB::table('productos as p')
          ->join('categorias as c','p.CategoriaID','=','c.CategoriaID')
          ->join('proveedores as prov','p.ProveedorID','=','prov.ProveedorID')
          ->where('p.ProductosNombre','LIKE','%'.$q.'%') // Filtro Nombre
          ->where('p.CategoriaID','LIKE','%'.$c.'%') // Filtro Categoria
          ->where('p.ProveedorID','LIKE','%'.$p.'%') // Filtro Proveedor
          ->wherenull('p.deleted_at')
          ->select('p.ProductosID','p.ProductosID as uk','p.ProductosNombre','p.CategoriaID','c.CategoriaNombre','p.ProveedorID','p.PrecioUnitario','p.UnidadesEnStock',
          'p.Cantidad','p.Unidad','p.Descontinuado','p.UnidadesEnviadas','p.UnidadesRecibidas','p.updated_at')
          ->orderBy('p.updated_at','desc')
          ->paginate(15);
        foreach ($productos as $key => $value) {$value->ProductosID = encrypt($value->ProductosID);}
        // compras
        $compras = DB::table('compras as c')
          ->join('proveedores as prov','c.ProveedorID','=','prov.ProveedorID')
          ->join('compras_status as s','s.id','=','c.Compra_Status')
          ->leftJoin('compras_envio as e','e.ComprasID','=','c.ComprasID')
          ->select('c.ComprasID','c.ComprasID as key','c.FechaCompra','s.status','c.Total','prov.EmpresaNombre','s.attribute','e.id as EnvioID','e.TipoEnvio','c.Compra_Status')
          ->paginate(15);
        foreach ($compras as $key => $value) {$value->key = encrypt($value->key);}
        // Proveedores
        $proveedores = DB::table('proveedores')->get();
        // data array
        $data = ['proveedores'=>$proveedores,'q'=>$q,'c'=>$c,'p'=>$p,'compras'=>$compras,'productos'=>$productos];
        return view('admin.modules.Inventarios.index', $data);
    }
    // create
    public function generar(Request $req)
    {
      // Proveedores
      $proveedores = DB::table('proveedores')->get();
      // paqueteria
      $paqueteria = DB::table('paqueteria')->get();
      // data array
      $data = ['proveedores'=>$proveedores,'paqueteria'=>$paqueteria];
      return view('admin.modules.Inventarios.Compras', $data);
    }
    // get productos list
    public function productos(Request $req)
    {
      $productos = DB::table('productos')->where('ProveedorID',$req->id)->get();
      return response()->json(['tipo' => 'ok', 'productos'=>$productos]);
    }
    // cargar compra
    public function create(Request $req)
    {
      // compra
      $ComprasID = DB::table('compras')->insertGetId(['ProveedorID'=>$req->arraydata['proveedor'],'FechaCompra'=>$req->arraydata['fecha'],
      'Total'=>$req->arraydata['Total'],'Autoriza'=>Auth::id(),'created_at'=>now()]);
      // pago
      $PagoID = DB::table('compras_pago')->insertGetId(['ComprasID'=>$ComprasID,'Monto'=>$req->arraydata['Total']]);
      // envio
      $envio = DB::table('compras_envio')->insertGetId(['ComprasID'=>$ComprasID,'TipoEnvio'=>$req->arraydata['TipoEnvio'],'Costo'=>$req->arraydata['Costo']]);
      // paqueteria
      if ($req->arraydata['TipoEnvio']!= 1) {
        // code...
        $paqueteria = DB::table('compras_paqueteria')->insertGetId(['ComprasEnvioID'=>$envio,'PaqueteriaID'=>$req->arraydata['Paqueteria'],
        'rastreo'=>$req->arraydata['Rastreo']]);
      }
      // items
      for ($i=1; $i <= $req->keys ; $i++) {
        $items[] = DB::table('compras_items')->insertGetId(['ComprasID'=>$ComprasID,'ProductosID'=>$req->items[$i]['id'],'Cantidad'=>$req->items[$i]['cantidad'],
        'CostoUnitario'=>$req->items[$i]['costo']]);
        // add inventory records
        //DB::table('productos')->where('ProductosID',$req->items[$i]['id'])->update(['UnidadesEnStock'=>$req->items[$i]['stock'],'UnidadesRecibidas'=>$req->items[$i]['recibido'],'updated_at'=>now()]);
      }
      return response()->json(['tipo' => 200]);
    }
    // cargar pagos
    public function historialpagos(Request $req)
    {
      // decrypt
      try {
          $id = decrypt($req->Orden);
      } catch (DecryptException $e) {
          //
          return response()->json(['tipo' => 'error', 'mensaje' => $e]);
      }
      $pagos = DB::table('compras_pago')->where('ComprasID',$id)->get();
      return response()->json(['tipo' => 'ok', 'pagos'=>$pagos]);
    }
    // acciones de pago
    public function actionpagos(Request $req)
    {
      if ($req->ajax()) {
        // code...
        $datos = json_decode($req->datos);
        // decrypt
        try {
            $ComprasID  = decrypt($datos->OrdenID);
        } catch (DecryptException $e) {
            //
            return response()->json(['tipo' => 'error', 'mensaje' => $e]);
        }
        $file = $req->file('file'); $img = Image::make($file);
        $path = '/Compras/Orden-'.($ComprasID+24500).'/';
        $tag = $path.'PagosProveedor/';
        $input['imagename'] = time().'.'.$file->getClientOriginalExtension();
        $img->resize(750, null, function ($constraint) {$constraint->aspectRatio();})->encode();
        $image = Storage::disk('upfiles')->put($tag.$input['imagename'], $img); // Save
        // action create
        if ($datos->action=='create') {
          // code...
          $id = DB::table('compras_pago')->insertGetId(['FechaPago'=>$datos->fecha,'Monto'=>$datos->monto,'comentarioPago'=>$datos->comentarios,
          'ComprasID'=>$ComprasID,'formaPagoP'=>$datos->formaPagoP,'Folio'=>$datos->folio,'imagenPay'=>$tag.$input['imagename'],'created_at'=>now()]);
          if ($datos->saldo=="0.00") {
            // code...
            DB::table('compras')->where('ComprasID',$ComprasID)->update(['Compra_Status'=>2,'updated_at'=>now()]);
            // confirmar aquí, agregar puntos de la compra al acumulado del empresario con fecha de ultimo pago
            return response()->json(['tipo'=>200,'mensaje'=>'saldo','estatus'=>'btn-primary']);
          }else{return response()->json(['tipo'=>200,'mensaje'=>'ok']);}
        }elseif ($datos->action=='update') {
          // code...
        }
      }else{abort(404);}
    }
    // detalles de la orden
    public function details(Request $req)
    {
      // decrypt
      try {
          $id = decrypt($req->Orden);
      } catch (DecryptException $e) {
          //
          return response()->json(['tipo' => 'error', 'mensaje' => $e]);
      }
      $items = DB::table('compras_items as c')
                  ->join('productos as p','p.ProductosID','=','c.ProductosID')
                  ->where('ComprasID',$id)
                  ->select('c.*','p.ProductosNombre')
                  ->get();
      return response()->json(['tipo' => 'ok', 'items'=>$items]);
    }
    // cambio status
    public function comentarios(Request $req)
    {
      // decrypt
      try {
          $id = decrypt($req->key);
      } catch (DecryptException $e) {
          //
          return response()->json(['tipo' => 'error', 'mensaje' => $e]);
      }
      $pagado = DB::table('compras_pago')->where('ComprasID',$id)->sum('Monto');
      $debe = DB::table('compras')->where('ComprasID',$id)->sum('Total');
      /* permitir cambio /confirmar/ si no hay saldo pendiente - cancelar*/
      if (floatval($pagado) == floatval($debe) || $req->newstat == 4) {
        // code...
        $comment = DB::table('compras_comentarios')->insertGetId(['ComprasID'=>$id,'UserID'=>Auth::id(),
        'oldstat'=>$req->oldstat,'newstat'=>$req->newstat,'aplicado'=>$req->fecha_hora,'comentario'=>$req->comment,'created_at'=>now()]);
        if (isset($comment)) {
          // code...
          if ($req->newstat == 3) { // cuando la compra sea confirmada como recibida
            $items = DB::table('compras_items')->where('ComprasID',$id)->get();
            // add inventory records
            foreach ($items as $key => $v) {
              // current
              $c = DB::table('productos as p')->where('p.ProductosID',$v->ProductosID)->select('p.UnidadesEnStock','p.UnidadesRecibidas')->first();
              // code ..
              DB::table('productos')->where('ProductosID',$v->ProductosID)
              ->update(['UnidadesEnStock'=>$v->Cantidad+$c->UnidadesEnStock,'UnidadesRecibidas'=>$v->Cantidad+$c->UnidadesRecibidas,'updated_at'=>now()]);
            }
          }
          DB::table('compras')->where('ComprasID',$id)->update(['Compra_Status'=>$req->newstat,'updated_at'=>now()]);
          $status = DB::table('compras_status')->where('id',$req->newstat)->first();
          return response()->json(['tipo'=>200,'mensaje'=>'ok','status'=>$status]);
        }else{
          return response()->json(['tipo'=>500,'mensaje'=>'Error al guardar cambios']);
        }
      }else{return response()->json(['tipo'=>501,'mensaje'=>'Pago pendiente del pedido.']);}
    }
    // orden pdf compra
    public function orden($NOrden)
    {
      $id = $NOrden - 24500;
      $compras = DB::table('compras as c')
              ->join('proveedores as p','p.ProveedorID','c.ProveedorID')
              ->join('compras_status as s','s.id','c.Compra_Status')
              ->select('c.Total','c.FechaCompra','s.status','p.EmpresaNombre','p.Telefono')
              ->where('ComprasID',$id)->first();
      $items = DB::table('compras_items as c')
              ->join('productos as p','p.ProductosID','c.ProductosID')
              ->where('c.ComprasID',$id)
              ->select('c.Cantidad as quantity','c.CostoUnitario','p.ProductosNombre','p.ProductosID','p.Cantidad','p.Unidad')->get();
      $label = preg_replace('/\s+/', '_', $compras->EmpresaNombre);
      // share data to view
      $view = \View::make('admin.modules.Inventarios.OrdenPDF',compact('NOrden','compras','label','items'))->render();
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream('OrdenNo.'.$NOrden.'-'.$label.'.pdf');
    }
    // action envios
    public function actionenvios(Request $req)
    {
      if ($req->ajax()) {
        // decrypt
        try {
            $id = decrypt($req->key);
        } catch (DecryptException $e) {
            //
            return response()->json(['tipo' => 'error', 'mensaje' => $e]);
        }
        if ($req->action=='read') {
          // code...
          $envio = DB::table('compras_envio')->where('ComprasID',$id)->first();
          $paqueteria = DB::table('compras_paqueteria')->where('ComprasEnvioID',$envio->id)->first();
          return response()->json(['tipo' => 200,'envio'=>$envio,'paqueteria'=>$paqueteria]);
        }elseif ($req->action=='update') {
          // code...
          DB::table('compras_envio')->where('ComprasID',$id)->update(['TipoEnvio'=>$req->data['tipoenvio'],'Costo'=>$req->data['costoenvio'],
          'FechaRecibido'=>$req->data['fecharecibido'],'updated_at'=>now()]);
          if ($req->ComprasEnvioID==0) {
            // create...
            $pid = DB::table('compras_paqueteria')->insertGetId(['ComprasEnvioID'=>$req->ComprasEnvioID,'PaqueteriaID'=>$req->data['Paqueteria'],'rastreo'=>$req->data['codigorastreo']]);
            return response()->json(['tipo' => 201,'pid'=>$pid]);
          }else{
            //update
            DB::table('compras_paqueteria')->where('ComprasEnvioID',$req->ComprasEnvioID)->update(['PaqueteriaID'=>$req->data['Paqueteria'],'rastreo'=>$req->data['codigorastreo']]);
            return response()->json(['tipo' => 202, 'mensaje'=>'Actualizado']);
          }

        }
      }
      else{abort(404);}
    }
}
