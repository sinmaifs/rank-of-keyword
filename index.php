<!DOCTYPE html>
<html lang="zh-TW">
<head>
<title>Keyword Rank Search</title>
<meta charset="UTF-8" />
<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="css/style.css" rel="stylesheet"/>
</head>
<body>
<div class="container">
	<div class="form-container sign-in-container">
		<form action="#">
			<h1>Key in!</h1>
			<span>Enter information</span>
			<input type="text" id="kk" placeholder="Keyword" value="" />
			<input type="text" id="uu" placeholder="Url" value="" />
			<img id="aj" src="img/ajax.gif" />
			<div id="aj2">Searching..</div>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
				<h1>[ Keyword Search ]</h1>
				<p>輸入關鍵字與網址，鍵入Enter即可查詢。</p>
				<p id="si"></p>
			</div>
		</div>
	</div>
</div>
<script src="js/k.js"></script>
</body>
</html>