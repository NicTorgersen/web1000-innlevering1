<?php
    require_once("handlers/register.php");
    $_classFile = 'D:\\Sites\\home.hbv.no\\phptemp\\884608-klasse.txt';
    $return = 'Not successfull';
    if (isset($_POST['class_code'], $_POST['class_name'])) {

        if (strlen($_POST['class_code']) > 0 &&
            strlen($_POST['class_name']) > 0) {

            try {
                $reg = new Register($_classFile, $_POST);
                $return = $reg->insert();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            unset($reg);
            echo $return;
            
        }
    } else {
        echo "Alle felter må være utfylt.";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registrer Klasse</title>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Registrer en ny klasse</h2>
    <p><a href="/884608/web1000/innlevering1/index.php">Gå tilbake</a> | <a href="https://home.hbv.no/phptemp/884608-klasse.txt">Klasse.txt</a></p>

    <hr>
    
    <form action="" method="POST">
        <label for="class_code">
            Klassekode:
            <input style="display: block;" type="text" id="class_code" name="class_code">
        </label>
        <label for="class_name">
            Klassenavn:
            <input style="display: block;" type="text" id="class_name" name="class_name">
        </label>
        <input style="display: block;" type="submit" value="Registrer">
    </form>
</body>
</html>