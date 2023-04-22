$(document).ready(function(){
    deleteModalHandler();
    getSlug($("#category_name").val());
});

//  delete modal
function deleteModalHandler(index) {
    $("#deleteItem").attr("action", $("#delete_route_" + index).val());
}

//get-slug
function getSlug(name){
    $.ajax({
        url: "/dashboard/category/get-slug",
        data: {
            name: name,
            id: $("#category_id").val(),
        },
        type: "get",
        beforeSend:()=>{
            $("#category_slug").val("Generating Slug...");
        },
        success: (result)=>{
            setTimeout(()=>{
                $("#category_slug").val(result.data);
            },300);
        }
    });
}