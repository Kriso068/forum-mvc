
<?php
$categorie = $result['data']['categorie'];
$topics = $result["data"]['topics'];

?>

<h1>Detail of a Category</h1>
<div class="row d-flex justify-content-between">
    <?php if (App\Session::isAdmin()) : ?>
        <a href="index.php?ctrl=forum&action=editCategory&id=<?=$id?>" class="btn btn-dark my-2 col-2">Edit</a>
    <?php endif; ?>
    <a href="index.php?ctrl=forum&action=addTopic&id=<?=$id?>" class="btn btn-primary my-2 col-2">Add a new Topic</a>
</div>

<div class="card card-body my-5">
    <h3 class="card-title"><?=$categorie->getCategoryName() ; ?></h3>
    <?php if ($topics) :?>
        <div class="card card-body">
            <h4>The list of topics in the current category :</h4>
            <?php foreach ($topics as $topic) : ?>
            <div class="bg-success bg-opacity-50 p-2 mb-3">
                Titre du topic : <?=$topic->getTitle();?>
            </div>
            <div class="card-footer bg-dark bg-opacity-25 p-2 mb-3">
                Created on <?=$topic->getCreationdate();?>
            </div>    
            <?php endforeach ; ?>
        </div>
        <?php else : ?>
            <h4>The list of topics in the current Category :</h4>
            <div class="bg-danger text-light text-center mt-1">
                <?php echo 'The the topic haven\'t topic yet' ; ?>
            </div>              
    <?php endif ; ?> 
</div>
