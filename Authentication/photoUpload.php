<?php
    $profileimageName = $profileimageExtension = $profileimagePath = $profileimageTarget = "";
    $dir = $_SERVER['DOCUMENT_ROOT'];
    if(isset($_FILES['file'])){
        if($_FILES["file"]["error"] != "4"){
            global $profileimageExtension, $profileimageName, $profileimagePath, $profileimageTarget;
            $imageArray = explode('.', $_FILES['file']['name']);
            $profileimageExtension = end($imageArray);
            $profileimageName = rand(100, 999) . ".{$profileimageExtension}";
            $profileimagePath = $_FILES['file']['tmp_name'];
            $profileimageTarget = "../profileimage/$profileimageName";
            move_uploaded_file($profileimagePath, $profileimageTarget);
        } else {
            $profileimageName = NULL;
        }  
    }
    // if($_FILES["file"]["error"] != "4"){
    //     $imageArray = explode('.', $_FILES['file']['name']);
    //     $profileimageExtension = end($imageArray);
    //     $profileimageName = rand(100, 999) . ".{$profileimageExtension}";
    //     $profileimagePath = $_FILES['file']['tmp_name'];
    //     $profileimageTarget = "../profileimage/$profileimageName";
    //     move_uploaded_file($profileimagePath, $profileimageTarget);
    //     echo '<img src="Exam/'.$profileimageTarget.'" height="150" width="225" class="img-thumbnail" />';
    // } else {
    //     $profileimageName = NULL;
    // }
?>