var guideDict = [];

//var cityId = $_POST['cityId'];
var urlParams = new URLSearchParams(window.location.search);
var cityId = urlParams.get(cityId);

window.onload = function () {
    getGuides();
    stuffGuidesToHTML(guideDict);
}

function getGuides() {
    // Get activities from DB and add to activityDict
    $.ajax({
        // Using a POST request
        type:"POST",
        // Pass through the cityId parameter
        url:"./js/helpers/guidematchhelper.php?cityId=" + cityId,
        success:function(data) {
            // Parse data in JSON format
            var object = JSON.parse(data);
            for (var i = 0; i < object["GUIDES"].length; i++) {
                // Array format: [Name, Duration, Short description, Long description, Category, Cost, Rating]
                var guideId = object["GUIDES"][i]['user_id'];
                var guideName = object["GUIDES"][i]['name'];
                var guideHome = parseInt(object["GUIDES"][i]['home_city_id']);
                var imagePath = object["GUIDES"][i]['image_path'];
                var gender = object["GUIDES"][i]['gender'];
                var activityLevel = object["GUIDES"][i]['activity_level'];
                var mobilityLevel = object["GUIDES"][i]['mobility_level'];
                var dietaryRestrictions = object["GUIDES"][i]['dietary_restrictions'];
                guideDict[guideId] = [guideName, guideHome, imagePath, gender, activityLevel, mobilityLevel, dietaryRestrictions];
            }
        }
    });
}

// Display guides to browser
function stuffGuidesToHTML(guideDict) {
    // Insert guide list at 
    // div id="guideList"
    var guideMainList = document.getElementById('guideList');

    // Grab guide details and display
    for (var guide in guideDict) {

        // BOOTSTRAP Create a new container for each guide.
        var guideContainer = document.createElement('div');
        guideContainer.className = "container";
        // BOOTSTRAP Create the guide heading.
        var guideName = document.createElement('h4');
        guideName.innerText = guideDict[guide][0];
        
        console.log("Guide name: ");
        console.log(guideDict[guide][0]);
        guideContainer.appendChild(guideName);

         // Append to page
        guideMainList.appendChild(guideContainer);
        
    }    
   



}