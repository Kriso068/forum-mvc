<?php
$user = $result["data"]["user"];
$posts = $result["data"]["posts"];
$topics = $result["data"]["topics"];

?>

<h1>Detail of <?=$user->getPseudo()?></h1>

<?php if (($user->getId() == (app\Session::getUser()->getId()))) :?>
    <a class="btn btn-dANGER col-4" aria-current="page" href="index.php?ctrl=security&action=deleteUser&id=<?=$user->getId()?>">Delete User</a>
<div class="row">
    <div class="col d-flex justify-content-between">
        <a class="btn btn-primary col-4" aria-current="page" href="index.php?ctrl=home&action=editUser&id=<?=$user->getId()?>">Edit User</a>
        <a class="btn btn-danger col-4" aria-current="page" href="index.php?ctrl=security&action=modifyPassword">Edit Password</a>
    </div>
</div>
<div class="card card-body">
    <h3 class="card-title">User pseudo : <?=$user->getPseudo() ;?></h3>
    <div class="bg-light p-2 mb-3">
      User Created on <?=$user->getRegisterDate();?>
    </div>
    <?php if ($posts) :?>
        <h4>The list of posted messages of the current user :</h4>
        <?php foreach ($posts as $post) : ?>
        <div class="bg-success bg-opacity-50 p-2 mb-3">
            <?=$post->getMessage();?>
        </div>
        <?php endforeach ; ?>
    <?php else :?>
        <h4>The list of posted messages of the current user :</h4>
        <div class="bg-danger text-light text-center mt-1">
            <?php echo "User haven't posted a message yet" ; ?>
        </div>
    <?php endif; ?> 
    <?php if ($topics) :?>
        <h4>The list of posted topics of the current user :</h4>
        <?php foreach ($topics as $topic) : ?>
        <div class="bg-success bg-opacity-50 p-2 mb-3">
            <?=$topic->getTitle();?>
        </div>
        <?php endforeach ; ?>
    <?php else :?>
        <h4>The list of posted topics of the current user :</h4>
        <div class="bg-danger text-light text-center mt-1">
            <?php echo "User haven't posted a Toic yet" ; ?>
        </div>
    <?php endif; ?> 
    
</div>
<?php endif; ?> 