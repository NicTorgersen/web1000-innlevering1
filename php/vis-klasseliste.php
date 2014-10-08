<?php
    require_once('handlers/view.php');
    $_fileArr = array('student' => 'D:\\Sites\\home.hbv.no\\phptemp\\884608-student.txt');
    if (isset($_POST['search1']) && !empty($_POST['search1'])) {
        try {
            $view = new View($_fileArr);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $fields = $view->displayBy($_POST['search1']);
    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vis Studenter</title>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Studenter</h2>
    <p><a href="/884608/web1000/innlevering1/index.php">Gå tilbake</a> | <a href="https://home.hbv.no/phptemp/884608-student.txt">Student.txt</a></p>
    <hr>
    <form action="" method="POST">
        <label>
            Skriv inn klassekode/brukernavn/fornavn/etternavn:
            <input style="display: block;" type="text" id="search" name="search1">
        </label>
        <input type="submit" value="Søk">
    </form>
    <?php
        if (isset($fields)) {
            foreach ($fields as $key => $fieldArr) {
                echo "<ul>";
                foreach ($fieldArr as $fieldKey => $field) {
                    if ($fieldKey != 3) {
                        echo "<li>" . $field . "</li>";
                    }
                }
                echo "</ul>";
            }
        }
    ?>

</body>
</html>