<?php
    require_once("handlers/register.php");
    $_studentFile = 'D:\\Sites\\home.hbv.no\\phptemp\\884608-student.txt';
    $return = 'Not successfull';
    // Checks each field for characters
    if (isset($_POST['class_code'], $_POST['username'], $_POST['first_name'], $_POST['last_name']))
    {
        if (strlen($_POST['username']) > 0 &&
            strlen($_POST['first_name']) > 0 &&
            strlen($_POST['last_name']) > 0 &&
            strlen($_POST['class_code']) > 0) {

            try {
                $reg = new Register($_studentFile, $_POST);
                $return = $reg->insert();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            unset($reg);
            echo $return;
            
        } else {
            echo "Alle felter må være utfylt.";
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
    <h2>Registrer en ny student</h2>
    <p><a href="/884608/web1000/innlevering1/index.php">Gå tilbake</a> | <a href="https://home.hbv.no/phptemp/884608-student.txt">Student.txt</a></p>
    <hr>

    <form action="" method="POST">
        <label for="username">
            Brukernavn:
            <input style="display: block;" type="text" id="username" name="username">
        </label>
        <label for="first_name">
            <span style="display: block;">Fullt navn:</span>
            <input type="text" id="first_name" name="first_name">
            <input type="text" id="last_name" name="last_name">
        </label>
        <label style="display: block;" for="first_name">
            Klassekode:
            <input style="display: block;" type="text" id="class_code" name="class_code">
        </label>
        <input style="display: block;" type="submit" value="Registrer">
    </form>
</body>
</html>