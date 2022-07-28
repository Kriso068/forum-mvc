<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="./<?= PUBLIC_DIR ?>/css/style.css">
    <title>BLOG</title>
</head>
<body>
    
        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
            <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
            <header>

            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?= "index.php?ctrl=home" ?> ">Home</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarColor01">
                        <ul class="navbar-nav me-auto">
                            <?php if (App\Session::isAdmin()) : ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?ctrl=home&action=users">Voir la liste des gens</a>
                                </li>
                                <li>
                                    <a href="index.php?ctrl=forum&action=newCategory" class="nav-link">Add a new Category</a>
                                </li>
                            <?php endif; ?>

                            <?php if (App\Session::getUser()) : ?>   
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?ctrl=forum&action=listTopics">List of Topics</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">About</a>
                                </li>
                        </ul>
                        <form class="d-flex" action="index.php?ctrl=forum&action=searchBar" method="post" enctype="#">
                            <input class="form-control me-sm-2" type="text" name="categoryName" placeholder="Search">
                            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                        </form>
                        <ul class="navbar-nav ml-auto mb-2 mb-lg-0 ">
                            <li>
                                <a href="index.php?ctrl=home&action=detailUser&id=<?php echo App\Session::getUser()->getId()?>" class='me-2 nav-link text-light'><span class="fas fa-user me-2"></span>&nbsp;<?= App\Session::getUser()->getPseudo()?></a>
                            </li>
                            <li>
                                <a href="index.php?ctrl=security&action=logout" class="nav-link">Logout</a>
                            </li>
                        </ul>
                        <?php else : ?>
                            <ul class="navbar-nav ml-auto mb-2 mb-lg-0 ">
                                <li>
                                    <a class="nav-link text-light" aria-current="page" href="index.php?ctrl=security&action=login">Login</a>
                                </li>
                                <li>
                                    <a class="nav-link text-light" aria-current="page" href="index.php?ctrl=security&action=register">Register</a>   
                                </li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>








<!--

            <nav class="navbar navbar-expand-lg bg-dark bg-opacity-75 mb-5">
                <div class="container-fluid ">
                    <a class="navbar-brand text-light" href="<?= "index.php?ctrl=home" ?> ">Home</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <?php
                    if(App\Session::getUser()){
                        ?>
                        
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link text-light" aria-current="page" href="index.php?ctrl=home&action=users">Voir la liste des gens</a>
                            </li>
                            <li>
                                <a class="nav-link text-light" aria-current="page" href="index.php?ctrl=forum&action=listCategories">List of Categories</a>
                            </li>
                            <li>
                                <a class="nav-link text-light" aria-current="page" href="index.php?ctrl=forum&action=listTopics">List of Topics</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto mb-2 mb-lg-0 ">
                                    <a href="index.php?ctrl=home&action=detailUser&id=<?php echo App\Session::getUser()->getId()?>" class='me-2 nav-link text-light'><span class="fas fa-user me-2"></span>&nbsp;<?= App\Session::getUser()->getPseudo()?></a>
                                    <a href="index.php?ctrl=security&action=logout" class="nav-link text-light">Logout</a>
                                    <?php
                                }
                                else{
                                    ?>
                                    <a class="nav-link text-light" aria-current="page" href="index.php?ctrl=forum&action=listCategories">List of Categories</a>
                                    <a class="nav-link text-light" aria-current="page" href="index.php?ctrl=security&action=login">Login</a>
                                    <a class="nav-link text-light" aria-current="page" href="index.php?ctrl=security&action=register">Register</a>   
                                <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>

-->
            </header>
    <div class="container">        
            <main id="forum">
                <?= $page ?>
            </main>
        </div>
        <footer class="bg-dark sticky-bottom">
            <small>&copy; 2020 - Blog CDA - <a class="" href="/home/forumRules.html">Règlement du forum</a> - <a href="">Mentions légales</a></small>
            <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
        </footer>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script>

        $(document).ready(function(){
            $(".message").each(function(){
                if($(this).text().length > 0){
                    $(this).slideDown(500, function(){
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function(){
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })

        

        /*
        $("#ajaxbtn").on("click", function(){
            $.get(
                "index.php?action=ajax",
                {
                    nb : $("#nbajax").text()
                },
                function(result){
                    $("#nbajax").html(result)
                }
            )
        })*/

        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>





