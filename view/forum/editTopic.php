<?php
    $topic = $result['data']['topic'];
?>

<div class="card card-body bg-light mt-5">
    <h2>Update Topic</h2>
    <p>Update the current topic with this form</p>
    <form action="index.php?ctrl=forum&action=editTopic&id=<?=$id?>" method="post">
        <div class="form-group">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title" class="form-control form-control-lg" value="<?= $topic->getTitle()?>">
        </div>
        <input type="submit" class="btn btn-success my-2" value="Submit">
    </form>
</div>