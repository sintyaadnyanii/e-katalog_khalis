// user modal menu
function userMenuDropdown() {
    $("#user-menu").toggleClass("hidden");
}
    $(document).on("click", function(event) {
    var target = event.target;
    var modal = $("user-menu");

    // Check if the clicked element is not the modal or its descendant
    if (!modal.is(target) && modal.has(target).length === 0) {
        modal.addClass("hidden");
    }
});      

// sidenav
function sideNavMobile() {
   $("#sidenav").toggleClass("hidden");
}
    $('#sidenav-overlay').on('click', function() {
            sideNavMobile();
    });

function dropdownSidenav() {
    $("#dropdown-menu").toggleClass("hidden");
    $("#icon-dropdown").toggleClass("fa-caret-down");
    $("#icon-dropdown").toggleClass("fa-caret-up");
}

function categoryDropdown(){
    $("#category-list").toggleClass("hidden");
    $("#icon-dropdown").toggleClass("fa-caret-down");
    $("#icon-dropdown").toggleClass("fa-caret-up");
}

function showAlert() {
        Swal.fire({
            icon: 'warning',
            title: 'You must login first to access this',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Login Now',
            showCancelButton:true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/login';
            }
        });
}

function addWishlist(product_code,index){
    // const user_id='{{auth()->user()->id}}'
    // console.log(product_code+' user id:'+user_id);
    // console.log('{{Auth::id()}}')
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $.ajax({
        
        type: "POST",
        url: "/add-to-wishlist",
        data: {
            product_code:product_code,
            // user_id:$("#user_id").val()
        },
        success: function (response) {
            if (response.action == 'add') {
                Swal.fire({
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: true,
                    confirmButtonText:'See My Wishlist',
                    timer: 3000,
                    didRender:()=>{
                        $("#likes_"+index).text(response.likes);
                        $("#added_product").text(response.added_product);
                        $("#like_icon_"+index).removeClass("fa-regular fa-heart").addClass('fa-solid fa-heart text-[#D76A73]');
                    }
                }).then((result)=>{
                    if(result.isConfirmed){
                       window.location.href='/wishlist';
                    }
                    
                })
                
                // .then(() => {
                //     location.href = '/my-wishlist';
                // });
            } else if (response.action == 'remove') {
                Swal.fire({
                    icon: 'success',
                    title: 'Product Removed Successfully from Wishlist',
                    showConfirmButton: false,
                    timer: 3000,
                     didRender:()=>{
                        $("#likes_"+index).text(response.likes);
                        $("#added_product").text(response.added_product);
                        $("#like_icon_"+index).removeClass("fa-solid fa-heart text-[#D76A73]").addClass('fa-regular fa-heart');
                    }
                });
            }

            
        }
    });
    
    // fa-solid fa-heart text-[#D76A73]
    // fa-regular fa-heart
}