// fungsi hapus
function deleteHandler(index) {
    console.log($("#delete_route_" + index).val());
    $("#deleteItem").attr("action", $("#delete_route_" + index).val());
}
