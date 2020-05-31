<?php

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
    <li><?php echo $item['name']; ?></li>
<?php } ?>
</ul>