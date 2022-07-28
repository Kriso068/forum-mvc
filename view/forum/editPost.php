<?php
    $post = $result['data']['post'];
?>

<div class="card card-body bg-light mt-5">
    <h2>Update Post</h2>
    <p>Update the current post with this form</p>
    <form action="index.php?ctrl=forum&action=editPost&id=<?=$id?>" method="post">
        <div class="form-group">
            <label for="title">Message: <sup>*</sup></label>
            <textarea name="message" class="form-control form-control-lg"><?= $post->getMessage()?></textarea>
        </div>
        <input type="submit" class="btn btn-success my-2" value="Submit">
    </form>
</div>