// fungsi hapus
function deleteHandler(index) {
    console.log($("#delete_route_" + index).val());
    $("#deleteItem").attr("action", $("#delete_route_" + index).val());
    $("#delete_route_input").val($("#delete_route_" + index).val());
}
