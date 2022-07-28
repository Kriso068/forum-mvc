<?php

?>

<div class="card card-body bg-light mt-5">
    <h2>Add a new Topic</h2>
    <p>Create a topic with this form</p>
    <form action="index.php?ctrl=forum&action=addTopic&id=<?=$id?>" method="post">
        <div class="form-group">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title" class="form-control form-control-lg" required>
        </div>
        <div class="form-group">
            <label for="Message">Message: <sup>*</sup></label>
            <textarea name="message" class="form-control form-control-lg"></textarea>
        </div>
        <input type="submit" class="btn btn-success my-2" value="Submit">
    </form>
</div>