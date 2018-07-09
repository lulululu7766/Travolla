    // Init Map
    var map, geolocation;
    map = new AMap.Map('container', {
        zoom: 13,
        resizeEnable: true
    });

    // Add Toolbar Plugin to the map
    map.plugin(['AMap.ToolBar'], function () {
        // Set self-defined mark
        var toolBar = new AMap.ToolBar();
        map.addControl(toolBar);
    });