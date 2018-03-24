<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Заметки</title>
    </head>
    <body>
        <h1>Заметки</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="note" placeholder="Новая заметка"/>
            <input type="submit" value="Добавить" />
        </form>
        <br>

        <?php
        Error_reporting(E_ALL);
        $pdo = new PDO("mysql:host=localhost;dbname=mfti", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (!empty($_POST["note"])) {
            $note = $_POST["note"];
            $array = ["note" => $note];
            $sql = "INSERT INTO notes(note, date_added) VALUES (:note, NOW())";
            $stm = $pdo->prepare($sql);
            $stm -> execute($array);
        }

        if (isset($_GET["getId"])) {
            $getId = $_GET["getId"];
        } else {
            $getId = NULL;
        }

        if (isset($_GET["doWithId"])) {
            $doWithId = $_GET["doWithId"];
        } else {
            $doWithId = NULL;
        }

        if ($doWithId === 'del') {
            $delNote = "DELETE FROM notes WHERE id = '$getId'";
            $stm = $pdo->prepare($delNote);
            $stm -> execute();
        }
        ?>

        <table border="1">
            <tr>
                <td><b>Заметка</b></td>
                <td><b>Дата добавления</b></td>
                <td></td>
            </tr>

            <?php
            $data = $pdo->query("SELECT * FROM notes");
            foreach ($data as $key => $value) {
                echo '<tr>';
                echo '<td>' . $value['note'] . '</td>' . "\n";
                echo '<td>' . $value['date_added'] . '</td>' . "\n";
                echo '<td><a href="index.php?getId=' . $value['id'] . '&doWithId=del">Удалить </a> </td>' . "\n";
                echo '</tr>';
            }
            ?>
        </table>

    </body>
</html>
