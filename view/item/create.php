<?php
ini_set('display_errors', 1);

require_once('../../config/db_settings.php');

$db_val = db_config();
$user = $db_val['user'];
$pass = $db_val['password'];
$dsn = $db_val['dsn'];
$options = $db_val['options'];

if (!empty($_POST['create'])) {
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        $sql = 'INSERT INTO items(name, descript, price, stock) VALUE (:name, :descript, :price,:stock)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
        $stmt->bindParam(':descript', $_POST['descript'], PDO::PARAM_STR);
        $stmt->bindParam(':price', $_POST['price'], PDO::PARAM_INT);
        $stmt->bindParam(':stock', $_POST['stock'], PDO::PARAM_INT);
        $stmt->execute();
        $pdo = null;

        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}
?>

<h1>商品作成ページ</h1>

<form action="create.php" method="post">
<ul>
    <li>商品名:<input type="text" name="name"></li>
    <li>商品説明:<input type="text" name="descript"></li>
    <li>価格:<input type="text" name="price"></li>
    <li>在庫数:<input type="text" name="stock"></li>
    <input type="submit" name="create" value="作成">
</ul>
</form>