
<h1>Register</h1>

<form action="index.php?ctrl=security&action=register" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Pseudo: <sup>*</sup></label>
        <input type="text" name="pseudo" class="form-control form-control-lg" required>
    </div>
    <!-- <div class="form-group">
        <label for="title">Avatar: <sup>*</sup></label>
        <input type="file" name="avatar" class="form-control form-control-lg" required>
    </div> -->
    <div class="form-group">
        <label for="title">Email: <sup>*</sup></label>
        <input type="email" name="email" class="form-control form-control-lg" required>
    </div>
    <div class="form-group">
        <label for="title">Password: <sup>*</sup></label>
        <input type="password" name="password" class="form-control form-control-lg" required>
    </div>
    <div class="form-group">
        <label for="title">Confirm Password: <sup>*</sup></label>
        <input type="password" name="confirmPass" class="form-control form-control-lg" required>
    </div>
        <input type="submit" class="btn btn-success my-2" value="Submit">
</form>