<!DOCTYPE html>
<html>

<head runat="server">
    <title>map</title>
    <script src='http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.js'></script>   
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKQZetHmdKCxavbYvwQgGIBHguIJUG_Yk"
      defer
    ></script>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  
    <style>
        body,input { font-size: 9pt; }
        html { height: 100% }  
        body { height: 70%; margin: 30px; padding: 30px }  
        #map_canvas { height: 50% }        
    </style>

    

    <script>

        
        $(function () 
            {
            //定義經緯度位置: 以大同大學校園為例
            var latlng = new google.maps.LatLng(25.068147, 121.520622);
            //設定地圖參數
            var mapOptions = 
            {
                zoom: 16, //初始放大倍數
                center: latlng, //中心點所在位置
                mapTypeId: google.maps.MapTypeId.ROADMAP //正常2D道路模式
            };
            //在指定DOM元素中嵌入地圖
            var map = new google.maps.Map(
                document.getElementById("map_canvas"), mapOptions);
            //加入標示點(Marker)
            var marker = new google.maps.Marker
            (
                {
                position: latlng, //經緯度
                title: "大同大學", //顯示文字
                map: map //指定要放置的地圖對象
                }
            );
           
            
            }
           
        );
        
    </script>
</head>
<body> <!-- 地圖版面切版 -->
<div id="map_canvas" style="width:50%; height:100%"></div>
</body>
</html>