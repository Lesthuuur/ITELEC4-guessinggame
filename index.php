<?php


/*
martinez, lesther
allado, aerun,
frias, camille,
postrero, tristan
soria, lyara

 */
session_start();



if (!isset($_SESSION['randomNumber'])) {
    $secretNum = 1;
    $_SESSION['randomNumber'] = $secretNum;
    $_SESSION['tries'] = 3;
}


$message = "";

if (isset($_POST['destroy'])) {
    $message = "Session Destroyed!";
    session_destroy();
}

if (isset($_POST['submit']) == "POST") {
    $user_guess = (int)$_POST['guess'];

    $_SESSION['tries']--;


    if ($user_guess === $_SESSION['randomNumber']) {
        $message = "Congratulations! You guessed it right.";
        session_unset();
    } elseif ($_SESSION['tries'] <= 0) {
        $message = "Sorry, you've run out of tries. The correct number was " . $_SESSION['randomNumber'] . ".";
        session_unset();
    } else {
        $message = "Wrong guess. You have " . $_SESSION['tries'] . " tries left.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guessing Game</title>
</head>

<body>
    <h1>Guessing Game</h1>
    <p>Total number of attempts: <?= isset($_SESSION['tries']) ? $_SESSION['tries'] : 0 ?></p>

    <form action="" method="POST">
        <label for="guess">Enter guess: </label>
        <input type="text" name="guess" id="guess">
        <input type="submit" value="Submit" name="submit">
        <input type="submit" value="Destroy" name="destroy">

    </form>

    <?php if (!empty($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
</body>

</html>

