var guideDict = [];

var cityId = $_GET['cityId'];

window.onload = function () {
    getGuides();
    stuffGuidesToHTML();
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
                guideDict[guideId] = [guideName, guideHome, imagePath, gender, activityLevel, mobilityLevel, dietaryRestructions];
            }
        }
    });
    
    
function stuffGuidesToHTML() {
    //guideList
}
}