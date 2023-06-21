// navbar
window.onscroll=function(){
    const navbar=document.getElementById('main_navbar');
    const fixedNav=navbar.offsetTop

    if(window.scrollY>fixedNav){
        navbar.classList.add('navbar-fixed');
    }else{
        navbar.classList.remove('navbar-fixed');
    }
}
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

function myAccDropdown() {
    $("#my-account-menu").toggleClass("hidden");
    $("#icon-dropdown").toggleClass("fa-caret-down");
    $("#icon-dropdown").toggleClass("fa-caret-up");
}

function showAlert() {
        Swal.fire({
            icon: 'error',
            iconColor: '#ef4444',
            title:'Oops!',
            html:'<p class="text-sm md:text-base">You must login first to access this</p>',
            confirmButtonColor: '#455452',
            confirmButtonText:'<h1 class="text-sm">Login Now</h1>',
            customClass: {
                popup: 'w-[70%] md:w-[50%] lg:w-[30%]',
                title: 'text-red-500 text-lg md:text-xl',
                confirmButton:'w-32 px-3 py-2 text-sm',
            },
            showCloseButton:false,
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
                    iconColor: '#00ccad',
                    title:'Congratulation!',
                    html:'<p class="text-sm md:text-base">' + response.message + '</p>',
                    showConfirmButton: true,
                    confirmButtonText:'<h1 class="text-sm">See My Wishlist</h1>',
                    confirmButtonColor:'#00ccad',
                    customClass: {
                        popup: 'w-[70%] md:w-[50%] lg:w-[30%]',
                        title: 'text-[#00ccad] text-lg md:text-xl',
                        confirmButton:'w-32 px-3 py-2 text-sm'
                    },
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
            } else if (response.action == 'remove') {
                Swal.fire({
                    icon: 'success',
                    iconColor: '#00ccad',
                    title:'Congratulation!',
                    html:'<p class="text-sm md:text-base">' + response.message + '</p>',
                    showConfirmButton: false,
                    customClass: {
                        popup: 'w-[70%] md:w-[50%] lg:w-[30%]',
                        title: 'text-[#00ccad] text-lg md:text-xl',
                    },
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