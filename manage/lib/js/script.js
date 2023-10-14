$(document).ready(function() {

    //Toggle Menu
    $(".dropdown").click(function(){
        $(".dropdown_menu").toggleClass("active");
    });

    //Sidebar Icon
    $(".bar_icon").click(function() {
        $(".container_wrapper").toggleClass("bdt");
        
        if(!localStorage.getItem("toggle")) {
            // Check if theres anything in localstorage already
            localStorage.setItem("toggle", "true");
        } else {
            if(localStorage.getItem("toggle") === "true") {
            // toggle was on, turning it off
            localStorage.setItem("toggle", "false");
          } else if(localStorage.getItem("toggle") === "false") {
            // toggle was off, turning it on
            localStorage.setItem("toggle", "true");
          }
        }
    });
    
    if(window.innerWidth <= 768) {
        $(".container_wrapper").addClass("bdt");
    }
    
    if(localStorage.getItem("toggle") === "false") {
        $(".container_wrapper").addClass("bdt");
    }

    $(".container_wrapper .__sidebar .sidebar_items .menu_Div .toggle_Class").click(function() {
        $(this).parent().toggleClass("show");
        $(this).next().slideToggle();
        
        if ($(this).hasClass("show_subMenu")) {
            $(this).parent().removeClass("show_subMenu");
        } else {
            $(".menu_Div").removeClass("show_subMenu");
            $(this).parent().addClass("show_subMenu");
        }
        $(".toggle_Section").not($(this).next()).slideUp();
        
    });

});