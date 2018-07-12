var urlParams = new URLSearchParams(window.location.search);
var cityId = urlParams.get('cityId');

window.onload = function () {

    getGuides();
  
}
    
function getGuides() {

    guideDict = [];  
    
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
                var guideId = parseInt(object["GUIDES"][i]['user_id']);
                var guideName = object["GUIDES"][i]['name'];
                var guideHome = parseInt(object["GUIDES"][i]['home_city_id']);
                var imagePath = object["GUIDES"][i]['image_path'];
                var gender = object["GUIDES"][i]['gender'];
                var dob = object["GUIDES"][i]['date_of_birth'];
                var activityLevel = object["GUIDES"][i]['activity_level'];
                var mobilityLevel = object["GUIDES"][i]['mobility_level'];
                var dietaryRestrictions = object["GUIDES"][i]['dietary_restrictions'];
                
                //guideDict.push([guideId, guideName, guideHome, imagePath, gender, activityLevel, mobilityLevel, dietaryRestrictions]);
                
                guideDict.push([guideId, guideName, guideHome, imagePath, gender, activityLevel, mobilityLevel]);

                
                // Calculate guide's age, by getting current time & 
                // subtracting guide's D.O.B. from current_time
                var current_date = new Date();
                
                epoch_time = (current_date.getTime() / 1000);
                
                guide_age = epoch_time - current_date;
                
                console.log("guide_age for guideName is: " + guide_age);
                
            // Display guide details to browser
            // Insert guide list at 
            // div id="guideList"
                
            var guideMainList = document.getElementById('guideList');
                    
            // BOOTSTRAP Create a new container for each guide.
            var guideContainer = document.createElement('div');
            guideContainer.className = "container";
            // BOOTSTRAP Create the guide heading.
            var guideName = document.createElement('h4');
            var guideGender = document.createElement('text');
            var guideActivityLevel = document.createElement('text');
            var guideMobilityLevel = document.createElement('text');
            var guideImage = document.createElement('h4');
                
            // Guide ID
            //guideId.innerText = guideDict[i][0];
            
            // Guide Name
            guideName.innerText = guideDict[i][1];
        
            // Guide Gender
            guideGender.innerText = guideDict[i][4];

            // Guide Activity Level
            guideActivityLevel.innerText = guideDict[i][5];
                
            // Guide Mobility Level
            guideMobilityLevel.innerText = guideDict[i][6];
            guideMobilityLevel.innerText = guideDict[i][6];
            
            guideImage.innerHTML = "<IMG SRC='guideDict[i][3]' ALT='guideDict[i][1]'>"
                
            guideContainer.appendChild(guideName);
            guideContainer.appendChild(guideGender);
            guideContainer.appendChild(guideActivityLevel);
            guideContainer.appendChild(guideMobilityLevel);
            guideContainer.appendChild(guideImage);

            // Append to page
            guideMainList.appendChild(guideContainer);
                    
            }  
        }     
    });
     
}