<script type="text/javascript">

function LIMPIAR12(){
 $("#FECHA_INCIDENCIAS_1").val("");
 $("#NUMEROI_1").val("");
 $("#DOCUMENTO_INCIDENCIAS_1").val("");
 $("#idAA_1").val("");
 $("#Departamento_1").val("");
 $("#TIPO_CAMBIOP").val("");
 $("#OBSERVACIONES_INCIDENCIAS_1").val("");
 $("#STATUS_1").val("");
 $("#RESPUESTA_1").val("");
 $("#NOMBRE_INCIDENCIAS_1").val("");
 
		$(function() {
			load12(1);
		});
}

		$(function() {
			load12(1);
		});
		function load12(page){
			var query=$("#NOMBRE_EVENTO").val();
			var DEPARTAMENTO2=$("#DEPARTAMENTO2WE").val();
			var FECHA_INCIDENCIAS=$("#FECHA_INCIDENCIAS_1").val();
var NUMEROI=$("#NUMEROI_1").val();
var DOCUMENTO_INCIDENCIAS=$("#DOCUMENTO_INCIDENCIAS_1").val();
var id33=$("#idAA_1").val();
var Departamento=$("#Departamento_1").val();
var OBSERVACIONES_INCIDENCIAS=$("#OBSERVACIONES_INCIDENCIAS_1").val();
var STATUS=$("#STATUS_1").val();
var hINCIDENCIAS=$("#hINCIDENCIAS_1").val();
var RESPUESTA=$("#RESPUESTA_1").val();
var NOMBRE_INCIDENCIAS=$("#NOMBRE_INCIDENCIAS_1").val();
/*termina copiar y pegar*/
			
			var per_page=$("#per_page12").val();
			var parametros = {
			"action12":"ajax12",
			"page":page,
			'query':query,
			'per_page':per_page,

/*inicia copiar y pegar*/
'FECHA_INCIDENCIAS':FECHA_INCIDENCIAS,
'DOCUMENTO_INCIDENCIAS':DOCUMENTO_INCIDENCIAS,
'NUMEROI':NUMEROI,
'id22':id33,
'Departamento':Departamento,
'OBSERVACIONES_INCIDENCIAS':OBSERVACIONES_INCIDENCIAS,
'STATUS':STATUS,
'hINCIDENCIAS':hINCIDENCIAS,
'RESPUESTA':RESPUESTA,
'NOMBRE_INCIDENCIAS':NOMBRE_INCIDENCIAS,
/*termina copiar y pegar*/

			'DEPARTAMENTO2':DEPARTAMENTO2
			};
			$("#loader12").fadeIn('slow');
			$.ajax({
				url:'INCIDENCIAS/SUPERFILTRO2/controlador_filtro.php',
				type: 'POST',				
				data: parametros,
				 beforeSend: function(objeto){
				$("#loader12").html("Cargando...");
			  },
				success:function(data){
					$(".datos_ajax12").html(data).fadeIn('slow');
					$("#loader12").html("");
				}
			})
		}
/* terminaB1*/		
		
	</script>
