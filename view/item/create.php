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
        $sql = 'INSERT INTO items (name, descript, price, stock, category_id) VALUE (:name, :descript, :price, :stock, :category_id)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
        $stmt->bindParam(':descript', $_POST['descript'], PDO::PARAM_STR);
        $stmt->bindParam(':price', $_POST['price'], PDO::PARAM_INT);
        $stmt->bindParam(':stock', $_POST['stock'], PDO::PARAM_INT);
        $stmt->bindParam(':category_id', $_POST['category'], PDO::PARAM_INT);
        $stmt->execute();
        $pdo = null;

        header("Location: /item/index.php");
        exit();
    } catch (PDOException $e) {
        return $e->getMessage();
    }
}

$pdo = new PDO($dsn, $user, $pass, $options);
$sql = 'SELECT * FROM categories';
$stmt = $pdo->query($sql);
$all = $stmt->fetchAll();
$pdo = null;

if (empty($all)) {
    header("Location: /category/create.php");
}

?>

<h1>商品作成ページ</h1>

<form action="/item/create.php" method="post">
    <ul>
        <li>商品名:<input type="text" name="name"></li>
        <li>商品説明:<input type="text" name="descript"></li>
        <li>価格:<input type="text" name="price"></li>
        <li>在庫数:<input type="text" name="stock"></li>
        <li>
            <select name="category">
                <?php foreach($all as $category) { ?>
                    <option value= <?php echo $category['id'] ?>>
                    <?php echo $category['name']; ?>
                    </option>
                <?php } ?>
            </select>
        </li>
    </ul>
    <input type="submit" name="create" value="作成">
</form>