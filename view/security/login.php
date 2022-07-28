
<h1>form login</h1>

<form action="index.php?ctrl=security&action=login" method="POST">
    <div class="form-group">
        <label for="title">Pseudo: <sup>*</sup></label>
        <input type="text" name="pseudo" class="form-control form-control-lg" required>
    </div>
    <div class="form-group">
        <label for="title">Password: <sup>*</sup></label>
        <input type="password" name="password" class="form-control form-control-lg" required>
    </div>
        <input type="submit" class="btn btn-success my-2" value="Submit">
</form>
