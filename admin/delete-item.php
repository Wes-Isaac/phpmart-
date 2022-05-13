<?php

require './includes/init.php';

Auth::adminRequireLogin();

$db = new Database();
$conn = $db->getConn();

if(isset($_GET['id'])) {

    $item = Item::getById($conn, $_GET['id']);

    if(!$item) {
       

        die("Item not found");
    }

} else {
    die("id not supplied, item not found");
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if($item->delete($conn)){

        Url::redirect("/project/admin/");
    }
}

?>

<?php require './includes/header.php'; ?>

<h2>Delete Item</h2>
<div class="container">

    <form method="post">
        <p>Are you sure?</p>
        <button class="btn btn-primary">delete</button>
        <a  href="item.php?id=<?= $item->id; ?>">cancel</a>
    </form>
    
</div>
<div id="hello"></div>
<?php require './includes/footer.php'; ?>