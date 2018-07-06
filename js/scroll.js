$(document).ready(function(){
    console.log("Scroll is ready!");
    
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
    
    $('#loginbutton').click(function(){
        $("#loginpanel").slideToggle("fast");
    });   
    
});

