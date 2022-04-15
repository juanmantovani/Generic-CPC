<script>
    $('.idcliente').select2(
	{
		placeholder: 'Seleccionar un Cliente',
		allowClear:true,
		lenguage: {
			noResults: function()
			{return "Sin resultados";}, 
			searching: function()
			{return "Buscando..";}
		},
		ajax: {
		url: '/select2-autocomplete-cliente',
		dataType: 'json',
		delay: 250,
		processResults: function (data) {
			return {
			results:  $.map(data, function (item) {
					return {
						text: item.nombre,
						id: item.id
					}
				})
			};
		},
		cache: true
		}
	});
</script>

<script>
function Elimina(NodoBoton){
    var TR= NodoBoton.parentNode.parentNode;
    const idRow = NodoBoton.parentElement.parentElement.id;
    const suma = $('#'+idRow+' span')[0].textContent;
    var total = parseInt(document.getElementById("total").value, 10) - suma;
    document.getElementById("total").value = total;
    document.getElementById("tablaProductos").removeChild(TR);
 }
</script>

<script>
    $('#codigo').keypress(function(e) {
    var keycode = (e.keyCode ? e.keyCode : e.which);
    if (keycode == '13') {
        var codigo=document.getElementById("codigo").value;
        
        var respuesta = productoIngresado(codigo);
        if(respuesta == 0){
            var cantidad=1
            $.ajax({ 
                url: "/obtenerInfoProducto",
                dataType: 'json',
                data : { codigo : codigo },
                success : function(json) {
                    if(json.length > 0){
                        var TR= document.createElement("tr")
                        TR.setAttribute("id", codigo);
                        var TD1=document.createElement("td")
                        var TD2=document.createElement("td")
                        TD2.setAttribute("id", "producto");
                        var TD3=document.createElement("td")
                        TD3.setAttribute("id", "precio");
                        var TD4= document.createElement("td")
                        TD4.setAttribute("id", "cantidad");
                        var TD5= document.createElement("td")
                        var TD6= document.createElement("td")

                        TD1.innerHTML=codigo;
                        TD4.innerHTML="<input value ='"+cantidad+"' min=1 type='number' onChange='onChange(this)' />";
                        TD2.innerHTML=json[0].nombre;
                        TD3.innerHTML="<input  step='any' value='"+json[0].precio+"' min=1 type='number' onChange='onChange(this)' />";
                        TD5.innerHTML="<span >"+json[0].precio*cantidad+"</span>";
                        TD6.innerHTML="<button class='btn btn-danger btn-xs' onclick='Elimina(this)' >Eliminar</button>"

                        TR.appendChild(TD1);
                        TR.appendChild(TD2);
                        TR.appendChild(TD3);
                        TR.appendChild(TD4);
                        TR.appendChild(TD5);
                        TR.appendChild(TD6);
            
                        document.getElementById("tablaProductos").appendChild(TR)
                        if(document.getElementById("total").value == ''){
                            document.getElementById("total").value = $('#'+codigo+' span').text();
                        }else{
                            document.getElementById("total").value = parseInt(document.getElementById("total").value,10) + parseInt($('#'+codigo+' span').text(),10);
                        }
                    }
                }, 
            });
        }  
        document.getElementById("codigo").value="";
        document.getElementById("codigo").focus();
        return false;
    
    }
});
</script>

<script>
    function onChange(event){
        var total = 0;
        const idRow = event.parentElement.parentElement.id;
        const precio = parseInt($('#'+idRow+' #precio input')[0].value,10);
        const cantidad = parseInt($('#'+idRow+' #cantidad input')[0].value,10)
        const suma =  precio*cantidad
        $('#'+idRow+' span')[0].innerHTML = suma;
        
        $('#tablaProductos tr').each(function() {
            if(this.id != '')
                total = total + parseInt($('#'+this.id+' span').text(),10);
        })
        document.getElementById("total").value = total;
    }
</script>

<script>
    function productoIngresado(codigo){
        if(codigo != ''){
            var respuesta = 0;
            $('#tablaProductos tr').each(function() {
                if(this.id == codigo){
                    cantidad = parseInt($('#'+codigo+' #cantidad input')[0].value,10) + 1;
                    $('#'+codigo+' #cantidad input')[0].value = cantidad;
                    onChange($('#'+codigo+' #cantidad input')[0])
                    respuesta = 1;
                }
            })
            return respuesta;
        }
    }
</script>

<script>
    function onConfirmar(coso){
        const idCliente = document.getElementById("idCliente").value;
        if(idCliente != ''){
            var codigo;
            $.ajax({ 
                url: "/obtenerInfoCliente",
                dataType: 'json',
                data : { idCliente : idCliente },
                success : function(json) {
                    $('#clienteNombre')[0].innerHTML= '<strong>Cliente: </strong>' + json[0].nombre;
                    $('#clienteRazonSocial')[0].innerHTML= '<strong>Razon Social: </strong>' + json[0].razon_social + ' - ' +json[0].cuil;
                    $('#clienteDireccion')[0].innerHTML= '<strong>Dirección: </strong>' + json[0].direccion +' - ' +  json[0].ciudad;
                    $('#idCli')[0].value = json[0].id;
                    codigo = json[0].id
                }});
                
                $('#fecha')[0].innerHTML = '<strong>Fecha: </strong>' + fecha();

                $('#totalPedido')[0].innerHTML = '<strong>Total: $</strong>' + document.getElementById("total").value;

            $('#tablaProductos tr').each(function() {
            if(this.id != ''){
                codigo = this.id;
                producto = $('#'+this.id+' #producto')[0].textContent;
                precio = parseInt($('#'+this.id+' #precio input')[0].value,10);
                cantidad = parseInt($('#'+this.id+' #cantidad input')[0].value,10);
                suma = parseInt($('#'+this.id+' span').text(),10);

                var TR= document.createElement("tr")
                TR.setAttribute("id", codigo);
                var TD1=document.createElement("td")
                var TD2=document.createElement("td")
                var TD3=document.createElement("td")
                var TD4= document.createElement("td")
                var TD5= document.createElement("td")
                var TD6= document.createElement("td")

                TD1.innerHTML=codigo;
                TD2.innerHTML=producto;
                TD3.innerHTML=precio;
                TD4.innerHTML=cantidad;
                TD5.innerHTML=suma;

                TR.appendChild(TD1);
                TR.appendChild(TD2);
                TR.appendChild(TD3);
                TR.appendChild(TD4);
                TR.appendChild(TD5);
                
                document.getElementById("tablaProductosConfirmar").appendChild(TR)
            }
        })
        return false;
    }
    }
</script>

<script>
    function fecha(){
        let date = new Date()

        let day = date.getDate()
        let month = date.getMonth() + 1
        let year = date.getFullYear()

        if(month < 10){
         return(`${day}-0${month}-${year}`)
        }else{
            return(`${day}-${month}-${year}`)
        }
    }
</script>
