<html>
<head>
	<title>Farm Game</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<style>
	.game-body{
		background-color: AED264;
	}
</style>
</head>
<body class="game-body">
<form name="farm_game" method="POST">
<button type="button" name="start_btn" id="start_btn">Start Game !</button>
<button type="button" name="feed_btn" id="feed_btn" onclick="PerformGame();">Let's Feed Now</button>
<button type="button" name="finish_btn" id="finish_btn">Finish Game !</button>
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