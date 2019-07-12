  <div class="modal fade pop-up-1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Añadir Categoria</h4>
        </div>
        <div class="modal-body">
            <div class="col-sm-12">
              <div class="form-group">

                 @include('administracion.almacen.categorias.form.formulario-categoria')
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" onclick="enviar_datos()" type="submit" data-dismiss="modal">Guardar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
    </div>
  </div>
