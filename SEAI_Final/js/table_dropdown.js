
$(document).ready(function(){
	//window.alert("aqui");
      $( "#foo tr:has(td)" ).click(function() {
		 var currentRow=$(this).closest("tr");
		 var nextrow= currentRow.next();
		 if (currentRow.next().find("td[class*='info']")) { 
			var id = currentRow.next().find("td[class*='info']").text();
			alert(id);
			document.forms.league.submit('id');			
		 }
		 else{
			// window.alert("aqui1");
		 //window.alert( currentRow.next().find("td:eq(0)").text());
         }
      });
	  $('#foo tr:has(td)').hover(function ()
      {
        $(this).toggleClass('Highlight');
      });
  
      });
