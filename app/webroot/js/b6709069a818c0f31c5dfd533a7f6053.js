$(document).ready(function () {$("#submitCortoRight").bind("click", function (event) {$.ajax({complete:, data:$("#submitCortoRight").closest("form").serialize(), type:"post", url:"\/Sistrag\/detalleentregas\/emitir_concepto"});
return false;});
$("#formularioDetalleentrega").bind("change", function (event) {$.ajax({async:true, beforeSend:function (XMLHttpRequest) {$("#barraComentarios").fadeIn();}, complete:function (XMLHttpRequest, textStatus) {$("#barraComentarios").fadeOut();}, data:$("#formularioDetalleentrega").closest("form").serialize(), dataType:"html", success:function (data, textStatus) {$("#sss").html(data);}, type:"post", url:"\/Sistrag\/detalleentregas\/edit"});
return false;});
$("#tiposestandares").bind("change", function (event) {$.ajax({async:true, data:$("#tiposestandares").closest("form").serialize(), dataType:"html", success:function (data, textStatus) {$("#lista_documentos").html(data);}, type:"post", url:"\/Sistrag\/documentos\/lista_documentos"});
return false;});});