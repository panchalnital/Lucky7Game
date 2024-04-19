<?php
session_start();

// Check if the bet type is set and user has enough balance
// echo "<pre>";
if(empty($_SESSION['balance'])){
    $_SESSION['balance']=$_POST['balance'];
}

if(isset($_POST['bet']) || $_SESSION['balance'] >= 10) {
    $betType = $_POST['bet'];
    $dice1 = rand(1, 6);
    $dice2 = rand(1, 6);
    $sum = $dice1 + $dice2;
    $balance = $_SESSION['balance'] - 10;
    //print_r($_SESSION);
    // Determine outcome
    if(($betType == 'below7' && $sum < 7) ||
       ($betType == 'above7' && $sum > 7) ||
       ($betType == 'lucky7' && $sum == 7)) {
        //echo "in";
        $balance += 20;
        if($betType == 'lucky7') {
            $balance += 10; 
        }
        $message = "Congratulations! You won.";
    } else {
        //echo "out";
        $message = "Sorry, you lost.";
    }

    $_SESSION['balance'] = $balance;
    echo "<p>Sum :  $sum</p>";
    echo "<p>$message</p>";
    echo "<p>New Balance: $balance Rs</p>";
} else {
    echo "Insufficient balance or invalid bet type.";
}

?>