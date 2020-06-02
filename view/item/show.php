<?php

require_once('../../config/db_settings.php');

$db_val = db_config();
$user = $db_val['user'];
$pass = $db_val['password'];
$dsn = $db_val['dsn'];
$options = $db_val['options'];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $sql = 'SELECT * FROM items WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
} catch (PDOException $e) {
    return $e->getMessage();
}

?>



<a href="edit.php">編集ページ</a>
<form action="show.php" method="post">
    <input type="submit" name="delete" value="削除">
</form>

