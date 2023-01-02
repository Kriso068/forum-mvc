<?php 

$user = $result['data']['user'];
?>

  <div class="card card-body bg-light mt-5">
    <h2>Edit Profile</h2>
    <p>Edit the profile with this form</p>
    <form action="index.php?crtl=home&action=editUser&id=<?php echo $data['id']; ?>" method="post">
      <div class="form-group">
        <label for="title">Pseudo: <sup>*</sup></label>
        <input type="text" name="pseudo" class="form-control form-control-lg" value="<?php echo $user->getPseudo(); ?>">  
      </div>
      <div class="form-group">
        <label for="email">Email: <sup>*</sup></label>
        <input type="email" name="email" class="form-control form-control-lg" value="<?php echo $user->getMail(); ?>">  
      </div>
      <div class="form-group">
        <label for="password">Password: <sup>*</sup></label>
        <input type="password" name="password" class="form-control form-control-lg" value="<?php echo $user->getPassword(); ?>">  
      </div>
      <input type="submit" class="btn btn-success my-3" value="Submit">
    </form>
  </div>
  
