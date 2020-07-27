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
    $sql = 'SELECT * FROM categories';
    $res = $pdo->query($sql);
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<h1>カテゴリ一覧ページ</h1>
<?php if ($res) { ?>
<ul>
<?php foreach($res as $category) { ?>
    <li><a href="/category/show.php?id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
<?php } ?>
</ul>
<?php } else { ?>
<h2>カテゴリが登録されていません。</h2>
<?php } ?>

<a href="/category/create.php">カテゴリ新規作成</a>
<a href="/item/index.php">商品一覧</a>