<html>
<head>
	<title>Farm Game</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="css/sweetalert.css" rel="stylesheet">
	<script src="js/sweetalert.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
	.game-body{
		
			 background: url(images/farm_pic.jpg) no-repeat center center fixed; 
			-webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
	}
	.game_title{
		margin-left:36%;
		font-family: "Times New Roman", Times, serif;
	}

	#start_btn,#feed_btn,#finish_btn{
		margin-top: 200px;
		margin-left:45%;
		border:2px solid #000;
	}
</style>
</head>
<body class="game-body">
	<h2 class="game_title"><mark style="color:#000;">Welcome To The Farm Game !</mark></h2>
<div>
<form name="farm_game" method="POST">
<button type="button" class="btn btn-success btn-lg" name="start_btn" id="start_btn" data-toggle="modal" data-target="#myModal">Start Game !</button>
<button type="button" class="btn btn-warning btn-lg" name="feed_btn" id="feed_btn" onclick="PerformGame();">Start Feeding</button>
<button type="button" class="btn btn-danger btn-lg" name="finish_btn" id="finish_btn" onclick="RestartGame();">Finish Game !</button>
</form>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
         <div class="modal-content">
        <div class="modal-header">          
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">The Game & it's Rules</h4>
        </div>
        <div class="modal-body">
          <p><b>Rule 1:</b> If your Farmer Dies, Your game's over !</p>
          <p><b>Rule 2:</b> Selection of each animal is totally random by the system !</p>
          <p><b>Rule 3:</b> It's a Game of 50 clicks. Let's see if your farmer and animal of each type lives till the end !</p>
          <p><b>Rule 4:</b> You are playing this game with a Farmer, 2 Cows and 4 Bunnies !</p>
          <p><b>Rule 5:</b> The system will notify you when your animal dies in between your gameplay !</p>
        </div> 
      </div>
      
    </div>
  </div>
	<script>
		$(document).ready(function(){

			$("#feed_btn").hide();
			$("#finish_btn").hide();

			$("#start_btn").click(function(){
				$("#start_btn").hide();
				$("#feed_btn").show();

			});
		});

		function RestartGame()
		{
			location.reload();
		}

		var i=0;
			function PerformGame()
			{
				i++;
				$.ajax({					
					url: 'perform_game.php',
                    type: "POST",
                    data: {'button_clicked': i},
					dataType: 'json',
                    async: false,

                    success: function(data) {
     
                       if(data == "MAX_CLICK_LOSE")
                       {
                       	swal({title: "Game Over !", text: "Maximum Clicks Reached. You Lose !", type: "error"});
                       	$("#feed_btn").hide();
						$("#finish_btn").show();
                       }
                       if(data == "MAX_CLICK_WON")
                       {
                        swal({title: "Wow !",text: "Maximum Clicks Reached. You Won !",type: "success"});
                        $("#feed_btn").hide();
						$("#finish_btn").show();
                       }
                       if(data == "HARD_LUCK_DIED")
                       {
                        swal({title: "Dead !",text: "Hard Luck ! One or Some animal(s) died.",type: "warning"});
                       }
                       if(data == "FARMER_DEAD_LOSE")
                       {
                       	swal({title: "Game Over !", text: "Your Farmer Died ! You Lose !", type: "error"});
                       	$("#feed_btn").hide();
						$("#finish_btn").show();
                       }

                    }
                });
			}	
	</script>
</body>
</html>