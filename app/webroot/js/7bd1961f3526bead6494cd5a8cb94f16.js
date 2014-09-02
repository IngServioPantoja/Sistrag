$(document).ready(function () {$("#link-1416552563").bind("click", function (event) {var _confirm = confirm("Realmente desea borrar el item '1'");if (!_confirm) {
	return false;
}$.ajax({success:function (data, textStatus) {$("#73").fadeOut();}, url:"\/Sistrag\/estandares\/delete_itemsestandares\/73"});
return false;});});