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