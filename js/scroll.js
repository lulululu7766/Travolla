$(document).ready(function(){
    console.log("Scroll is ready!");
    
    // Scrolls down smoothly when the arrow is clicked on home page
    
    $('.ct-js-btn-scroll').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        console.log(target);
        if( target.length ) {
            event.preventDefault();
            $('html, body').animate({
                //scrollTop: target.offset().top-79
                scrollTop: target.offset().top-20
            }, 1000);
        }
    });
    
    //Slide Toggles the login form on home page
    
    $('#loginbutton').click(function(){
        $("#loginpanel").slideToggle("fast");
    });  
    
    //Slide toggles the preferences sections on sign up page
    
    $('#pref').click(function(){
        $("#signup2").slideToggle("fast");
        var source = $('#pref img').attr('src');
        if(source == "css/images/downarrow.png") {
           $("#pref img").attr("src","css/images/uparrow.png");
        } else{
            $("#pref img").attr("src","css/images/downarrow.png"); 
        }
    });  
    
    //Slide toggles the personal details section on sign up page
    
    $('#pers').click(function(){
        $("#signup1").slideToggle("fast");
        var source = $('#pers img').attr('src');
        if(source == "css/images/downarrow.png") {
           $("#pers img").attr("src","css/images/uparrow.png");
        } else{
            $("#pers img").attr("src","css/images/downarrow.png"); 
        }
    }); 
    
    //Select the mobility icons: setting a border when clicking to give feedback to the user 
    
    $('.mobicons').on('click', function(event) {
        $(event.target).css('border', 'solid #F47820 1px');
        $(event.target).css('border-radius', '25px 25px 25px 25px');

        }
    ); 
    
    //Select the preferences pictures: setting a border when clicking to give feedback to the user
    
    $('.col-lg-2 img').on('click', function(event) {
        $(event.target).css('border', 'solid #F47820 4px');
        }
    ); 
    
});

