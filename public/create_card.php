<?php
    include('../db.php');
    include('../includes/create_card.inc.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script>

        function gotkey() {
            var count = document.getElementById("postMessage").value.length;

            if (count > 280) {
                var output = "Sorry";
                count;
            } else {
                var output = "Character count: " + count + " of " + 280;
            }
            document.getElementById("status").innerHTML = output;
        }


    </script>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<!--    <link rel="stylesheet" type="text/css" href="assets/CSS/dashboard_style.css">-->
    <!--    <link rel="stylesheet" href="assets/CSS/profile_avatar.css"/>-->
<!--    <link rel="shortcut icon" type="image/x-icon" href="assets/images/Monogram.png">-->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <title>Twitter</title>
</head>
<body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

<div>
    <div class="account">
        <p><?php echo "Hello, " . $_SESSION['username'] ?></p>
    </div>
</div>

<div id="container">
    <div class="full-nav">

        <div class="publish">
            <form method="post" action="../includes/create_card.inc.php" enctype="multipart/form-data">
                <div class="twitter boxContainer">
                    <div class="twitter boxContainer">
                        <label class="twitter tweetHeader">Compose new Tweet</label>
                        <span class="close"></span>
                        <div class="lineSplit"></div>
                        <div><textarea class="messageBox" id="postMessage" name="description" onkeyup="gotkey()" placeholder="What's happening?"></textarea></div>
                        <input type="hidden" name="MAX_FILE_SIZE" value="300000">
<!--                        <input name="image"-->
<!--                               accept="image/jpeg,image/png,image/webp,image/gif,video/mp4,video/quicktime" multiple=""-->
<!--                               tabindex="-1" type="file" data-focusable="true">-->
                        <input type="file" class="form-control" name="image" id="profile_picture"
                               placeholder="Profile Picture">

                        <input type="submit"
                                  style="background-image: url(https://lh3.googleusercontent.com/CpBwweN6YgNQGK_9LRvXKI8KEEcnMORDQGXj3XazCsK_dWlp-HzUT7YF5h7gEWP1yQ48=w300)"
                                  class="post_Button" id="submit_Post" name="submit" value="Tweet">
            </form>


            <label class="wordCounter" id="status"></label>
            <div aria-haspopup="false" aria-label="Add photos or video" role="button" data-focusable="true" tabindex="0"
                 class="css-18t94o4 css-1dbjc4n r-1niwhzg r-42olwf r-sdzlij r-1phboty r-rs99b7 r-1w2pmg r-1vuahiu r-mvpalk r-1imd94c r-1vuscfd r-53xb7h r-mk0yit r-o7ynqc r-6416eg r-lrvibr">
                <div dir="auto"
                     class="css-901oao r-1awozwy r-13gxpu9 r-6koalj r-18u37iz r-16y2uox r-1qd0xha r-a023e6 r-vw2c0b r-1777fci r-eljoum r-dnmrzs r-bcqeeo r-q4m81j r-qvutc0">
                    <span class="css-901oao css-16my406 css-bfa6kz r-1qd0xha r-ad9z0x r-bcqeeo r-qvutc0"></span>
                </div>
            </div>

        </div>
    </div>
    </form>
    <br>
</div>