<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	
	<style>
		html, body {
			height: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
			background-color: #ddd;
			-webkit-user-select: none;
					user-select: none;
		}

		.title {
			font-family: 'HelveticaNeue-Thin';
			color: #444;
			font-weight: 300;
			font-size: 72px;
			letter-spacing: 0.2em;
			cursor: default;
		}
	</style>
</head>
<body>
	
	<main class="center">
		<h1 class="title"><?= $title ?></h1>
	</main>
	
</body>
</html>
