
$(document).ready(function() {

	$("#options_serie").change(function() {
		var strSoc = "";
		var socid = $("input[name=socid").val();
		if(socid !== undefined)
			var strSoc = "&socid="+socid;
		var serie = $(this).val();
		var ref_client = $("input[name=ref_client]").val();
		window.location.href = "?action=create"+strSoc+"&ref_client="+ref_client+"&options_serie="+serie;
	});

	$("#socid").change(function() {
		var socid = $(this).val();
		var serie = $("#options_serie").val();
		var ref_client = $("input[name=ref_client]").val();
		window.location.href = "?action=create&socid="+socid+"&ref_client="+ref_client+"&options_serie="+serie;
	});
		
});
