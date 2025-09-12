	<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">

    <h4 class="modal-title">Detalles</h4>
   </div>
   <div class="modal-body" id="personal_detalles2">

   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
   </div>
  </div>
 </div>
</div>



<div id="dataModal" class="modal fade">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header">

    <h4 class="modal-title">Detalles</h4>
   </div>
   <div class="modal-body" id="personal_detalles">
    
   </div>
   <div class="modal-footer">
   
   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
   
   </div>
  </div>
 </div>
</div>
	

<!--NUEVO CODIGO BORRAR-->
<div id="dataModal3" class="modal fade">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header">

    <h4 class="modal-title">Detalles</h4>
   </div>
   <div class="modal-body" id="personal_detalles3">
    ¿ESTÁS SEGURO DE BORRAR ESTE REGISTRO?
   </div>
   <div class="modal-footer">
          <span id="btnYes" class="btn confirm">SI BORRAR</span>	  
   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
   
   </div>
  </div>
 </div>
</div>




<script type="text/javascript">
	var fileobj;
	function upload_file(e,name) {
	    e.preventDefault();
	    fileobj = e.dataTransfer.files[0];
	    ajax_file_upload1(fileobj,name);
	}
	 
	function file_explorer(name) {
	    document.getElementsByName(name)[0].click();
	    document.getElementsByName(name)[0].onchange = function() {
	        fileobj = document.getElementsByName(name)[0].files[0];
	        ajax_file_upload1(fileobj,name);
	    };
	}








	function ajax_file_upload1(file_obj,nombre) {
	    if(file_obj != undefined) {
	        var form_data = new FormData();                  
	        form_data.append(nombre, file_obj);
	        $.ajax({
	            type: 'POST',
	            url: 'INCIDENCIAS/controladorIN.php',
	            contentType: false,
	            processData: false,
	            data: form_data,
 beforeSend: function() {
$('#1'+nombre).html('<p style="color:green;">CARGANDO archivo!</p>');
$('#mensajeADJUNTOCOL').html('<p style="color:green;">Actualizado!</p>');
    },				
	            success:function(response) {
if($.trim(response) == 2 ){
$('#1'+nombre).html('<p style="color:red;">Error, archivo diferente a PDF, JPG o GIF.</p>');
$('#'+nombre).val("");
}else{
$('#'+nombre).val(response);
$('#1'+nombre).html('<a target="_blank" href="includes/archivos/'+$.trim(response)+'">Visualizar!</a>');	
}
	            }
	        });
	    }
	}



////////////////////////////////////////////DEPA///////////////////////////////////////////
function OBTENER_depa(){
var DOCUMENTO_INCIDENCIAS = $( "#DOCUMENTO_INCIDENCIAS option:selected" ).val();
var OBTENER_depa1 = "OBTENER_depa1";
$.ajax({
 url: 'INCIDENCIAS/controladorIN.php',
method:'POST',
data:{DOCUMENTO_INCIDENCIAS:DOCUMENTO_INCIDENCIAS,OBTENER_depa1:OBTENER_depa1},
beforeSend:function(){
},
success:function(data){
		 
	document.getElementsByName('Departamento')[0].value = data;	
	
			

}
});
}





	$(document).ready(function(){





 

$("#GUARDAR_INCIDENCIAS").click(function(){
const formData = new FormData($('#INCIDENCIASform')[0]);

$.ajax({
   url: 'INCIDENCIAS/controladorIN.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajeINCIDENCIAS').html('cargando'); 
    },    
   success:function(data){
	   	 $('#INCIDENCIASform')[0].reset(); 
		 $('#picture').css({
         'background-image': 'none',
         'background-color': 'transparent'
});
		$("#base64_file").load(location.href + " #base64_file");
		$("#dropzone").load(location.href + " #dropzone");
		$("#LINK").load(location.href + " #LINK");
	
		//$("#reset_INCIDENCIAS").load(location.href + " #reset_INCIDENCIAS");	
		$("#mensajeINCIDENCIAS").html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(4000).fadeOut();
		$.getScript(load(1));	
   }
   
})
});


$(document).on('click', '.view_INCIDENCIAS', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
  url:"INCIDENCIAS/VistaPreviaINCIDENCIAS.php",
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajeINCIDENCIAS').html('CARGANDO'); 
    },    
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 })



$(document).on('click', '.view_dataINCIDENCIASborrar', function(){

  var borra_incidencias = $(this).attr("id");
  var borra_INCIDENCIAS = "borra_INCIDENCIAS";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
  url:'INCIDENCIAS/controladorIN.php',
   method:"POST",
   data:{borra_incidencias:borra_incidencias,borra_INCIDENCIAS:borra_INCIDENCIAS},
   
    beforeSend:function(){  
    $('#mensajeINCIDctualiza2').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensajeINCIDctualiza2").html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(4000).fadeOut();			
			//$("#reset_INCIDENCIAS").load(location.href + " #reset_INCIDENCIAS");
		$.getScript(load(1));			
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });

/////////////////////SCRIPT enviar EMAIL//////
$(document).on('click', '#BUTTON_INCIDENCIAS', function(){
    var EMAIL_INCIDENCIAS = $('#EMAIL_INCIDENCIAS').val();
    
    
            var myCheckboxes = new Array();
            $("input:checked").each(function() {
               myCheckboxes.push($(this).val());
            });
    var dataString = $("#form_emil_INCIDENCIAS").serialize();
    
    $.ajax({
     url: 'INCIDENCIAS/controladorIN.php',
    method:'POST',
    dataType: 'html',
    
    data: dataString+{EMAIL_INCIDENCIAS:EMAIL_INCIDENCIAS},
    
    
    beforeSend:function(){
    $('#mensajeINCIDctualiza2').html('cargando');
    },
    success:function(data){
    $('#mensajeINCIDctualiza2').html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(4000).fadeOut();
    
    }
    });
    });

/////////////////////////////NUEVO Departamento///////////////////////////////////////////////////////////


$("#enviarNUEVODEPA").click(function(){
const formData = new FormData($('#DOCUMENTONUEVODEPAform')[0]);

$.ajax({
      url:'INCIDENCIAS/controladorIN.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajeNUEVODEPA').html('cargando');   
    },    
   success:function(data){
	
		$("#reseteateNUEVODEPA").load(location.href + " #reseteateNUEVODEPA");	
			$("#mensajeNUEVODEPA").html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(4000).fadeOut();			
		$("#despleResetCierre").load(location.href + " #despleResetCierre");	

   }
   
})
});



$(document).on('click', '.view_dataNUEVOdoNUEVODEPA', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
   url:"INCIDENCIAS/VistaPreviaNUEVODEPA.php",
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajeNUEVODEPA').html('CARGANDO'); 
    },    
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 });

$(document).on('click', '.view_databorraNUEVONUEVODEPA', function(){

  var borra_NUEVOD = $(this).attr("id");
  var BORRAREGISTRO_NUEVO = "BORRAREGISTRO_NUEVO";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
    url: 'INCIDENCIAS/controladorIN.php',
   method:"POST",
   data:{borra_NUEVOD:borra_NUEVOD,BORRAREGISTRO_NUEVO:BORRAREGISTRO_NUEVO},
   
    beforeSend:function(){  
    $('#mensajeNUEVODEPA').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensajeNUEVODEPA").html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(4000).fadeOut();			
			$("#reseteateNUEVODEPA").load(location.href + " #reseteateNUEVODEPA");
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });

	

			$('#target1').hide("linear");
			$('#target2').hide("linear");
			$('#target3').hide("linear");
			$('#target4').hide("linear");
			$('#target5').hide("linear");
			$('#target6').hide("linear");
			$('#target7').hide("linear");
			$('#target8').hide("linear");
			$('#target9').hide("linear");
			$('#target10').hide("linear");
			$('#target11').hide("linear");
			$('#target12').hide("linear");
			$('#target13').hide("linear");
			$('#target14').hide("linear");
			$('#target15').hide("linear");
			$('#targetVIDEO').hide("linear");
			
			$("#mostrar1").click(function(){
				$('#target1').show("swing");
		 	});
			$("#ocultar1").click(function(){
				$('#target1').hide("linear");
			});
			$("#mostrar2").click(function(){
				$('#target2').show("swing");
		 	});
			$("#ocultar2").click(function(){
				$('#target2').hide("linear");
			});
			$("#mostrar3").click(function(){
				$('#target3').show("swing");
		 	});
			$("#ocultar3").click(function(){
				$('#target3').hide("linear");
			});
			$("#mostrar4").click(function(){
				$('#target4').show("swing");
		 	});
			$("#ocultar4").click(function(){
				$('#target4').hide("linear");
			});
			$("#mostrar5").click(function(){
				$('#target5').show("swing");
		 	});
			$("#ocultar5").click(function(){
				$('#target5').hide("linear");
			});
			$("#mostrar6").click(function(){
				$('#target6').show("swing");
		 	});
			$("#ocultar6").click(function(){
				$('#target6').hide("linear");
			});
			$("#mostrar7").click(function(){
				$('#target7').show("swing");
		 	});
			$("#ocultar7").click(function(){
				$('#target7').hide("linear");
			});
			$("#mostrar8").click(function(){
				$('#target8').show("swing");
		 	});
			$("#ocultar8").click(function(){
				$('#target8').hide("linear");
			});
			$("#mostrar9").click(function(){
				$('#target9').show("swing");
		 	});
			$("#ocultar9").click(function(){
				$('#target9').hide("linear");
			});
			$("#mostrar10").click(function(){
				$('#target10').show("swing");
		 	});
			$("#ocultar10").click(function(){
				$('#target10').hide("linear");
			});
			$("#mostrar11").click(function(){
				$('#target11').show("swing");
		 	});
			$("#ocultar11").click(function(){
				$('#target11').hide("linear");
			});
			$("#mostrar12").click(function(){
				$('#target12').show("swing");
		 	});
			$("#ocultar12").click(function(){
				$('#target12').hide("linear");
			});
			$("#mostrar13").click(function(){
				$('#target13').show("swing");
		 	});
			$("#ocultar13").click(function(){
				$('#target13').hide("linear");
			});

			$("#mostrar14").click(function(){
				$('#target14').show("swing");
		 	});
			$("#ocultar14").click(function(){
				$('#target14').hide("linear");
			});
			
			$("#mostrar15").click(function(){
				$('#target15').show("swing");
		 	});
			$("#ocultar15").click(function(){
				$('#target15').hide("linear");
			});

        

			$("#mostrarVIDEO").click(function(){
				$('#targetVIDEO').show("swing");
		 	});
			$("#ocultarVIDEO").click(function(){
				$('#targetVIDEO').hide("linear");
			});

			$("#mostrartodos").click(function(){
		
				$('#target1').show("swing");
				$('#target2').show("swing");
				$('#target3').show("swing");
				$('#target4').show("swing");
				$('#target5').show("swing");
				$('#target6').show("swing");
				$('#target7').show("swing");
				$('#target8').show("swing");
				$('#target9').show("swing");
				$('#target10').show("swing");
				$('#target11').show("swing");
				$('#target12').show("swing");
				$('#target13').show("swing");
				$('#target14').show("swing");
				$('#target15').show("swing");
				$('#targetVIDEO').show("swing");
		 	});
			
			$("#ocultartodos").click(function(){
				
				$('#target1').hide("linear");
				$('#target2').hide("linear");	
				$('#target3').hide("linear");
				$('#target4').hide("linear");
				$('#target5').hide("linear");
				$('#target6').hide("linear");
				$('#target7').hide("linear");
				$('#target8').hide("linear");
				$('#target9').hide("linear");
				$('#target10').hide("linear");
				$('#target11').hide("linear");
				$('#target12').hide("linear");
				$('#target13').hide("linear");
				$('#target14').hide("linear");
				$('#target15').hide("linear");
				$('#targetVIDEO').hide("linear");
			});

			$("#mostrartodos2").click(function(){
		
				$('#target1').show("swing");
				$('#target2').show("swing");
				$('#target3').show("swing");
				$('#target4').show("swing");
				$('#target5').show("swing");
				$('#target6').show("swing");
				$('#target7').show("swing");
				$('#target8').show("swing");
				$('#target9').show("swing");
				$('#target10').show("swing");
				$('#target11').show("swing");
				$('#target12').show("swing");
				$('#target13').show("swing");
				$('#target14').show("swing");
				$('#target15').show("swing");
				$('#targetVIDEO').show("swing");
		 	});
			
			$("#ocultartodos2").click(function(){
				
				$('#target1').hide("linear");
				$('#target2').hide("linear");	
				$('#target3').hide("linear");
				$('#target4').hide("linear");
				$('#target5').hide("linear");
				$('#target6').hide("linear");
				$('#target7').hide("linear");
				$('#target8').hide("linear");
				$('#target9').hide("linear");
				$('#target10').hide("linear");
				$('#target11').hide("linear");
				$('#target12').hide("linear");
				$('#target13').hide("linear");
				$('#target14').hide("linear");
				$('#target15').hide("linear");
				$('#targetVIDEO').hide("linear");
			});

		});
		
	</script>