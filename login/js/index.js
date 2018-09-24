function msieversion() 
{
if (navigator.appName == 'Microsoft Internet Explorer' ||  !!(navigator.userAgent.match(/Trident/) || navigator.userAgent.match(/rv:11/)) || (typeof $.browser !== "undefined" && $.browser.msie == 1))
{
  location.href ='../error';
}
}


 $("#login-button").click(function(event){
	event.preventDefault();
	 
	$('form').fadeOut(500);
	$('.wrapper').addClass('form-success');
	$('#mensaje').fadeOut(500);
});

//  	 function enviar(){ 
//    document.login.submit() 
// } 

	  $('#login-button').click(function(){
	    var url = "../php/log_ses.php";                                      

	    $.ajax({                        
	       type: "POST",                 
	       url: url,                    
	       data: $("#login").serialize(),
	       success: function(data)            
	       {
	         $('#caja').html(data);           
	       }
	    });
	  });