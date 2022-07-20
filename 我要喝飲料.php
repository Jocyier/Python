
<!DOCTYPE html>
<html lang="zh-tw">
  <head>
  <?php include '功能列.php'; ?>
   </head>
   <body>
    <!--大圖-->
	<br>
   <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
   <div class="carousel-inner">
    <div class="carousel-item active">
       <center> <img src="圖片庫/環保杯.jpg" width="800" ></center>
    </div>
  </div>
</div>
   
   <br>
   <br>
  
<form class="form-inline row"
  class="dropdown">
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <button class="btn btn-outline-secondary dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    優惠方式
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">現金優惠</a>
    <a class="dropdown-item" href="#">飲料加量</a>
    <a class="dropdown-item" href="#">集點方式</a>
  </div>
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
   <!--定位功能-->
  <button type="button" class="btn btn-outline-secondary">附近飲料<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cursor-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103z"/>
</svg><input type="button" value="搜尋附近飲料" onclick="location.href='map.php'"></button> 



&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<!--查詢功能-->
<div class="form-group mx-sm-3 mb-2">
    <label for="inputPassword2" class="sr-only">店家名稱</label>
    <input type="name" class="form-control" id="storename" placeholder="店家名稱...">
    &nbsp<button type="submit" class="btn btn-outline-success mb-2 ">查詢  </button>
  </div>
</form>

<br>
<br>
<br>
<br>
<br>
<br>
<center><img src="圖片庫/動物謝謝5.png" width="500" ></center>
   </body>
   </html>
   