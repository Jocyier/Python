<!DOCTYPE html>
<html>
<head>
<!-- 
    Auther: WuTingZhen
    Date:   2019/09/01
-->
<style>
    .listItem {
        border: 1px solid;
        border-radius: 8px;
        text-indent: 15px;
        margin-bottom: 5px;
    }
    
    .listItem:hover {
        background-color: yellow;
    }
    
    .listItem:active {
        background-color: orange;
    }
    
    #googleMap {
        display: inline-block;
        width: 54%;
        min-width: 450px;
        height: 600px;
        vertical-align: top;
    }
    
    .list {
        display: inline-block;
        width: 45%;
        min-width: 450px;
        box-sizing: border-box;
        border: 1px solid;
        border-radius: 8px;
        height: 600px;
        padding: 5px;
    }
    
    .title {
        width: 100%;
        min-width: 450px;
        box-sizing: border-box;
        text-align: center;
        padding-bottom: 5px;
    }
    
    #resultList {
        width: 100%;
        display: inline-block;
        box-sizing: border-box;
        height: 535px;
        overflow-y: auto;
    }
</style>


</head>

<body>
<div id="googleMap"></div>
<div class="list">
    <div class="title">
        餐廳列表
        <div>
            評分：
            <select id="ratingSort">
                <option value="N">無排序</option>
                <option value="L">高至低</option>
                <option value="H">低至高</option>
            </select>
        </div>
    </div>
    <div id="resultList"></div>
</div>
</body>
<script>
    function loadScript(){
        let script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyAKQZetHmdKCxavbYvwQgGIBHguIJUG_Yk&callback=initialize&libraries=places";
        document.body.appendChild(script);
    }
    
    window.onload = loadScript;
    
    function initialize(){
        //初始化地圖 瀏覽器找出經緯度
        let map, lat, lng, location, infowindow,unSortPlaces,sortedPlaces;
        let markers = [];
        let sortVal = "N";
        let initPlaces = true;
        
        if(navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(function(position){
                lat = position.coords.latitude;
                lng = position.coords.longitude;
                location = new google.maps.LatLng(lat, lng);

                let mapProp = {
                    center: location,
                    zoom: 17,//預設縮放比例到街道
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    disableDefaultUI: true
                };
                map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
				
                //建立點擊資訊
                infowindow = new google.maps.InfoWindow();
                
                //評分選單取值
                let ratingSort = document.querySelector('#ratingSort');
                ratingSort.addEventListener('change', function(){
                    sortVal = this.value;
                    if(sortVal === "N"){
                        searchCallback(unSortPlaces);
                    }else{
                        searchCallback(sortedPlaces);
                    }
                });
                
                //預設查詢附近餐廳
                let request = {
                    location: location,
                    radius: 400,
                    types: ['restaurant', 'food']
                };
				queryPlace(request, map);
                
                //nearbySearch
		function queryPlace(request, map){
                    let ratingSort = document.querySelector('#ratingSort');
                    sortVal = ratingSort.value;
		    service = new google.maps.places.PlacesService(map);
		    service.nearbySearch(request, searchCallback);
		}
				
                //callBack函式
                function searchCallback(places){
                    console.log(places);
                    
                    if(places.length > 0){
                        //點擊新地方同時查詢
                        map.addListener('click', function(e){
                            placeMarkerAndPanTo(e.latLng, map);
                            
                            let request = {
                                location: e.latLng,
                                radius: 400,
                                types: ['restaurant', 'food']
                            };
                            queryPlace(request, map);
                        });
                        
                        //刪除餐廳列表
                        let listDiv = document.querySelector('#resultList');
                        while(listDiv.firstChild) {
                            listDiv.removeChild(listDiv.firstChild);
                        }

                        //刪除所有Marker
                        deleteMarkers();
                        
                        //初始排序
                        if(initPlaces){
                            unSortPlaces = [];
                            places.forEach(function(place,index){
                                unSortPlaces.push(place);
                                console.log(index);
                            });
                            sort(places);
                            sortedPlaces = places;
                            initPlaces = false;
                        }
                        
                        if(sortVal === "L"){
                            //倒序載入列表和Marker
                            for(let i=places.length-1; i>=0; i--){
								place = places[i];
                                createMarker(place);
                                createItem(listDiv, place, i);
                            } 
                        }else if(sortVal === "H"){
                            //正序載入列表和Marker
                            places.forEach(function(place,i){
                                createMarker(place);
                                createItem(listDiv, place, i);
                            });
                        }else{
                            //無序載入列表和Marker
                            places.forEach(function(place,i){
                                createMarker(place);
                                createItem(listDiv, place, i);
                            });
                        }
                    }else{
                        return;
                    }
                }
                
                function createItem(listDiv, place, i){
                    let label = document.createElement("label");
                    let itemDiv = document.createElement("div");
                    let titleP = document.createElement("p");
                    let rating = document.createElement("p");
                    let address = document.createElement("p");
                    let radio = document.createElement("input");
                    
                    itemDiv.setAttribute("class", "listItem");
                    label.setAttribute("for", i);
                    radio.setAttribute("hidden", "hidden");
                    radio.setAttribute("type", "radio");
                    radio.id = i;
                    radio.name = "itemRadio";
                    
                    //列表選定後模擬點擊Marker
                    let rat = place.rating === undefined? "無" : place.rating;
                    radio.addEventListener('change', function(){
                        let radioMarker = markers[this.id];
                        let content = "<h3>"+place.name+"</h3> <div><p>評分："+rat+"</p><p>地址："+place.vicinity+"</p></div>";
                        infowindow.setContent(content);
                        infowindow.open(map, radioMarker);
                        placeMarkerAndPanTo(place.geometry.location, map);
                    });
                    
                    titleP.innerHTML = place.name;
                    rating.innerHTML = "評分："+rat;
                    address.innerHTML = "地址："+place.vicinity;
                    
                    itemDiv.appendChild(titleP);
                    itemDiv.appendChild(rating);
                    itemDiv.appendChild(address);
                    itemDiv.appendChild(radio);
                    label.appendChild(itemDiv);
                    listDiv.appendChild(label);
                }
                
                function createMarker(place){
                    let markerProp = {
                        position: place.geometry.location,
                        map: map,
                        title: place.name,
                    }
                    let marker = new google.maps.Marker(markerProp);
                    markers.push(marker);
                    
                    //點擊Marker
                    marker.addListener('click', function(){
                        let rat = place.rating === undefined? "無" : place.rating;
                        let content = "<h3>"+place.name+"</h3> <div><p>評分："+rat+"</p><p>地址："+place.vicinity+"</p></div>";
                        infowindow.setContent(content);
                        infowindow.open(map, this);
                        placeMarkerAndPanTo(place.geometry.location, map);
                    });
                }
                
                //點擊後該點移到中央
                function placeMarkerAndPanTo(latLng, map){
                  map.panTo(latLng);
                }
                
                //marker塞值
                function setMapOnAll(map) {
                    for (var i = 0; i < markers.length; i++) {
                        markers[i].setMap(map);
                    }
                }

                //移除指定Marker 但不從陣列中刪除
                function clearMarkers() {
                    setMapOnAll(null);
                }
                
                //移除Marker 清空陣列
                function deleteMarkers() {
                    clearMarkers();
                    markers = [];
                }
                
                //使用快速排序
                function sort(places){
                    quickSort(places, 0, places.length-1);
                    
                    function swap(arr, a, b){
                        let c = arr[a];
                        arr[a] = arr[b];
                        arr[b] = c;
                        return arr;
                    }
                    
                    function partition(arr, front, end){
                        let rating = arr[end].rating == undefined? 0 : arr[end].rating;
                        let pivot = rating;
                        let i = front-1;
                        for(let j=front; j<end; j++){
                            if(arr[j].rating<pivot){
                                i++;
                                arr = swap(arr, i, j);
                            }
                        }
                        
                        i++;
                        arr = swap(arr, i, end);
                        return i;
                    }
                    
                    function quickSort(arr, front, end){
                        if(front<end){
                            let pivot = partition(arr, front, end);
                            quickSort(arr, front, pivot-1);
                            quickSort(arr, pivot+1, end);
                        }
                    }
                }
            });

        }else{
            alert('未知錯誤');
        }
    }

</script>
</html>
