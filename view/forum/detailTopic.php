
<?php

$topic = $result["data"]['topic'];
$posts = $result["data"]['posts'];

?>

<h1>Detail of a Topic</h1>
<?php if (app\Session::getUser()): ?>
    <div>
        <?php if (($topic->getUser()->getPseudo() == (app\Session::getUser()->getPseudo())) && ($topic -> getClosed() == 0)) :?>
            <a href="index.php?ctrl=forum&action=editTopic&id=<?=$id?>" class=" btn bntGreenText my-2 col-2">Edit</a>
        <?php endif; ?>
    </div>
    <div>
        <?php if (App\Session::isAdmin()) : ?>
            <a href="index.php?ctrl=forum&action=deleteTopic&id=<?=$id?>" class="btn btn-danger my-2 col-2">delete</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
<div class="card card-body bgGreen white my-5">
    <h3 class="card-title">Title of the current Topic : <span class="text-warning"><?=$topic->getTitle() ;?></span></h3>
    <div class="bg-dark bg-opacity-25 p-2 mb-3">
        Written by <?=$topic->getUser()->getPseudo() ;?> on <?=$topic->getCreationdate();?>
    </div>
    <?php if (($topic -> getClosed() == 0) && (app\Session::getUser())): ?>
        <a href="index.php?ctrl=forum&action=addPost&id=<?=$id?>" class="btn bntGreenText my-2 col-2">Add a new Post</a>
    <?php endif; ?> 
    <?php if ($posts) :?>
       
        <h4>The list of messages in the current topic :</h4>
        <?php foreach ($posts as $post) : ?>
            
        <?php $idpost = $post->getId();?>
        <div class="bg-success bg-opacity-50 p-2 mb-3 d-flex ">
            <div class="me-auto p-2 text-justify"><?=$post->getMessage();?></div>
            <?php if (app\Session::getUser()): ?>
                <?php if ($post->getUser()->getPseudo() == (app\Session::getUser()->getPseudo()) && $topic -> getClosed() == 0) :?>
                    <a href="index.php?ctrl=forum&action=editPost&id=<?=$idpost?>" class=" h-25 btn btn-dark">Edit</a>
                <?php endif; ?> 
                <?php if ($post->getUser()->getPseudo() == (app\Session::getUser()->getPseudo())) :?>
                    <a href="index.php?ctrl=forum&action=deletePost&id=<?=$idpost?>" class=" h-25 btn btn-danger">delete</a>
                <?php endif; ?> 
            <?php endif; ?> 
            
        </div>
        <?php endforeach ; ?>
    <?php else :?>
        <h4>The list of messages in the current topic :</h4>
        <div class="bg-danger text-light text-center mt-1">
            <?php echo 'The the topic haven\'t messages yet' ; ?>
        </div>
    <?php endif; ?> 
</div>



    
    
   




  
