$(document).ready(function () {$("#submit-764449683").bind("click", function (event) {$.ajax({async:false, data:$("#submit-764449683").closest("form").serialize(), dataType:"html", success:function (data, textStatus) {$("#myModal").html(data);}, type:"post", url:"\/Sistrag\/reportes\/detalleReporteEstado"});
return false;});});