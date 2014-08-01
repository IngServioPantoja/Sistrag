$(document).ready(function () {$("#link-2104816044").bind("click", function (event) {var _confirm = confirm("Realmente desea borrar el item 'a'");if (!_confirm) {
	return false;
}$.ajax({success:function (data, textStatus) {$("#58").fadeOut();}, url:"\/Sistrag\/estandares\/delete_itemsestandares\/58"});
return false;});
$("#link-1905295061").bind("click", function (event) {var _confirm = confirm("Realmente desea borrar el item 'b'");if (!_confirm) {
	return false;
}$.ajax({success:function (data, textStatus) {$("#59").fadeOut();}, url:"\/Sistrag\/estandares\/delete_itemsestandares\/59"});
return false;});});