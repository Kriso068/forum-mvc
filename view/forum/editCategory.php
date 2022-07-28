<?php
    $category = $result['data']['category'];
?>

<div class="card card-body bg-light mt-5">
    <h2>Update Category</h2>
    <p>Update the current category with this form</p>
    <form action="index.php?ctrl=forum&action=editCategory&id=<?=$id?>" method="post">
        <div class="form-group">
            <label for="title">Category Name: <sup>*</sup></label>
            <input type="text" name="categoryName" class="form-control form-control-lg" value="<?= $category->getCategoryName()?>">
        </div>
        <input type="submit" class="btn btn-success my-2" value="Submit">
    </form>
</div>