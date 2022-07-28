

<div class="card card-body bg-light my-5">
    <h2>Add a new Category</h2>
    <p>Create a Category with this form</p>
    <form action="index.php?ctrl=forum&action=newCategory" method="POST">
        <div class="form-group">
            <label for="categoryName">Category name : <sup>*</sup></label>
            <input type="text" name="categoryName" class="form-control form-control-lg">
        </div>
        <input type="submit" class="btn btn-success my-2" value="Submit">
    </form>
</div>

