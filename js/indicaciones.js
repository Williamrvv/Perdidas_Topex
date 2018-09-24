function pers(indice) {
	if (indice==1) {
		document.getElementById("persona").style.display = "inline-block";
		document.getElementById("persona").setAttribute("required","");
	}else{
		document.getElementById("persona").style.display = "none";
		document.getElementById("persona").selectedIndex="0";
		document.getElementById("persona").removeAttribute("required");
	}
	if (indice==2) {	
		document.getElementById("maquina").style.display = "inline-block";
		document.getElementById("maquina").setAttribute("required","");
		document.getElementById("persona").style.display = "inline-block";
		document.getElementById("persona").setAttribute("required","");
	}else{
		document.getElementById("maquina").style.display = "none";
		document.getElementById("maquina").selectedIndex="0";
		document.getElementById("maquina").removeAttribute("required");
	}
	if (indice==3) {	
		document.getElementById("material").style.display = "inline-block";
		document.getElementById("material").setAttribute("required","");
	}else{
		document.getElementById("material").style.display = "none";
		document.getElementById("material").selectedIndex="0";
		document.getElementById("material").removeAttribute("required");
	}
}

function tipoper(indic){
	if (indic==2) {
		document.getElementById("queja").style.display = "inline-block";
		document.getElementById("queja").setAttribute("required","");

		document.getElementById("origen").selectedIndex="1";
		document.getElementById("origen").setAttribute("disabled","");

		document.getElementById("persona").value="43";
		document.getElementById("persona").style.display = "inline-block";
		document.getElementById("persona").setAttribute("disabled","");

		document.getElementById("operacion").value="40";
		document.getElementById("operacion").setAttribute("disabled","");

		$('#plente').prop('onchange',null).off('click');
				document.getElementById("lderecho").style.display = "none";
		$('#lderecho').val('');
		document.getElementById("lderecho").removeAttribute("required");
				document.getElementById("lizquierdo").style.display = "none";
		$('#lizquierdo').val('');
		document.getElementById("lizquierdo").removeAttribute("required");
	}else{
		/*----------ocultar maquina al escoger garantía*/
		document.getElementById("maquina").style.display = "none";
		document.getElementById("maquina").value="";
		document.getElementById("maquina").removeAttribute("required");
		/*----------ocultar  al escoger garantía*/
		document.getElementById("material").style.display = "none";
		document.getElementById("material").value="";
		document.getElementById("material").removeAttribute("required");

		document.getElementById("queja").style.display = "none";
		document.getElementById("queja").selectedIndex="0";
		document.getElementById("queja").removeAttribute("required");

		document.getElementById("origen").selectedIndex="0";
		document.getElementById("origen").removeAttribute("disabled");

		document.getElementById("persona").removeAttribute("disabled");
		document.getElementById("persona").style.display = "none";
		document.getElementById("persona").value="";
		$("#persona option[value='43']").hide();

		document.getElementById("operacion").value="0";
		document.getElementById("operacion").removeAttribute("disabled");

		$('#plente').attr('onchange','poslente(this.selectedIndex);');
	}
}

function poslente(inde){
	if (inde==0) {
		document.getElementById("lderecho").style.display = "none";
		$('#lderecho').val('');
		document.getElementById("lderecho").removeAttribute("required");

		document.getElementById("lizquierdo").style.display = "none";
		$('#lizquierdo').val('');
		document.getElementById("lizquierdo").removeAttribute("required");
	}
	if (inde==1) {
		document.getElementById("lizquierdo").style.display = "inline-block";
		document.getElementById("lizquierdo").setAttribute("required","");
		$('#lizquierdo').attr("placeholder", "SKU lente izquierdo");

		document.getElementById("lderecho").style.display = "none";
		$('#lderecho').val('');
		document.getElementById("lderecho").removeAttribute("required");
	}
	if (inde==2) {
		document.getElementById("lizquierdo").style.display = "inline-block";
		document.getElementById("lizquierdo").setAttribute("required","");
		$('#lizquierdo').attr("placeholder", "SKU lente derecho");

		document.getElementById("lderecho").style.display = "none";
		$('#lderecho').val('');
		document.getElementById("lderecho").removeAttribute("required");
	}
	if (inde==3) {
		document.getElementById("lderecho").style.display = "inline-block";
		document.getElementById("lderecho").setAttribute("required","");

		document.getElementById("lizquierdo").style.display = "inline-block";
		document.getElementById("lizquierdo").setAttribute("required","");
	}
}

function limpiar(){
	$("#base1").val("");
	$("#base2").val("");
	$("#add1").val("");
	$("#add2").val("");
	$("#add2").val("");
	$("#esf1").val("");
	$("#esf2").val("");
	$("#cly1").val("");
	$("#cly2").val("");
}

function tipoproceso(indi){
	if (indi==1 || indi==2) {
	//CONVENCIONAL & DIGITAL usan BASE1,BASE2,ADD1,ADD2
		limpiar();
        document.getElementById("base1").removeAttribute("disabled");
        document.getElementById("base2").removeAttribute("disabled");
		//document.getElementById("base1").setAttribute("required","");
		//document.getElementById("base2").setAttribute("required","");
        document.getElementById("add1").removeAttribute("disabled");
        document.getElementById("add2").removeAttribute("disabled");
		//document.getElementById("add1").setAttribute("required","");
		//document.getElementById("add2").setAttribute("required","");

		document.getElementById("esf1").setAttribute("disabled","");
		document.getElementById("esf2").setAttribute("disabled","");
        document.getElementById("esf1").removeAttribute("required");
        document.getElementById("esf2").removeAttribute("required");
		document.getElementById("cly1").setAttribute("disabled","");
		document.getElementById("cly2").setAttribute("disabled","");
        document.getElementById("cly1").removeAttribute("required");
        document.getElementById("cly2").removeAttribute("required");
	}if (indi==3) {
	//tERMINADO usa ESF1,ESF2, CLY1,CLY2
		limpiar();
		document.getElementById("esf1").removeAttribute("disabled");
        document.getElementById("esf2").removeAttribute("disabled");
		//document.getElementById("esf1").setAttribute("required","");
		//document.getElementById("esf2").setAttribute("required","");
        document.getElementById("cly1").removeAttribute("disabled");
        document.getElementById("cly2").removeAttribute("disabled");
		//document.getElementById("cly1").setAttribute("required","");
		//document.getElementById("cly2").setAttribute("required","");

		document.getElementById("base1").setAttribute("disabled","");
		document.getElementById("base2").setAttribute("disabled","");
        document.getElementById("base1").removeAttribute("required");
        document.getElementById("base2").removeAttribute("required");
		document.getElementById("add1").setAttribute("disabled","");
		document.getElementById("add2").setAttribute("disabled","");
        document.getElementById("add1").removeAttribute("required");
        document.getElementById("add2").removeAttribute("required");
	}
}

$("#desbloq").click(function() {  
    if($("#desbloq").is(':checked')) {
		limpiar();  
        document.getElementById("base1").removeAttribute("disabled");
        document.getElementById("base2").removeAttribute("disabled"); 
		//document.getElementById("base1").setAttribute("required","");
        document.getElementById("esf1").removeAttribute("disabled");
        document.getElementById("esf2").removeAttribute("disabled");
		//document.getElementById("esf1").setAttribute("required","");
        document.getElementById("cly1").removeAttribute("disabled");
        document.getElementById("cly2").removeAttribute("disabled");
		//document.getElementById("cly1").setAttribute("required","");
        document.getElementById("add1").removeAttribute("disabled");
        document.getElementById("add2").removeAttribute("disabled");
		//document.getElementById("add1").setAttribute("required","");
    } else {  
		limpiar();
		document.getElementById("base1").setAttribute("disabled","");
		document.getElementById("base2").setAttribute("disabled","");
		document.getElementById("esf1").setAttribute("disabled","");
		document.getElementById("esf2").setAttribute("disabled","");
		document.getElementById("cly1").setAttribute("disabled","");
		document.getElementById("cly2").setAttribute("disabled","");
		document.getElementById("add1").setAttribute("disabled","");
		document.getElementById("add2").setAttribute("disabled","");
    }  
});  

//*************************************************************comprueba cliente
	  function comprobar(client){
	  	var parametros = {
                "client" : client
        };
	  	var url = "php/comprobar_cliente.php";                                 

	    $.ajax({                        
	       type: "POST",                 
	       url: url,                    
	       data:  parametros,
	       success: function(data)            
	       {
	         $('#mensaj').html(data);  
	         //alert('seleccionaste '+ind);         
	       }
	    });
	}

//*************************************************************ajax que muestra el Paretto
	  $('#btn-ingresar').click(function(){
	  	var sel = $("#pareto option:selected").index();

	  	if (sel == "1") {
	  		var url = "php/paretto_general.php"; 
	  	}
	  	else if (sel == "2") {
	  		var url = "php/paretto_personal.php"; 
	  	}
	  	else if (sel == "3") {
	  		var url = "php/paretto_maquinas.php"; 
	  	}
	  	else if (sel == "4") {
	  		var url = "php/paretto_material.php"; 
	  	}
	  	else if (sel == "5") {
	  		var url = "php/paretto_software.php"; 
	  	}
	  	else if (sel == "0") {
	  		var url = "php/paretto.php"; 
	  	}
	                                         

	    $.ajax({                        
	       type: "POST",                 
	       url: url,                    
	       data: $("#formulario").serialize(),
	       beforeSend: function () {
                    $("#resp").html("<img src='cargando.gif' alt='Cargando la consulta, espera por favor...' width='80' height='80'>   Cargando la consulta, espere por favor...");
                },
	       success: function(data)            
	       {
	         $('#resp').html(data);  
	         //alert('seleccionaste '+ind);         
	       }
	    });
	  });



// function paret(ind) {
// 	var sel=ind;
// 	if (sel==0) {
// 		document.getElementById('#resp').innerHTML = 'Por favor seleciona un filtro';
// 	}
// else if (ind==1) {
// 	  $('#btn-ingresar').click(function(){
// 	    var url = "php/paretto_general.php";                                      

// 	    $.ajax({                        
// 	       type: "POST",                 
// 	       url: url,                    
// 	       data: $("#formulario").serialize(),
// 	       success: function(data)            
// 	       {
// 	         $('#resp').html(data);  
// 	         alert('seleccionaste '+ind);         
// 	       }
// 	    });
// 	  });
// }

// else if (sel==2) {
// 	  $('#btn-ingresar').click(function(){
// 	    var url = "php/paretto_personal.php";                                      

// 	    $.ajax({                        
// 	       type: "POST",                 
// 	       url: url,                    
// 	       data: $("#formulario").serialize(),
// 	       success: function(data)            
// 	       {
// 	         $('#resp').html(data);    
// 	         alert('seleccionaste '+ind);       
// 	       }
// 	     });
// 	  });
// }
	
// else if (sel==3) {
// 	  $('#btn-ingresar').click(function(){
// 	    var url = "php/paretto_maquinas.php";                                      

// 	    $.ajax({                        
// 	       type: "POST",                 
// 	       url: url,                    
// 	       data: $("#formulario").serialize(),
// 	       success: function(data)            
// 	       {
// 	         $('#resp').html(data);    
// 	         alert('seleccionaste '+ind);       
// 	       }
// 	     });
// 	  });
// }

// else if (sel==4) {
// 	  $('#btn-ingresar').click(function(){
// 	    var url = "php/paretto_material.php";                                      

// 	    $.ajax({                        
// 	       type: "POST",                 
// 	       url: url,                    
// 	       data: $("#formulario").serialize(),
// 	       success: function(data)            
// 	       {
// 	         $('#resp').html(data);           
// 	       }
// 	     });
// 	  });
// }

// else if (sel==5) {
// 	  $('#btn-ingresar').click(function(){
// 	    var url = "php/paretto_software.php";                                      

// 	    $.ajax({                        
// 	       type: "POST",                 
// 	       url: url,                    
// 	       data: $("#formulario").serialize(),
// 	       success: function(data)            
// 	       {
// 	         $('#resp').html(data);    
// 	         alert('seleccionaste '+ind);       
// 	       }
// 	     });
// 	  });
// }
// }

//****************************************************************************BUSCAR
	$('#search').click(function(){
		    var url = "php/buscar.php";                 
		    $.ajax({                        
		       type: "POST",                 
		       url: url,                    
		       data: $("#busqueda").serialize(),
		       success: function(data)            
		       {
		         $('#resul').html(data);  

//******************************anular la perdida
		         $('#veer').click(function(){
					swal({
					  title: "Anular perdida",
					  text: "Está completamente seguro que desea anular la perdida?",
					  icon: "warning",
					  buttons: true,
					  dangerMode: true,
					})
					.then((willDelete) => {
					  if (willDelete) {
					var url = "php/anular.php";                 
				    $.ajax({                        
				       type: "POST",                 
				       url: url,                    
				       data: $("#perr").serialize(),
				       success: function(data)            
				       {
				         $('#veeer').html(data);         
				       }
				     });
					    swal("Todo Listo! La perdida fue anulada", {icon: "success",});
					  } else {
					    //swal("Your imaginary file is safe!");
					  }
					});
				  });
//******************************anular la perdida FIN

		       }
		     });
		  });

$(document).ready(function () {
   $('#busqueda').keypress(function (e) {   //Busca con tecla enter
        var code = null;
        code = (e.keyCode ? e.keyCode : e.which);                
        
        if (code == 13) {
        	var url = "php/buscar.php";                 
		    $.ajax({                        
		       type: "POST",                 
		       url: url,                    
		       data: $("#busqueda").serialize(),
		       success: function(data)            
		       {
		         $('#resul').html(data);
//******************************anular la perdida
		         $('#veer').click(function(){
					swal({
					  title: "Anular perdida",
					  text: "Está completamente seguro que desea anular la perdida?",
					  icon: "warning",
					  buttons: true,
					  dangerMode: true,
					})
					.then((willDelete) => {
					  if (willDelete) {
					var url = "php/anular.php";                 
				    $.ajax({                        
				       type: "POST",                 
				       url: url,                    
				       data: $("#perr").serialize(),
				       success: function(data)            
				       {
				         $('#veeer').html(data);         
				       }
				     });
					    swal("Todo Listo! La perdida fue anulada", {icon: "success",});
					  } else {
					    //swal("Your imaginary file is safe!");
					  }
					});
				  });
//******************************anular la perdida FIN

		       }
		     });
		return (code == 13) ? false : true;
        }
   });
});
//****************************************************************************BUSCAR FIN


function compsku1(valorCaja1){
    var parametros = {
        "valorCaja1" : valorCaja1
	};
$.ajax({
    data:  parametros, //datos que se envian a traves de ajax
    url:   'php/comprobar_sku.php', //archivo que recibe la peticion
    type:  'post',
    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
        $("#sku1").html(response);
    }
});
}

function compsku2(valorCaja2){
    var parametros = {
        "valorCaja2" : valorCaja2
	};
$.ajax({
    data:  parametros, //datos que se envian a traves de ajax
    url:   'php/comprobar_sku.php', //archivo que recibe la peticion
    type:  'post',
    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
        $("#sku2").html(response);
    }
});
}

$("#reimprimir").on('submit', function(e){
 	e.preventDefault();
    var url = "php/reimprimir.php";                                      

        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $("#cargado").html("<img src='cargando.gif' alt='Cargando la consulta, espera por favor...' width='80' height='80'>Verificando si existe la perdida, espere por favor...");
            },
            success: function(response){
                $("#reimp").html(response);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#cargado").html("<br><div class='alert alert-danger' role='alert'><i class='fas fa-plug'></i> Error en la conexión, por favor contacta con T.I</div>");
            }
        });
});