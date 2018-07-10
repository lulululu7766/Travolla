var guideDict = [];

var cityId = $_GET['cityId'];

window.onload = function () {
    getGuides();
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
                var guideName = object["GUIDES"][i]['name'];
                var guideHome = parseInt(object["GUIDES"][i]['home_city_id']);

                guideDict[guideName] = [guideHome];
            }
        }
    });
}