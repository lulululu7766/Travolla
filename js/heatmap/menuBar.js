window.onload = function () {

    // 1 - Heat Map
    if (!isSupportCanvas()) {
        alert('热力图仅对支持canvas的浏览器适用,您所使用的浏览器不能使用热力图功能,请换个浏览器试试~')
    }

    //详细的参数,可以查看heatmap.js的文档 https://www.patrick-wied.at/static/heatmapjs/docs.html
    //参数说明如下:
    /* visible 热力图是否显示,默认为true
     * opacity 热力图的透明度,分别对应heatmap.js的minOpacity和maxOpacity
     * radius 势力图的每个点的半径大小   
     * gradient  {JSON} 热力图的渐变区间 . gradient如下所示
     *  {
     .2:'rgb(0, 255, 255)',
     .5:'rgb(0, 110, 255)',
     .8:'rgb(100, 0, 255)'
     }
     其中 key 表示插值的位置, 0-1 
     value 为颜色值 
     */

    var heatmap;
    map.plugin(["AMap.Heatmap"], function () {
        //初始化heatmap对象
        //Init heatmap Object
        heatmap = new AMap.Heatmap(map, {
            radius: 25, //给定半径 Set radius
            opacity: [0, 0.8]
            /*,gradient:{
             0.5: 'blue',
             0.65: 'rgb(117,211,248)',
             0.7: 'rgb(0, 255, 0)',
             0.9: '#ffea00',
             1.0: 'red'
             }*/
        });
        //设置数据集：该数据为中国所有美食餐厅
        //Data: Restraunts in China
        heatmap.setDataSet({
            data: heatmapData,
            max: 100
        });
    });
    // 判断浏览区是否支持canvas
    // Check the browser if it supports canvas
    function isSupportCanvas() {
        var elem = document.createElement('canvas');
        return !!(elem.getContext && elem.getContext('2d'));
    }

    var fire_btn = document.getElementsByClassName("fa-hotjar")[0];
    fire_btn.addEventListener('click', function () {
        if (fire_btn.style.color == "darkorange") {
            fire_btn.style.color = "black";
            heatmap.hide();
        } else {
            fire_btn.style.color = "darkorange";
            heatmap.show();
        }
    })

    // 2 - Search

    var search_btn = document.getElementsByClassName("fa-search")[0];
    search_btn.addEventListener('click', function () {
        if (search_btn.style.color != "lightblue") {
            search_btn.style.color = "lightblue";
            document.getElementById("myPageTop").style.visibility = "visible";
        } else {
            search_btn.style.color = "black";
            document.getElementById("myPageTop").style.visibility = "hidden";
        }
    })
    //输入提示
    var autoOptions = {
        input: "tipinput"
    };
    var auto = new AMap.Autocomplete(autoOptions);
    var placeSearch = new AMap.PlaceSearch({
        map: map
    }); //构造地点查询类
    AMap.event.addListener(auto, "select", select); //注册监听，当选中某条记录时会触发
    function select(e) {
        placeSearch.setCity(e.poi.adcode);
        placeSearch.search(e.poi.name); //关键字查询查询
    }


    // 3 - Locate
    map.plugin('AMap.Geolocation', function () {
        geolocation = new AMap.Geolocation({
            enableHighAccuracy: true,
            timeout: 10000, //超过10秒后停止定位，默认：无穷大
            showButton: false,
            zoomToAccuracy: true, //定位成功后调整地图视野范围使定位位置及精度范围视野内可见，默认：false
        });

        var locate_btn = document.getElementsByClassName("fa-location-arrow")[0];
        locate_btn.addEventListener('click', function () {
            map.addControl(geolocation);
            geolocation.getCurrentPosition();
              AMap.event.addListener(geolocation, 'complete', onComplete);
              AMap.event.addListener(geolocation, 'error', onError);
        })
    });

    // Analyze Results
    function onComplete(data) {
        var str = ['Located Succeed!'];
        str.push('Lng: ' + data.position.getLng());
        str.push('Lat: ' + data.position.getLat());
        if (data.accuracy) {
            str.push('Accuracy:' + data.accuracy + ' m');
        } //如为IP精确定位结果则没有精度信息
        str.push('Offset: ' + (data.isConverted ? 'Yes' : 'No'));
        document.getElementById('tip').innerHTML = str.join('<br>');
    }
    // Analyze Error
    function onError(data) {
        document.getElementById('tip').innerHTML = 'Located Failed';
    }

    var info_btn = document.getElementsByClassName("fa-info-circle")[0];
    info_btn.addEventListener('click', function () {
        if (info_btn.style.color != "lightblue") {
            info_btn.style.color = "lightblue";
            document.getElementById("tip").style.visibility = "visible";
        } else {
            info_btn.style.color = "black";
            document.getElementById("tip").style.visibility = "hidden";
        }
    })



    // 4 - Road Condition Layer
    var trafficLayer = new AMap.TileLayer.Traffic({
        zIndex: 10
    });
    trafficLayer.setMap(map);
    var road_btn = document.getElementsByClassName("fa-road")[0];
	
    var isVisible = false;
    trafficLayer.hide();

    AMap.event.addDomListener(road_btn, 'click', function() {
        if (isVisible) {
            trafficLayer.hide();
            road_btn.style.color = "black";
            isVisible = false;
        } else {
            trafficLayer.show();
            road_btn.style.color = "red";
            isVisible = true;
        }
    }, false);


    // 5 - Satellite Layer

    var satelliteLayer = new AMap.TileLayer.Satellite({
        zIndex: 10
    });
    satelliteLayer.setMap(map);
    var satellite_btn = document.getElementsByClassName("fa-globe-americas")[0];
	
    var isVisible = false;
    satelliteLayer.hide();
    AMap.event.addDomListener(satellite_btn, 'click', function() {
        if (isVisible) {
            satelliteLayer.hide();
            satellite_btn.style.color = "black";
            isVisible = false;
        } else {
            satelliteLayer.show();
            satellite_btn.style.color = "red";
            isVisible = true;
        }
    }, false);

}
