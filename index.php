<html>

<head>
    <title>Farm Game</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/sweetalert.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="js/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .game-body {
            background: url(images/farm_pic.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        
        .game_title {
            margin-left: 36%;
            font-family: "Times New Roman", Times, serif;
        }
        
        #start_btn,
        #feed_btn,
        #result_btn,
        #finish_btn {
            margin-top: 180px;
            margin-left: 45%;
            border: 2px solid #000;
        }
        
        .animals_list {
            background-color: white;
            width: 600px;
        }
        
        .imp_note {
            color: red;
        }
    </style>
</head>

<body class="game-body">
    <h2 class="game_title"><mark style="color:#000;">Welcome To The Farm Game !</mark></h2>
    <br>
    <br>
    <form name="farm_game" method="POST">
        <center>
            <div class="animals_list"><i style="color:green;" class="fa fa-pied-piper-alt"></i> Farmer&nbsp;&nbsp;<i style="color:green;" class="fa fa-eye" id="cow1_img"></i> Cow1&nbsp;&nbsp;<i style="color:green;" class="fa fa-eye" id="cow2_img"></i> Cow2&nbsp;&nbsp;<i style="color:green;" class="fa fa-paw" id="bunny1_img"></i> Bunny1&nbsp;&nbsp;<i style="color:green;" class="fa fa-paw" id="bunny2_img"></i> Bunny2&nbsp;&nbsp;<i style="color:green;" class="fa fa-paw" id="bunny3_img"></i> Bunny3&nbsp;&nbsp;<i style="color:green;" class="fa fa-paw" id="bunny4_img"></i> Bunny4</div>
        </center>
        <button type="button" class="btn btn-success btn-lg" name="start_btn" id="start_btn" data-toggle="modal" data-target="#myModal">Start Game !</button>
        <button type="button" class="btn btn-warning btn-lg" name="feed_btn" id="feed_btn" onclick="PerformGame();">Feed Them !</button>
        <button type="button" class="btn btn-info btn-lg" name="result_btn" id="result_btn" onclick="GetResults();">Show Results</button>
        <button type="button" class="btn btn-danger btn-lg" name="finish_btn" id="finish_btn" onclick="RestartGame();">Finish Game !</button>
    </form>

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
                    <p class="imp_note"><b>NOTE:</b> <i> Below the main heading, all your alive animals are shown. Once they die during your gameplay, it will become red.</i></p>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function() {

            $("#feed_btn").hide();
            $("#finish_btn").hide();
            $("#result_btn").hide();

            $("#start_btn").click(function() {
                $("#start_btn").hide();
                $("#feed_btn").show();

            });
        });
        /* Below is the function for getting the results after the game's over */

        function GetResults() {
            $.ajax({
                url: 'perform_game.php',
                type: "POST",
                data: {
                    'get_results': true
                },
                dataType: 'json',
                async: false,

                success: function(response) {
                    alert(response);
                }
            });
        }
        /* Below is the function for finish the game and reload the new game */

        function RestartGame() {
            $.ajax({
                url: 'perform_game.php',
                type: "POST",
                data: {
                    'end_result_session': true
                },
                dataType: 'json',
                async: false,

                success: function(returned) {
                    location.reload();
                }
            });
        }
        /* Below is a function for all the functioning of the game  */

        var i = 0;

        function PerformGame() {
            i++;
            $.ajax({
                url: 'perform_game.php',
                type: "POST",
                data: {
                    'button_clicked': i
                }, // "i" is for monitoring no of times button clicked(max-50)
                dataType: 'json',
                async: false,

                success: function(data) {
                    /* below is the code to check and print when user reaches maximum click and and game criteria not met */
                    if (data == "MAX_CLICK_LOSE") {
                        swal({
                            title: "Game Over !",
                            text: "Maximum Clicks Reached. You Lose !",
                            type: "error"
                        });
                        $("#feed_btn").hide();
                        $("#result_btn").show();
                        $("#finish_btn").show();
                    }
                    /* below is the code to check and print when user reaches maximum click and and game criteria is met */
                    if (data == "MAX_CLICK_WON") {
                        swal({
                            title: "Wow !",
                            text: "Maximum Clicks Reached. You Won !",
                            type: "success"
                        });
                        $("#feed_btn").hide();
                        $("#result_btn").show();
                        $("#finish_btn").show();
                    }
                    /* below is the code to check and print when one/some of the animals gets died and to show red in the animals bar  */
                    if (data == "HARD_LUCK_DIED") {
                        swal({
                            title: "Dead !",
                            text: "Hard Luck ! One or Some animal(s) died.",
                            type: "warning"
                        });

                        $.ajax({
                            url: 'perform_game.php',
                            type: "POST",
                            data: {
                                'check_animals': true
                            },
                            dataType: 'json',
                            async: false,
                            /* In the success block of ajax the main logic of making animals red in animals bar is written */
                            success: function(check_animal) {

                                var obj = check_animal;
                                for (var key in obj) {
                                    if (obj[key] == 'Farmer') {
                                        $(".fa-pied-piper-alt").css("color", "red");
                                    } else if (obj[key] == 'Cow1') {
                                        $("#cow1_img").css("color", "red");
                                    } else if (obj[key] == 'Cow2') {
                                        $("#cow2_img").css("color", "red");
                                    } else if (obj[key] == 'Bunny1') {
                                        $("#bunny1_img").css("color", "red");
                                    } else if (obj[key] == 'Bunny2') {
                                        $("#bunny2_img").css("color", "red");
                                    } else if (obj[key] == 'Bunny3') {
                                        $("#bunny3_img").css("color", "red");
                                    } else if (obj[key] == 'Bunny4') {
                                        $("#bunny4_img").css("color", "red");
                                    } else {

                                    }

                                }

                            }

                        });

                    }
                    /* below is the code to check and print when farmer is dead in between the game and have to stop the game and will start a new game */
                    if (data == "FARMER_DEAD_LOSE") {
                        swal({
                            title: "Game Over !",
                            text: "Your Farmer Died ! You Lose !",
                            type: "error"
                        });
                        $(".fa-pied-piper-alt").css("color","red");
                        $("#feed_btn").hide();
                        $("#result_btn").show();
                        $("#finish_btn").show();
                    }

                }
            });
        }
    </script>
</body>

</html>