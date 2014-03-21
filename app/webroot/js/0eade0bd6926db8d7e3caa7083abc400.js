$(document).ready(function () {$("#facultad").bind("change", function (event) {$.ajax({async:true, data:$("#facultad").closest("form").serialize(), dataType:"html", success:function (data, textStatus) {$("#div_programa").html(data);}, type:"post", url:"\/Sistrag\/programas\/lista_programas"});
return false;});
$("#programa_id").bind("change", function (event) {$.ajax({async:true, data:$("#programa_id").closest("form").serialize(), dataType:"html", success:function (data, textStatus) {$("#div_area").html(data);}, type:"post", url:"\/Sistrag\/programas\/lista_programas"});
return false;});
$("#area_id").bind("change", function (event) {$.ajax({async:true, data:$("#area_id").closest("form").serialize(), dataType:"html", success:function (data, textStatus) {$("#asociacion").html(data);}, type:"post", url:"\/Sistrag\/proyectos\/lista_lineas"});
return false;});});