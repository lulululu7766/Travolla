window.onload = function () {
console.log("Ran JS file");

//var guideDict = [];

//var cityId = $_POST['cityId'];
var urlParams = new URLSearchParams(window.location.search);
var cityId = urlParams.get('cityId');

function getGuides() {
    tempDict = [];
    // Get activities from DB and add to activityDict
    $.ajax({
        // Using a POST request
        type:"POST",
        // Pass through the cityId parameter
        url:"./js/helpers/guidematchhelper.php?cityId=" + cityId,
        success:function(data) {
            console.log("Retrieved JSON data: " + data);
            
            // Parse data in JSON format
            var object = JSON.parse(data);
            for (var i = 0; i < object["GUIDES"].length; i++) {
                
                console.log("Iterated over JSON data, looking at: " + object["GUIDES"][i]['user_id'] + " " + object["GUIDES"][i]['name']);
                
                // Array format: [Name, Duration, Short description, Long description, Category, Cost, Rating]
                var guideId = parseInt(object["GUIDES"][i]['user_id']);
                var guideName = object["GUIDES"][i]['name'];
                var guideHome = parseInt(object["GUIDES"][i]['home_city_id']);
               // var imagePath = object["GUIDES"][i]['image_path'];
                var gender = object["GUIDES"][i]['gender'];
                var activityLevel = object["GUIDES"][i]['activity_level'];
                var mobilityLevel = object["GUIDES"][i]['mobility_level'];
                //var dietaryRestrictions = object["GUIDES"][i]['dietary_restrictions']; /**/
                
                //guideDict[guideId] = [guideName];
                
                //tempDict[guideId] = [guideName, guideHome, imagePath, gender, //activityLevel, mobilityLevel, dietaryRestrictions]; 
                
                tempDict.push([guideId, guideName, guideHome, gender, activityLevel, mobilityLevel]);
            }
             console.log("Dictionary contains: " + tempDict);
            
  
        }     
    });
    console.log("Returning dictionary: " + tempDict);
    return tempDict; 
}

    console.log("Ran onload function.");
    getGuides();

    
// Display guides to browser
setTimeout(function () {
    // Insert guide list at 
    // div id="guideList"
    var guideMainList = document.getElementById('guideList');

    console.log("Ran stuffGuidesToHTML");
    
    console.log("guideDict contains " + tempDict.length + " elements");
    
    var iteration_counter = 0;
    
    // Grab guide details and display
    for (var guide in tempDict) {

        console.log("Iterated within guideDict");
        
        // BOOTSTRAP Create a new container for each guide.
        var guideContainer = document.createElement('div');
        guideContainer.className = "container";
        // BOOTSTRAP Create the guide heading.
        var guideName = document.createElement('h4');
        guideName.innerText = tempDict[guide][0];
        
        console.log("Guide Id: " + tempDict[guide][0] + ", Name: " + tempDict[guide][1]);
        console.log();
        guideContainer.appendChild(guideName);

         // Append to page
        guideMainList.appendChild(guideContainer);
        
        
        iteration_counter = iteration_counter + 1;
    }    

    console.log("Iteration counter contains: " + iteration_counter);

},5000);
    
}