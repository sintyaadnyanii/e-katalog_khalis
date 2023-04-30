$(document).ready(function(){
    deleteModalHandler();
    imageUpload();
    getProductCode($("#category_id").val());
});

//  delete modal
function deleteModalHandler(index) {
    $("#deleteItem").attr("action", $("#delete_route_" + index).val());
}

//upload image
function imageUpload() {
    var imageWrap = "";
    var imageArray = [];

    $(".input-image").each(function () {
        $(this).on("change", function (e) {
            imageWrap = $(this).closest(".input-container").find(".images-container");
            var maxLength = $(this).attr("data-max_length");

            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);
            var iterator = 0;
            filesArr.forEach(function (f, index) {
                if (!f.type.match("image.*")) {
                    return;
                }

                if (imageArray.length > maxLength) {
                    return false;
                } else {
                    var len = 0;
                    for (var i = 0; i < imageArray.length; i++) {
                        if (imageArray[i] !== undefined) {
                            len++;
                        }
                    }
                    if (len > maxLength) {
                        return false;
                    } else {
                        imageArray.push(f);

                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var html =
                                "<div class='image-wrap'><div style='background-image: url(" +
                                e.target.result +
                                ")' data-number='" +
                                $(".image-close").length +
                                "' data-file='" +
                                f.name +
                                "' class='image-bg'><div class='image-close'></div></div></div>";
                            imageWrap.append(html);
                            $('#btnLabel').text('Add More Images to Upload');
                            iterator++;
                        };
                        reader.readAsDataURL(f);
                    }
                }
            });
        });
    });

    $("body").on("click", ".image-close", function (e) {
        var file = $(this).parent().data("file");
        if (file.includes("storage")) {
            let deleted_images = $("#deleted_images").val();
            deleted_images += $(this).parent().data("id") + ",";
            $("#deleted_images").val(deleted_images);
            // console.log($("#deleted_images").val());
        }
        for (var i = 0; i < imageArray.length; i++) {
            if (imageArray[i].name === file) {
                imageArray.splice(i, 1);
                break;
            }
        }
        $(this).parent().parent().remove();
    });
}

//generate product_code
function getProductCode(category_id){
$.ajax({
    url: "/dashboard/product/get-product-code",
    data: {
        category_id:category_id
    },
    type: "get",
    beforeSend:()=>{
            $("#product_code").val("Generating Product Code...");
        },
    success: (result)=>{
            setTimeout(()=>{
                $("#product_code").val(result.data);
            },300);
        }
});
}