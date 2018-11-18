<html>
<head>
	<title>Farm Game</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
	.game-body{
		
			background: url(farm_image.jpeg) no-repeat center center fixed;
			-webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
	}
	.game_title{
		margin-left:40%;
	}

	#start_btn,#feed_btn,#finish_btn{
		margin-top: 200px;
		margin-left:45%;
	}
</style>
</head>
<body class="game-body">
	<h3 class="game_title"><mark>Welcome To Farm Game !</mark></h3>
<form name="farm_game" method="POST">
<button type="button" class="btn btn-success btn-lg" name="start_btn" id="start_btn">Start Game !</button>
<button type="button" class="btn btn-warning btn-lg" name="feed_btn" id="feed_btn" onclick="PerformGame();">Let's Feed Now</button>
<button type="button" class="btn btn-danger btn-lg" name="finish_btn" id="finish_btn">Finish Game !</button>
</form>

	<script>
		$(document).ready(function(){

			$("#feed_btn").hide();
			$("#finish_btn").hide();

			$("#start_btn").click(function(){
				$("#start_btn").hide();
				$("#feed_btn").show();

			});
		});
		var i=0;
			function PerformGame()
			{
				i++;
				$.ajax({
					url: 'perform_game.php',
                    type: "POST",
                    data: {'button_clicked': i},
					dataType: 'json',
                    
                    success: function(data) {
                        
                        alert(data);


                    }
                });
			}

	
	</script>
</body>
</html>