$(document).ready(function(){
    console.log('form is ready');
    
    $('#pref').on('click', function(event) {
        console.log('hello');
        if((document.getElementById("inputName").value.length != 0)
          && (document.getElementById("inputEmail").value.length != 0)
          && (document.getElementById("inputPassword").value.length != 0))
        {
            var bar = document.getElementById("bar");
            bar.setAttribute("style","width: 75%");
        }
    })
});