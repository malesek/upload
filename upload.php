<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
if($_FILES){
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["uploadedName"]["name"]);
    $fileType = strtolower(pathinfo( $targetFile, PATHINFO_EXTENSION));

    $uploadSuccess = true;



    if($_FILES["uploadedName"]["error"] != 0){
        echo "Chyba serveru";
        $uploadSuccess = false;
    }

    elseif(file_exists($targetFile)) {
        echo "Soubor již existuje";
        $uploadSuccess = false;
    }

    elseif($_FILES["uploadedName"]["size"] > 8000000){
        echo "Soubor je příliš velký ";
        $uploadSuccess = false;
    }

    elseif ($fileType !== "jpg" && $fileType !== "png" && $fileType !== "mp4" && $fileType !== "mp3"){
        $uploadSuccess = false;
    }

    if(!$uploadSuccess){
        echo "Došlo k chybě uploadu";
    }
    else{
        if(move_uploaded_file($_FILES["uploadedName"]["tmp_name"], $targetFile)){
            echo "Soubor " . basename($_FILES["uploadedName"]["name"]) . " byl uložen";
            echo "<br>";
            if($fileType == "jpg" || $fileType == "png"){
                echo "<img src='uploads/{$_FILES["uploadedName"]["name"]}' alt='obrazek'>";
            }
            elseif($fileType == "mp4"){
                echo "<video controls><source src='uploads/{$_FILES["uploadedName"]["name"]}'></video>";
            }
        }
    }


}

?>
<form method="post" action="" enctype="multipart/form-data">
    <div>
        Select image to upload:
        <input type="file" name="uploadedName">
        <input type="submit" value="Nahrát" name="submit">
    </div>
</form>

</body>
</html>
