<style type="text/css">
input[type="radio"] + label  {
    display:inline-block;
    width:19px;
    height:19px;
    margin:-1px 4px 0 0;
    vertical-align:middle;
    cursor:pointer;
}
input[type="radio"]:checked + label  {}
</style>

<div class="modal fade pop-up-1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Añadir Ciudad</h4>
        </div>
        <div class="modal-body">
            <div class="col-sm-12">
              
              <div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" value="{{ isset($ciudad->nombre) ? $ciudad->nombre : '' }}" id="ciu-nombre" class="form-control" required placeholder="Nombre..">
				</div>
    </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" onclick="enviar_datos()" type="submit" data-dismiss="modal">Guardar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
         </div>
      </div>
    </div>
  </div>
