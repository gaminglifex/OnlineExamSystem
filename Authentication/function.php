<?php
    // $dir = $_SERVER['DOCUMENT_ROOT'];

    function validateInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
    
    // function ProImage($loginID){
    //     if($_FILES["profileimg"]["error"] != "4"){
    //         global $profileimageExtension, $profileimageName, $profileimagePath, $profileimageTarget;
    //         $loginID = validateInput(strtoupper($_POST['loginID']));
    //         $imageArray = explode('.', $_FILES['profileimg']['name']);
    //         $profileimageExtension = end($imageArray);
    //         $profileimageName = "{$loginID}.{$profileimageExtension}";
    //         $profileimagePath = $_FILES['profileimg']['tmp_name'];
    //         $profileimageTarget = "$dir/Exam/profileimage/$profileimageName";
    //         move_uploaded_file($profileimagePath, $profileimageTarget);
    //     } else {
    //         $profileimageName = NULL;
    //     }      
    // }
    
    // function Image($loginID, $profileimageName, $profileimageExtension, $profileimagePath){
    //     if($name != NULL){
    //         $profileimageName = "{$loginID}.{$ext}";
    //         $profileimageTarget = "../profileimage/$name";
    //         move_uploaded_file($path, $profileimageTarget);
    //     }
    // }

?>