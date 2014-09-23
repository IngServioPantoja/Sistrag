$(document).ready(function () {$("#link-639899889").bind("click", function (event) {var _confirm = confirm("Realmente desea borrar el item 'introducci\u00f3n'");if (!_confirm) {
	return false;
}$.ajax({success:function (data, textStatus) {$("#139").fadeOut();}, url:"\/Sistrag\/estandares\/delete_itemsestandares\/139"});
return false;});});