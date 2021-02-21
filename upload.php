<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
        echo "Chyba serveru ";
        $uploadSuccess = false;
    }

    elseif(file_exists($targetFile)) {
        echo "Soubor již existuje ";
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
            elseif($fileType == "mp3"){
                echo "<audio controls><source src='uploads/{$_FILES["uploadedName"]["name"]}'></audio>";
            }
        }
    }


}

?>
<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Select image to upload:</label>
        <input type="file" name="uploadedName" class="form-control" >
        <br>
        <input type="submit" value="Nahrát" name="submit" class="btn btn-primary mb-3">
    </div>
</form>

</body>
</html>
