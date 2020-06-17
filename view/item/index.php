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
    $sql = 'SELECT * FROM items';
    $res = $pdo->query($sql);

} catch (PDOException $e) {
    return $e->getMessage();
}

?>

<h1>商品一覧ページ</h1>
<ul>
<?php foreach($res as $item) { ?>
    <li><a href="show.php?id=<?php echo $item['id']; ?>"><?php echo $item['name']; ?></a></li>
<?php } ?>
</ul>

<a href="create.php">商品作成</a>
