$(document).ready(function () {$("#atributo").bind("change", function (event) {$.ajax({async:true, data:$("#atributo").closest("form").serialize(), dataType:"html", success:function (data, textStatus) {$("#contenedor_datos").html(data);}, type:"post", url:"\/Sistrag\/areas\/lineas_asociadas"});
return false;});
$("#valor").bind("keyup", function (event) {$.ajax({async:true, data:$("#valor").closest("form").serialize(), dataType:"html", success:function (data, textStatus) {$("#contenedor_datos").html(data);}, type:"post", url:"\/Sistrag\/areas\/lineas_asociadas\/6"});
return false;});});