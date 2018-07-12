var urlParams = new URLSearchParams(window.location.search);
var cityId = urlParams.get('cityId');

window.onload = function () {

    getGuides();
  
}
    
function getGuides() {

    var guideDict = [];
    
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
                // var cityName = object["GUIDES"][i]['city_name'];

                //guideDict.push([guideId, guideName, guideHome, imagePath, gender, activityLevel, mobilityLevel, dietaryRestrictions]);
                
                guideDict.push([guideId, guideName, guideHome, imagePath, gender, activityLevel, mobilityLevel]);

                
                // Calculate guide's age, by getting current time & 
                // subtracting guide's D.O.B. from current_time
                //var current_date = new Date();
                //epoch_time = (current_date.getTime() / 1000);
                //guide_age = epoch_time - current_date;
                //console.log("guide_age for guideName is: " + guide_age);
                
                // Display guide details to browser
                // Insert guide list at 
                // div id="guideList"
                var guideMainList = document.getElementById('guideList');
                    
                //var guideAttributes = document.getElementById('guideAttributes');
                
                // BOOTSTRAP Create a new container for each guide.
                var guideContainer = document.createElement('div');
                guideContainer.className = "card";
                var guideBody = document.createElement('div');
                guideBody.className = "card-body";
                // BOOTSTRAP Create the guide heading.
                var guideName = document.createElement('h5');
                guideName.className = "card-title";
                var infoList = document.createElement('ul');
                infoList.className = "list-group list-group-flush";
                var guideGender = document.createElement('li');
                guideGender.className = "list-group-item";
                var guideActivityLevel = document.createElement('li');
                guideActivityLevel.className = "list-group-item";
                var guideMobilityLevel = document.createElement('li');
                guideMobilityLevel.className = "list-group-item";
                var guideBtnGroup = document.createElement('li');
                guideBtnGroup.className = "list-group-item";

                var guideBreak = document.createElement('br');

                var acceptBtn = document.createElement('button');
                acceptBtn.className = "btn btn-success";
                acceptBtn.innerText = "Request";
                acceptBtn.style.marginRight = "2%";
                acceptBtn.onclick = function() {
                    gotoPayment()
                };

                var declineBtn = document.createElement('button');
                declineBtn.className = "btn btn-danger";
                declineBtn.innerText = "Dismiss";
                acceptBtn.style.marginRight = "2%";

                guideBtnGroup.appendChild(acceptBtn);
                guideBtnGroup.appendChild(declineBtn);

                // Guide ID
                //guideId.innerText = guideDict[i][0];
            
                // Guide Name
                var guideImagePath = guideDict[i][3];

                guideName.innerHTML = "<img width='75px' height='75px' style='margin-right: 2%' class='rounded-circle' src=\'" + guideImagePath + "\' alt=\'" + guideDict[i][1] + "\'>" + guideDict[i][1];
        
                // Guide Gender
                guideGender.innerHTML = "<b>Gender: </b>" + guideDict[i][4];

                // Guide Activity Level
                guideActivityLevel.innerHTML = "<b>Activity Level: </b>" + guideDict[i][5];
                
                // Guide Mobility Level
                guideMobilityLevel.innerHTML = "<b>Mobility Level: </b>" + guideDict[i][6];
                
                infoList.appendChild(guideGender);
                infoList.appendChild(guideActivityLevel);
                infoList.appendChild(guideMobilityLevel);
                infoList.appendChild(guideBtnGroup);
                guideBody.appendChild(guideName);

                guideContainer.appendChild(guideBody);
                guideContainer.appendChild(infoList);

                // Append to page
                guideMainList.appendChild(guideContainer);
                guideMainList.appendChild(guideBreak);

            }  
        }     
    });
}

function gotoPayment() {
    window.location = "epay.php";
}