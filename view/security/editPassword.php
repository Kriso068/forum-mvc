<div class="card card-body bg-light mt-5">
    <h2>Edit Password</h2>
    <p>Edit the password with this form</p>

    <form action="index.php?ctrl=security&action=modifyPassword" method="post">
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
</div>