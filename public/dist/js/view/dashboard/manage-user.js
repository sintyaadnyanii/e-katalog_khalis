$(document).ready(function(){
    deleteModalHandler();
});

//  delete modal
function deleteModalHandler(index) {
    $("#deleteItem").attr("action", $("#delete_route_" + index).val());
}
