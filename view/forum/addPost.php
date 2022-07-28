<?php
?>

<div class="card card-body bg-light mt-5">
    <h2>Add a new Post</h2>
    <p>Create a post with this form</p>
    <form action="index.php?ctrl=forum&action=addPost&id=<?=$id?>" method="post">
        <div class="form-group">
            <label for="Message">Message: <sup>*</sup></label>
            <textarea name="message" class="form-control form-control-lg"></textarea>
        </div>
        <input type="submit" class="btn btn-success my-2" value="Submit">
    </form>
</div>