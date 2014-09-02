$(document).ready(function () {$("#link-1710485252").bind("click", function (event) {var _confirm = confirm("Realmente desea borrar el item '1'");if (!_confirm) {
	return false;
}$.ajax({success:function (data, textStatus) {$("#73").fadeOut();}, url:"\/Sistrag\/estandares\/delete_itemsestandares\/73"});
return false;});
$("#link-102555836").bind("click", function (event) {var _confirm = confirm("Realmente desea borrar el item '2'");if (!_confirm) {
	return false;
}$.ajax({success:function (data, textStatus) {$("#74").fadeOut();}, url:"\/Sistrag\/estandares\/delete_itemsestandares\/74"});
return false;});});