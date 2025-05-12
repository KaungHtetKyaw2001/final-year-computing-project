<!DOCTYPE html>
<html>
<head>
	<meta name="Viewport" content="width=device-width, initial scale=1.0">
	<title>Kaung Htet Kyaw Gaming and Accessories Store</title>
	<style type="text/css">
		*
		{
			margin: 0;
			padding: 0;
			font-family: sans-serif;
		}
		.container
		{
			width: 100%;
			min-height: 100vh;
			padding-left: 8%;
			padding-right: 8%;
			box-sizing: border-box;
			overflow: hidden;
		}
		.navbar
		{
			width: 100%;
			display: flex;
			align-items: center;
		}
		.logo
		{
			width: 50px;
			cursor: pointer;
			margin: 30px 0;
		}
		.menu-icon
		{
			width: 25px;
			cursor: pointer;
			display: none;

		}
		nav
		{
			flex: 1;
			text-align: right;
		}
		nav ul li
		{
			list-style: none;
			display: inline-block;
			margin-right: 30px;
		}
		nav ul
		{
			text-decoration: none;
			color: #000;
			font-size: 14px;
		}
		nav ul li a:hover
		{
			color: #ff5ea2;
		}
		.row
		{
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin: 100px 0;
		}
		.col-1
		{
			flex-basis: 40%;
			position: relative;
			margin-left: 50px;
		}
		.col-1 h2
		{
			font-size: 54px;
		}
		.col-1 h3
		{
			font-size: 30px;
			color: #707070;
			font-weight: 100;
			margin: 20px 0 10px;
		}
		.col-1 p
		{
			font-size: 16px;
			color: #b7b7b7;
			font-weight: 100;
		}
		.col-1 h4
		{
			margin: 30px 0;
			font-size: 20px;
		}
		button
		{
			width: 140px;
			border: 0;
			padding: 12px 10px;
			outline: none;
			color: #fff;
			background: linear-gradient(to right, #fb5283, #ff3527);
			border-radius: 6px;
			cursor: pointer;
			transition: width 0.5s;
		}
		button img
		{
			width: 30px;
			display: none;
		}
		button:hover img
		{
			display: block;
		}
		button:hover
		{
			width: 160px;
			display: flex;
			align-items: center;
			justify-content: space-between;
		}
		.col-1::after
		{
			content: '';
			width: 10px;
			height: 57%;
			background: linear-gradient( #ff469f, #ff6062);
			position: absolute;
			left: -40px;
			top: 8px;
		}
		.col-2
		{
			position: relative;
			flex-basis: 60%;
			display: flex;
			align-items: center;
		}
		.col-2 .controller
		{
			width: 90%;
		}
		.color-box
		{
			position: absolute;
			right: 0;
			top: 0;
			background: linear-gradient( #ff54a2, #ff575a);
			border-radius: 20px 0 0 20px;
			height: 100%;
			width: 80%;
			z-index: -1;
			transform: translateX(150px);
		}
		.add-btn img
		{
			width: 35px;
			margin-bottom: 5px;
		}
		.add-btn
		{
			text-align: center;
			color: #fff;
			cursor: pointer;
		}
		.social-links img
		{
			height: 13px;
			margin: 20px;
			cursor: pointer;

		}
		.social-links
		{
			text-align: center;
		}
		@media only screen and (max-width:700px)
		{
			nav ul
			{
				width: 100%;
				background: linear-gradient( #ff54a2, #ff575a);
				position: absolute;
				top: 75px;
				right: 0;
				z-index: 2;
			}
			nav ul li
			{
				display: block;
				margin-top: 10px;
				margin-bottom: 10px;
			}
			nav ul li a
			{
				color: #fff;
			}
			.menu-icon
			{
				display: block;
			}
			#menuList
			{
				overflow: hidden;
				transition: 0.5s;
			}
			.row
			{
				flex-direction: column-reverse;
				margin: 50px 0;
			}
			.col-2
			{
				flex-basis: 100%;
				margin-bottom: 50px;
			}
			.col-2 .controller
			{
				width: 77%;
			}
			.color-box
			{
				transform: translateX(75px);
			}
			.col-1
			{
				flex-basis: 100%;
			}
			.col-1 h2 
			{
				font-size: 35px;
			}
			.col-1 h3
			{
				font-size: 15px;
			}
		}
	</style>
</head>
<body>
	<div class="Container">
	<div class="Navbar">
		<img src="images/logo.png" class="logo">
		<nav>
			<ul id="menuList">
				<li><a href="Game Controllers"></a></li>
				<li><a href="VR Accessories"></a></li>
				<li><a href="Media Remotes"></a></li>
				<li><a href="Others"></a></li>
			</ul>
		</nav>
		<img src="images/menu.png" class="menu-icon" onclick="togglemenu()">
	</div>
	<div class="row">
		<div class="col-1">
			<h2>PS4 V2 <br> Dualshock 4</h2>
			<h3>Wireless Controller for Playstation 4</h3>
			<p>(Compatible/Generic)</p>
			<h4>$32.50</h4>
			<button type="button">Buy Now<img src="images.arrow.png"></button>
		</div>
		<div class="col-2">
			<img src="images/contoller.png" class="controller">
			<div class="color-box"></div>
			<div class="add-btn">
				<img src="images/add.png">
				<p><small>Add to Cart</small></p>
			</div>
		</div>
	</div>
	<div class="social-links">
		<img src="images/fb.png">
		<img src="images/tw.png">
		<img src="images/ig.png">
	</div>
</div>

	<script type="text/javascript">
		var menuList = document.getElementbyId("menuList");
		menuList.style.maxHeight="0px";
		function togglemenu()
		{
			if (menuList.style.maxHeight =='0px') 
			{
				menuList.style.maxHeight = '130px';
			}
			else
			{
				menuList.style.maxHeight = '0px';

			}
		}
	</script>
</body>
</html>