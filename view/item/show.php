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
    $database = null;

} catch (PDOException $e) {
    return $e->getMessage();
}
?>

<?php
if (isset($_POST['delete'])) {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $sql = 'DELETE FROM items WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $database = null;
}
?>

<ul>
    <li><?php echo $res['name']; ?></li>
    <li><?php echo $res['descript']; ?></li>
    <li><?php echo $res['price']; ?></li>
    <li><?php echo $res['stock']; ?></li>
</ul>

<form method="post">
    <input type="submit" name="delete" value="削除">
</form>