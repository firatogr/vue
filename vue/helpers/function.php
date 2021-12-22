<?php

function autoHeader () {
    !isset($_POST['just_content']) ? require 'views/static/header.php' : null;

}

function autoFooter () {
    !isset($_POST['just_content']) ? require 'views/static/footer.php' : null;

}

?>