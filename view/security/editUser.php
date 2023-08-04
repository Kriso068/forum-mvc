<?php 

$user = $result['data']['user'];
?>

  <div class="card card-body bg-light mt-5">
    <h2>Edit Profile</h2>
    <p>Edit the profile with this form</p>
    <form action="index.php?crtl=home&action=editUser&id=<?=$user->getId();?>" method="post">
    <div><?=$user->getId();?></div>
      <div class="form-group">
        <label for="title">Pseudo: <sup>*</sup></label>
        <input type="text" name="pseudo" class="form-control form-control-lg" value="<?=$user->getPseudo();?>">  
      </div>
      <div class="form-group">
        <label for="email">Email: <sup>*</sup></label>
        <input type="email" name="email" class="form-control form-control-lg" value="<?=$user->getEmail();?>">
      </div>
        <input type="submit" class="btn btn-success my-2" value="Submit">
    </form>
  </div>
  
