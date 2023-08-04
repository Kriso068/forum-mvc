<?php

$categories = $result["data"]['categories'];

?>
<h1 class="beige text-center">Welcome of my forum</h1>

<h3 class="green">list of Categories :</h3>  
<?php if ($categories) : ?>
<?php foreach($categories as $categorie ) :?>
    
    <div class="card card-body my-5 bgGreen">
        <h4 class="card-title text-warning">Category name : <span class=' white'><?=$categorie->getCategoryName() ;?></span></h4>
        <h4 class="card-title white">Number of topics : <?=$categorie->getNbTopics() ;?></h4>
        <div class="row d-flex justify-content-between">
            <a href=" index.php?ctrl=forum&action=detailCategorie&id=<?=$categorie->getId();?>" class="btn BgBeige mt-2 col-2 bntGreenText">More</a>
            <?php if (App\Session::isAdmin()) : ?>
                <a href="index.php?ctrl=forum&action=deleteCategory&id=<?=$categorie->getId()?>" class="btn btn-danger mt-2 col-2">Delete</a>
            <?php endif; ?>
        </div>
    </div>  
   
<?php endforeach; ?>
<?php else: ?>
    <h2>No Categories</h2>

<?php endif; ?>
