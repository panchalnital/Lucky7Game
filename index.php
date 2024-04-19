<!DOCTYPE html>
<html>
<head>
    <title>Lucky 7 Game</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#playButton").click(function(){
                var betType = $("input[name='bet']:checked").val();
                $.ajax({
                    url: "Lucky7Game/src/play.php",
                    type: "POST",
                    data: { bet: betType },
                    success: function(response){
                        $("#result").html(response);
                        $("#balance").load("Lucky7Game/src/get_balance.php");
                        $("#resetButton").show();
                        $("#continueButton").show();
                        $("#playButton").hide();
                    }
                });
            });

            $("#resetButton").click(function(){
                $.ajax({
                    url: "Lucky7Game/src/reset.php",
                    type: "POST",
                    success: function(){
                        $("#balance").load("Lucky7Game/src/get_balance.php");
                        $("#result").empty();
                        $("input[name='bet']").prop('checked', false);
                        $("#resetButton").hide();
                        $("#continueButton").hide();
                        $("#playButton").show();
                    }
                });
            });

            $("#continueButton").click(function(){
                $("#result").empty();
                $("input[name='bet']").prop('checked', false);
                $("#resetButton").hide();
                $("#continueButton").hide();
                $("#playButton").show();
            });
        });
    </script>
</head>
<body>
    <h2> Design a Lucky 7 game using PHP and HTML</h2>
    <p>Current Balance: <span id="balance"><?php include "Lucky7Game/src/get_balance.php"; ?></span> Rs</p>
    <p>Place your bet:</p>
    <input type="radio" name="bet" value="below7"> Below 7<br>
    <input type="radio" name="bet" value="lucky7"> Lucky 7<br>
    <input type="radio" name="bet" value="above7"> Above 7<br>
    <button id="playButton">Play</button>
    <button id="resetButton" style="display: none;">Reset</button>
    <button id="continueButton" style="display: none;">Continue</button>
    <div id="result"></div>
</body>
</html>
