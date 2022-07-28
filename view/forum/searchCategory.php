<?php

$categories = $result["data"]['categories'];

?>
<h1>list of Categories</h1>  
<?php if ($categories) : ?>
<?php foreach($categories as $categorie ) :?>
    
    <div class="card card-body my-5">
        <h4 class="card-title">Category name : <?=$categorie->getCategoryName() ;?></h4>
        <div class="row d-flex justify-content-between">
            <a href=" index.php?ctrl=forum&action=detailCategorie&id=<?=$categorie->getId();?>" class="btn btn-dark mt-2 col-2">More</a>
        </div>
    </div>  
   
<?php endforeach; ?>
<?php else: ?>
    <h2>No Categories</h2>

<?php endif; ?>