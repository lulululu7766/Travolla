$(document).ready(function(){
    console.log("Scroll is ready!");
    
    //Set the background image to the landing page
    var img = $('.cover-container').css('background-image', 'url("css/images/bg.jpg")');

    //Retrieve the screen height of the user
    var screenheight = screen.height;
    
    //console.log(screenheight);
    
    //Adapt the landing container to have the screenheight minus 100px
    $('.landing').css('height',screenheight-100);
    
    $('a').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        console.log(target);
        if( target.length ) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top-79
            }, 1000);
        }
    });
    
   
});

