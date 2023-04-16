$(document).ready(function(){
    deleteModalHandler();
    getSlug($("#category_name").val());
});

//  delete modal
function deleteModalHandler(index) {
    $("#deleteItem").attr("action", $("#delete_route_" + index).val());
}

//dashboard-rating
$(document).ready(function() {
const stars=$(".star");
const ratingInput=$("#rating");

stars.each((index1, star)=>{ 
    // Pengecekan ketika rating input berisi nilai, dilakukan perulangan untuk mengaktifkan bintang sesuai dengan nilai tsb
    if(ratingInput.val()!==''){
        const inputIndex = parseInt(ratingInput.val()) - 1;
        for(let i=0;i<=inputIndex;i++){
            $(stars[i]).addClass("active");
        }
    }
    //  Add an event listener that runs a function when the "click" event is triggered
    $(star).on("click",()=>{
        //Loop through the "stars" NodeList again
        stars.each((index2,star)=>{
        //Add the "active" class to  the clicked star and any stars with a lower index
        //Remove the "active" class from any stars with higher index
            if(index1>=index2){
               $(star).addClass("active");
                ratingInput.val(index1+1);
            }else{
                $(star).removeClass("active");
                }
            })
    })
});
});

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
