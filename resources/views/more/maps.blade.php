<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
    <title>MAPS</title>
    <style>

    </style>
</head>
<body>
	<div id="map" style="width:1000px;height:1000px;"></div>
	<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=2c95436371fe2b214c00944d71b32514"></script>
	<script>
		var container = document.getElementById('map');
		var options = {
			center: new daum.maps.LatLng(33.450701, 126.570667),
			level: 3
		};

		var map = new daum.maps.Map(container, options);
	</script>
</body>
</html>