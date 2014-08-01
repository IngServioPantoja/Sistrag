$(document).ready(function () {$("#link-1453553156").bind("click", function (event) {var _confirm = confirm("Realmente desea borrar el item 'a'");if (!_confirm) {
	return false;
}$.ajax({success:function (data, textStatus) {$("#58").fadeOut();}, url:"\/Sistrag\/estandares\/delete_itemsestandares\/58"});
return false;});});