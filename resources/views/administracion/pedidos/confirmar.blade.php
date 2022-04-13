<div class="modal fade" id="confirmar_pedido" role="dialog" align="center">
  <div class="modal-dialog">
   <div class="modal-content">           
   {!!Form::open(array('action'=>'PedidoController@store','method'=>'POST','autocomplete'=>'off','files'=>'true', 'id' => 'formId'))!!}
    {{Form::token()}}
      <div class="modal-body">
       <div class="row">
         <div class="col-md-12">
         <div>
             <div class=row>
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
          <button type="submit" class="btn btn-primary">Confirmar</button>
        </div>
      </div>
    </div>
    {!!Form::close()!!}               
</div>
</div>
</div>