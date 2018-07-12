function refuse() {
    var refuse= document.getElementById("refuse");

    var refuseParent=refuse.parentNode.parentNode.parentNode;
    if(refuseParent!=null){
        var con ;
        con= confirm("Are you sure you will refuse the tourist");
        if(con==true){
            refuseParent.remove();
        }

       else {

        }

    }
    else {
        alert("Error");
    }
    if(refuseParent!=null){
        var html="<p style='text-align: center;size: 100px;'>" +
            "There are no customers at present."+
            "</p>";
        $('.container').append(html);
    }
}
function accept() {
    var refuse= document.getElementById("refuse");

    var refuseParent=refuse.parentNode.parentNode.parentNode;
    refuseParent.remove();

    var html="<p style='text-align: center;size: 100px;'>" +
        "Thank you for your enthusiasm. The tourist phone has been saved to your personal settings. Get in touch with him / her."+
        "</p>";
    $('.container').append(html);
}