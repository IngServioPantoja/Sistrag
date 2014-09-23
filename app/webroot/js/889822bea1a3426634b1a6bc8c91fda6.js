$(document).ready(function () {$("#link-352818106").bind("click", function (event) {var _confirm = confirm("Realmente desea borrar el item '123'");if (!_confirm) {
	return false;
}$.ajax({success:function (data, textStatus) {$("#108").fadeOut();}, url:"\/Sistrag\/estandares\/delete_itemsestandares\/108"});
return false;});});