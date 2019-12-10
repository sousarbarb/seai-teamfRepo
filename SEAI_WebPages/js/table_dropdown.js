
$(document).ready(function(){
	//window.alert("aqui");
      $( "#foo tr" ).click(function() {
		 var currentRow=$(this).closest("tr")
		 //window.alert( currentRow.next().find("td:eq(0)").text());
         currentRow.next().find("td[class*='info']").addClass('show');
         currentRow.next().siblings().find("td[class*='info']").removeClass('show');
      });
      });
