<style type="text/css">
input[type="radio"] + label  {
    display:inline-block;
    width:19px;
    height:19px;
    margin:-1px 4px 0 0;
    vertical-align:middle;
    cursor:pointer;
}
input[type="radio"]:checked + label  {

}
</style>

				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" value="{{ isset($categoria->nombre) ? $categoria->nombre : '' }}" id="cat-nombre" class="form-control" required placeholder="Nombre..">
				</div>
				<div class="form-group">
					<label for="descripcion">Descripcion</label>
					<input type="text" name="descripcion" value="{{ isset($categoria->descripcion) ? $categoria->descripcion : '' }}" id="cat-descripcion" class="form-control" placeholder="Descripcion..">
				</div>
