
<?php

$topic = $result["data"]['topic'];
$posts = $result["data"]['posts'];

?>

<h1>Detail of a Topic</h1>
<div>
    <?php if ($topic->getUser()->getPseudo() == (app\Session::getUser()->getPseudo())) :?>
        <a href="index.php?ctrl=forum&action=editTopic&id=<?=$id?>" class="btn btn-primary my-2 col-2">Edit</a>
    <?php endif; ?>
</div>
<div>
    <?php if (App\Session::isAdmin()) : ?>
        <a href="index.php?ctrl=forum&action=deleteTopic&id=<?=$id?>" class="btn btn-danger my-2 col-2">delete</a>
    <?php endif; ?>
</div>

<div class="card card-body my-5">
    <h3 class="card-title">Title of the current Topic : <?=$topic->getTitle() ;?></h3>
    <div class="bg-dark bg-opacity-25 p-2 mb-3">
        Written by <?=$topic->getUser()->getPseudo() ;?> on <?=$topic->getCreationdate();?>
    </div>
        <a href="index.php?ctrl=forum&action=addPost&id=<?=$id?>" class="btn btn-primary my-2 col-2">Add a new Post</a>
    <?php if ($posts) :?>
       
        <h4>The list of messages in the topic :</h4>
        <?php foreach ($posts as $post) : ?>
            
        <?php $idpost = $post->getId();?>
        <div class="bg-success bg-opacity-50 p-2 mb-3 d-flex ">
            <div class="me-auto p-2"><?=$post->getMessage();?></div>
            
            <a href="index.php?ctrl=forum&action=editPost&id=<?=$idpost?>" class="btn btn-dark">Edit</a>
            <a href="index.php?ctrl=forum&action=deletePost&id=<?=$idpost?>" class="btn btn-danger">delete</a>
            
        </div>
        <?php endforeach ; ?>
    <?php else :?>
        <h4>The list of messages in the current topic :</h4>
        <div class="bg-danger text-light text-center mt-1">
            <?php echo 'The the topic haven\'t messages yet' ; ?>
        </div>
    <?php endif; ?> 
</div>



    
    
   




  
