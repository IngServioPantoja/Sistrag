$(document).ready(function () {$("#atributo").bind("change", function (event) {$.ajax({async:true, data:$("#atributo").closest("form").serialize(), dataType:"html", success:function (data, textStatus) {$("#contenedor_datos").html(data);}, type:"post", url:"\/Sistrag\/estandares"});
return false;});
$("#atributo").bind("change", function (event) {$.ajax({async:true, data:$("#atributo").closest("form").serialize(), dataType:"html", success:function (data, textStatus) {$("#contenedor_datos").html(data);}, type:"post", url:"\/Sistrag\/estandares"});
return false;});});