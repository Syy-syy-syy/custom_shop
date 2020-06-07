<?php
ini_set('display_errors', 1);
// MySQLサーバ接続に必要な値を変数に代入
require_once('../../config/db_settings.php');

$db_val = db_config();
$user = $db_val['user'];
$pass = $db_val['password'];
$dsn = $db_val['dsn'];
$options = $db_val['options'];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $category = $stmt->fetch();

    $db = null;
} catch (PDOException $e) {
    echo $e->getMessage();
}

if (isset($_POST['category'])) {
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        $sql = 'UPDATE categories SET name = :name WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();

        $id = $_GET['id'];
        header("Location: /category/show.php?id=$id ?>");
        exit();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>

<form action="/category/edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
    <label>カテゴリ編集</label>
    <input type="text" name="name" value="<?php echo $category['name']; ?>" placeholder="カテゴリ名" required>
    <input type="submit" name="category" value="登録">
</form>
<a href="/category/show.php?id=<?php echo $_GET['id']; ?>">カテゴリ一覧</a>
<a href="/category/index.php">カテゴリ一覧</a>