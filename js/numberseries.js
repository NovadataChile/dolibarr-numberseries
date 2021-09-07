
$(document).ready(function() {

	$("#options_serie").change(function() {
		var strSoc = "";
		var socid = $("input[name=socid").val();
		if(socid !== undefined)
			var strSoc = "&socid="+socid;
		var serie = $(this).val();
		var ref_client = $("input[name=ref_client]").val();
		//reload page
		window.location.href = "?action=create"+strSoc+"&ref_client="+ref_client+"&ref_numberseries="+serie;
	});
});
