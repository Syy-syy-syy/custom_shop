<?php
ini_set('display_errors', 1);

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
    $res = $stmt->fetch();
    $pdo = null;
} catch (PDOException $e) {
    return $e->getMessage();
}

if (isset($_POST['update'])) {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $sql = 'UPDATE items SET name = :name, descript = :descript, price = :price, stock= :stock WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $stmt->bindParam(':descript', $_POST['descript'], PDO::PARAM_STR);
    $stmt->bindParam(':price', $_POST['price'], PDO::PARAM_INT);
    $stmt->bindParam(':stock', $_POST['stock'], PDO::PARAM_INT);
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch();
    $database = null;

    header("Location: index.php");
    exit();
}
?>

<form action="edit.php?id=<?php echo $_GET['id']; ?>" method="post">
    <ul>
        <li><input type="text" name="name" value="<?php echo $res['name']; ?>"></li>
        <li><input type="text" name="descript" value="<?php echo $res['descript']; ?>"></li>
        <li><input type="text" name="price" value="<?php echo $res['price']; ?>"></li>
        <li><input type="text" name="stock" value="<?php echo $res['stock']; ?>"></li>
    </ul>
    <input type="submit" name="update" value="更新">
</form>