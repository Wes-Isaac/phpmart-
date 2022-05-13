    
    <?php
    
    if (!empty($item->errors)) : ?>
        <ul>
            <?php foreach ($item->errors as $error) : ?>
                <li> <?= $error ?> </li>

            <?php endforeach; ?>
        </ul>
    <?php endif; ?>




    <form method="post">

    <div class="form-group">
     <label for="name">Item name</label>
     <input class="form-control" type="text" name="item" id="name" value= "<?= htmlspecialchars($item->item_name);?>">
    </div>

    <div class="form-group">
     <label for="desc">Description</label>
     <textarea class="form-control" name="description" id="desc" cols="30" rows="10"><?= htmlspecialchars($item->description) ?></textarea>
    
    </div>
    

    <div class="form-group">
     <label for="price">Price</label>
     <input class="form-control" type="number" name="price" step="any" id="price" value= "<?= htmlspecialchars($item->price);?>">
    
    </div>

    <div class="form-group">
      <label for="quantity">Quantity</label>
      <input class="form-control" type="number" id="quantity" name="quantity" step="1"  value= "<?= htmlspecialchars($item->quantity);?>">
    </div>

     <button class="btn btn-primary">add</button>





    </form>

    </div>