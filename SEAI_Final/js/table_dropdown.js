
 function doFunction(e){
		 var currentRow=$(e).closest("tr");
		// alert(currentRow.id);
		 var nextrow= currentRow.next();
		 var id = currentRow.next().find("td[class*='info']").text();
		 //alert(id);
		 document.getElementById("rid").value = id;
		document.forms.league.submit('id');			
		
      };
