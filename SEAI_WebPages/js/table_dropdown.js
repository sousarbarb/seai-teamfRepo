
$(document).ready(function(){
	//window.alert("aqui");
      $( "#foo tr" ).click(function() {
		 var currentRow=$(this).closest("tr");
		 var nextrow= currentRow.next();
		 if (currentRow.next().find("td[class*='info']").hasClass('show')) {
			 //window.alert("aqui");
			 currentRow.next().find("td[class*='info']").removeClass('show');
		 }
		 else{
			// window.alert("aqui1");
		 //window.alert( currentRow.next().find("td:eq(0)").text());
         currentRow.next().find("td[class*='info']").addClass('show');
         }
      });
      });
