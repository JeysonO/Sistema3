
<!-- Content Header (Page header) -->
<?php 
require_once 'controller/universidad.controller.php';


 ?>
<section class="content-header">  
	<h1>
		Modulo Administracion
	</h1>
	<ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="index.php?c=Origen">Origen de Información</a></li>
            <li class="active">Registrar</li>
          </ol>
</section>

<section class="content">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-md-offset-2">
	  		<div class="box">
	    		<div class='box-header with-border'>
	      			<h3 class='box-title'><i class="fa fa-briefcase"></i> Registrar Universidad</h3>
	    		</div>
	    		<div class="box-body">
	    			<form id="frmRegistrarUniversidad"  action="?c=Universidad&a=Registrar" method="post" enctype="multipart/form-data" role="form">	   				

					    <div class="form-group col-md-8 formulario__grupo formulario__grupo-correcto" id="grupo__primer_nombre" >
					        <label for="nombre" class="formulario__label">Nombre de la Universidad</label>
					        	<div class="formulario__grupo-input">
					        		<input type="text" id="nombre" name="nombre" value="" class="form-control  formulario__input" placeholder=""  required />
					        	</div> 	
					    </div>
					    <div class="form-group col-md-4">
					        <label for="codigo" class="formulario__label">Codigo</label>
					        <input type="text" id="codigo" name="codigo" value="" class="form-control formulario__input" placeholder=""  required />
					    </div>
						<div class="form-group col-md-4">
					        <label for="direccion" class="formulario__label">Direccion</label>
					        <input type="text" id="direccion" name="direccion" value="" class="form-control formulario__input" placeholder=""  required />
					    </div>
						<div class="form-group col-md-4">
					        <label for="licenciado" class="formulario__label">Licenciado</label>
					        <input type="text" id="licenciado" name="licenciado" value="" class="form-control formulario__input" placeholder=""  required />
					    </div>
						<div class="form-group col-md-4">
					        <label for="cantidad_carreras" class="formulario__label">Cantidad de carreras</label>
					        <input type="text" id="cantidad_carreras" name="cantidad_carreras" value="" class="form-control formulario__input" placeholder=""  required />
					    </div>			   
					  	<div class="col-md-12" style="margin-top:2em;">
					  		<div class="col-md-6 col-sm-12">
					        <button type="button" id="btnSubmit" class="btn btn-primary col-md-12 col-xs-12" disable><i class="fa fa-save"></i> Registrar</button>    		      
					    </div>
					     <div class="col-md-6 col-sm-12">					    
					        <a href="index.php?c=Universidad" class="btn btn-danger col-md-12 col-xs-12 "><i class="fa fa-times-circle"></i> Cancelar</a>
					    </div>  
					  </div>
					</form> 
                </div>      
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->


<!----POR EDITAR---->
<script>
          
	$(document).ready(function() {
		$("#btnSubmit").click(function(event) {
			bootbox.dialog({
	            message: "¿Estas seguro de Registrar?",
	            title: "Registrar Curso",
	            buttons: {
	                main: {
	                    label: "Registrar",
	                    className: "btn-primary",
	                    callback: function() {
	                        //console.log('Eliminado al usuario');
	                        
	                              $( "#frmRegistrarUniversidad" ).submit();
	                    }
	                },
	                danger: {
	                    label: "Cancelar",
	                    className: "btn-danger",
	                    callback: function() {
	                        bootbox.hideAll();
	                    }
	                }
	            }
        	}); 
		});

		$("#nombre").focusout(function() {
			$(this).val(PrimeraLetraMayuscula($(this).val()))
  		});
  		$("#direccion").focusout(function() {
  			$(this).val(PrimeraLetraMayuscula($(this).val()))
  		});

		$("#licenciado").focusout(function() {
			$(this).val(PrimeraLetraMayuscula($(this).val()))
  		});

		$( "#Area_id" ).change(function ()
 		{
			Area_id = $("#Area_id").val();
			//alert(Area_id);

			ListarCargoxArea_id(Area_id)

		});

	});

	function PrimeraLetraMayuscula(string){
		var capitalize=string.toLowerCase();
  		return capitalize.charAt(0).toUpperCase() + capitalize.slice(1);
	}

	function ListarCargoxArea_id(Area_id){
	    $.ajax({
	      	type: "POST",
	      	url: 'index.php?c=Cargo&a=ListarxArea_id_ajax',
	      	data:{
	      		Area_id:Area_id
	      	},
	      	//sync:false,           
	      	success: function(data) {
	        	//console.log(data);
	          	var html = "";
	          	$("#Cargo_id").find("option").remove();                 
	          	$.each(data, function(index, value) { 
	            	html += '<option value="'+value.idCargo+'">'+value.nombre+'</option>';
	          	});
	        	$("#Cargo_id").append('<option value="0">-- Seleccionar Cargo --</option>');        
	          	$("#Cargo_id").append(html);  
	        },
	      	dataType: 'json'
	  	});
	}

</script>

