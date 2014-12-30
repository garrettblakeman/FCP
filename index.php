<?php
/**
 * Created by PhpStorm.
 * User: garrettblakeman
 * Date: 12/29/14
 *
 */
require_once('./includes.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Favorite Color Picker</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/jumbotron.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body <?php if(isset($_SESSION['newColor'])) { ?> style="background-color:#<?php echo $_SESSION['newColor'];?>"<?php } ?>>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">FCP</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

        </div><!--/.navbar-collapse -->
    </div>
</nav>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron" id="feature" <?php if(isset($_SESSION['hex1'])) { ?> style="background-color:#<?php echo $_SESSION['hex1'];?>"<?php } ?>>
    <div class="container">
        <h1><?php if(isset($_SESSION['name'])) { echo 'Hi ' . $_SESSION['name'] . '!'; } else {?>What's your favorite color?<?php } ?></h1>
        <p>This is just a sample of data storage, retrieval and some other things.</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8" id="leftHome" <?php if(isset($_SESSION['hex2'])) { ?> style="background-color:#<?php echo $_SESSION['hex2'];?>"<?php } ?>>
            <h2><?php if(isset($_SESSION['name'])) {?>Change your mind?<?php } else { ?>Choose Your Favorite Colors<?php } ?></h2>
            <form id="colorForm" action="form-process.php" method="POST">
                <div id="colorDrop1-group" class="form-group">
                    <label for="colorDrop1">Select first color:</label>
                    <select name="colorDrop1" class="form-control" id="colorDrop1">
                        <option disabled="disabled" selected="selected"> </option>
                        <?php getColorSelect()?>
                    </select>
                </div>
                <div id="colorDrop2-group" class="form-group">
                    <label for="colorDrop2">Select second color:</label>
                    <select name="colorDrop2" class="form-control" id="colorDrop2">
                        <option disabled="disabled" selected="selected"> </option>
                        <?php getColorSelect()?>
                    </select>
                </div>
                <div id="name-group" class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" <?php if(isset($_SESSION['name'])) {
                    echo 'value="' . $_SESSION['name'] . '"';}?> id="name">
                </div>
                <button type="submit" class="btn btn-success">Submit <span class="fa fa-arrow-right"></span></button>

            </form>
        </div>
        <div class="col-md-4" id="rightHome">
            <h2>Most Picked Colors:</h2>
            <?php getTopColors() ;?>
        </div>
    </div>

    <hr>

    <footer>
        <p>&copy; Garrett Blakeman 2014</p>
    </footer>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/color/jquery.color-2.1.2.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/fcp.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="./js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>