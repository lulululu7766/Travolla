$(document).ready(function(){
    console.log("Scroll is ready!");
  
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

