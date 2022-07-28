<?php

$users = $result["data"]['users'];

?>

<h1>list of Users</h1>

<?php foreach($users as $user ) :?>
    <div class="card card-body my-2">
        <h4 class="card-title">User pseudo : <?=$user->getPseudo() ;?></h4>
        <div class="bg-light p-2 mb-3">
            <p>User email : <?=$user->getEmail() ;?> </p>
            <p>User password : <?=$user->getPassword() ;?> </p>
            <!-- <p>User role : <?=$user->getRoles(['']) ;?> </p> -->
            <p>User created at : <?=$user->getRegisterDate();?></p>
        </div>
        <div class="row my-1">
            <a href="index.php?ctrl=home&action=detailUser&id=<?=$user->getId();?>" class="btn btn-dark">More</a>
        </div>
        <div class="row d-flex justify-content-between">
            
            <a class="btn btn-danger col-3" href="index.php?ctrl=home&action=deleteUser&id=<?=$user->getId() ;?>">Delete profil</a>
        </div>
    </div>
<?php endforeach;



  
