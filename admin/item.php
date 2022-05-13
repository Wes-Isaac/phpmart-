<?php
require './includes/init.php';

$db = new Database();
$conn =  $db->getConn();

if(isset($_GET['id'])) {

    $item = Item::getById($conn, $_GET['id']); 

} else {
    $item = null;
}
?>

<?php require './includes/header.php'; ?>

<?php if($item): ?>
<article id="hello" class="article-items" style="background: #fff;">
    <h2><?=htmlspecialchars($item->item_name) ?></h2>

    <?php if($item->image_name): ?>
    

    <img class="responsive" src="../uploads/<?= $item->image_name?>" alt="NO IMAGE">

    <?php endif; ?>
   

        
        <p>Description:<?= htmlspecialchars($item->description) ?></p>
        <p class="price">Price:<?=htmlspecialchars($item->price) ?></p>
        
   



</article>
<ul class="nav">
<li class="nav-item">
    
    <a class="nav-link" href="edit-item.php?id=<?= $item->id?>">Edit item</a>

</li>
<li class="nav-item">
    
    <a class="nav-link" href="delete-item.php?id=<?= $item->id?>">Delete</a>

</li>
<li class="nav-item">

    <a class="nav-link" href="edit-item-image.php?id=<?= $item->id?>">Edit image</a>

</li>
</ul>

<?php else: ?>
<p>no item found.</p>

<?php endif; ?>







<?php require './includes/footer.php' ?>





