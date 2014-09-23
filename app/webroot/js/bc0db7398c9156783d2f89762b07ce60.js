$(document).ready(function () {$("#atributo").bind("change", function (event) {$.ajax({async:true, data:$("#atributo").closest("form").serialize(), dataType:"html", success:function (data, textStatus) {$("#contenedor_datos").html(data);}, type:"post", url:"\/Sistrag\/programas\/areas_asociadas"});
return false;});
$("#valor").bind("keyup", function (event) {$.ajax({async:true, data:$("#valor").closest("form").serialize(), dataType:"html", success:function (data, textStatus) {$("#contenedor_datos").html(data);}, type:"post", url:"\/Sistrag\/programas\/areas_asociadas\/23"});
return false;});});