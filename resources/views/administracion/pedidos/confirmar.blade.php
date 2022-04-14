<div class="modal fade" id="confirmar_pedido" role="dialog" align="center">
  <div class="modal-dialog modal-lg">
   <div class="modal-content">           
      <div class="modal-body">
       <div class="row">
         <div class="col-md-12">
         <div>
             <div class=row>
                 <input type="text" id="idCli"class="hidden">
                <span id="clienteNombre" class="col-md-6"></span>
                <span id="clienteRazonSocial" class="col-md-6"></span>
                <span id="clienteDireccion" class="col-md-12"></span>
             </div>
             <div class=row>
             <span id="fecha" class="col-md-6"></span>
             <span id="totalPedido" class="col-md-6"></span>

            </div>
        <table class="table table-striped table-bordered" id="tablaProductosConfirmar">
            <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Suma</th>
            </tr>
        </table>
    </div>     
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-primary" onClick="onSubmit()">Confirmar</button>
        </div>
      </div>
    </div>
</div>
</div>
</div>


<script>
 function onSubmit(){
    const idCliente = $('#idCli')[0].value;
    var regex = /(\d+)/g;
    const total = $('#totalPedido')[0].textContent.match(regex)[0];
    var filas = [];
    $('#tablaProductosConfirmar tr').each(function () {
      if(this.id != '' ){
        var codigo = $(this).find('td').eq(0).text();
        var producto = $(this).find('td').eq(1).text();
        var precio = $(this).find('td').eq(2).text();
        var cantidad = $(this).find('td').eq(3).text();
        var suma = $(this).find('td').eq(4).text();

        var fila = {
        codigo,
        producto,
        precio,
        cantidad,
        suma
      };
      filas.push(fila);
      }
 });
 var token = '{{ csrf_token() }}';
 console.log(idCliente, filas, total)
 $.ajax({
    type:"POST",
    url: "/registrarPedido",
    dataType: 'JSON',
    data : { 
      "idCliente" : idCliente,
      "filas" : filas,
      "total": total,
      "_token":token
    }});
 }
</script>