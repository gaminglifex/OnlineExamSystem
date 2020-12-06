<?php 
    function validateInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
    
    function ProImage($e, $loginID){
        if($e != "4"){
            $imageArray = explode('.', $_FILES['profileimg']['name']);
            $profileimageExtension = end($imageArray);
            $profileimageName = "{$loginID}.{$profileimageExtension}";
            $profileimagePath = $_FILES['profileimg']['tmp_name'];
            $profileimageTarget = "../profileimage/$profileimageName";
            move_uploaded_file($profileimagePath, $profileimageTarget);
        } else {
            $profileimageName = NULL;
        }
    }
?>