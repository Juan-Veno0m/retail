/* js */
 let modalform = $('#form-proveedores');let flag_agregar_proveedor = false; let trpadre;
 let path = $('.root').data('path'); let tblprov = $('#tabla-proveedores');
 //save button from form modal
 modalform.on('click', '.btn-primary', function(event) {
   event.preventDefault();
   /* Act on the event */
   if (flag_agregar_proveedor == false) {
     // flag
     flag_agregar_proveedor = true;
     // validated
     let btn = $(this);
     let content = btn.parents('.modal-content');
     let form = content.find('.form');
     form.addClass('was-validated');
     let error=0; let action = modalform.data('action'); let arraydata = {};
     $('#form-proveedores .array').map(function () {
       if ($(this).val()=="" && $(this).prop('required')) {error++;}
       else{ arraydata[$(this).attr("name")] = $(this).val();}
     }).get();
     if (error>0) {Swal.fire('Por favor, llene los campos requeridos'); flag_agregar_proveedor=false;}
     else {
       //
       if (action=='update') {arraydata['key'] = modalform.data('id');}
       // ajax
       btn.html('<i class="fas fa-circle-notch fa-spin"></i> Por favor espere...');
       $.ajax({
         url: path+'/productos/proveedores/'+action,
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         type: 'POST',
         dataType: 'json',
         data: {data:arraydata}
       })
       .done(function(data) {
         // complete
         flag_agregar_producto=false;
         if (data.tipo=='success' && action=='update') {
           trpadre.find('[name ="EmpresaNombre"]').html(arraydata['EmpresaNombre']);
           trpadre.find('[name ="Telefono"]').html(arraydata['Telefono']);
         }else if (data.tipo=='success' && action=='create') {
           setTimeout(function () {
            location.reload(true);
          }, 3000);
         }
         // Close model and show alert message
         modalform.modal('toggle');
         Swal.fire({
           title:data.mensaje,
           icon: data.tipo,
           timer: 1500,
           onDestroy: () => { }
         });
       })
       .fail(function() {
         console.log("error");
       })
       .always(function() {
         console.log("complete");
       });
     }
   }else{
     /*Agregando producto, por favor espere... */
     Swal.fire({
       title:"Agregando proveedor, por favor espere...",
       icon: "warning",
       timer: 1500,
       onDestroy: () => { }
     });
   }

 });
 /* proveedor item click */
 tblprov.on('click', 'a[name = "editar"]', function(event) {
   event.preventDefault();
   modalform.data('action','update'); CleanUp();
   trpadre = $(this).parents('tr')
   //$('body').css('overflow','hidden');
   //$('body').css('position','fixed');
   let key = trpadre.data('key'); modalform.data('id',key);
   /* before open modal load ajax info */
   // ajax
   $.ajax({
     url: path+'/productos/proveedores/read',
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     type: 'POST',
     dataType: 'json',
     data: {key: key}
   })
   .done(function(data) {
     modalform.find('[name ="EmpresaNombre"]').val(data.proveedores.EmpresaNombre);
     modalform.find('[name ="ContactoNombre"]').val(data.proveedores.ContactoNombre);
     modalform.find('[name ="ContactoTitulo"]').val(data.proveedores.ContactoTitulo);
     modalform.find('[name ="Direccion"]').val(data.proveedores.Direccion);
     modalform.find('[name ="Ciudad"]').val(data.proveedores.Ciudad);
     modalform.find('[name ="Region"]').val(data.proveedores.Region);
     modalform.find('[name ="CodigoPostal"]').val(data.proveedores.CodigoPostal);
     modalform.find('[name ="Pais"]').val(data.proveedores.Pais);
     modalform.find('[name ="Telefono"]').val(data.proveedores.Telefono);
     modalform.find('[name ="Web"]').val(data.proveedores.Web);
   })
   .fail(function() {
     console.log("error");
   })
   .always(function() {
     console.log("complete");
   });
   /* Act on the event */
   modalform.modal('toggle');
 });
 /* cleanup */
 function CleanUp(){$('#form-proveedores .array').map(function () { $(this).val('');});}
 /* agregar proveedor */
 $('a[name = "agregar-proveedores"]').click(function(event) {
   /* Act on the event */
   modalform.data('action','create');CleanUp();
 });
