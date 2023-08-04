<?php

$topics = $result["data"]['topics'];

?>

<h1>list of Topics</h1>
<?php if ($topics) :?>
    <?php foreach($topics as $topic ) :?>
        
    <div class="card card-body my-5">
        <h4 class="card-title">Topic title : <?=$topic->getTitle() ;?></h4>
        <h4 class="card-title">Number of messages : <?=$topic->getNbMessages() ;?></h4>
        <div class="bg-dark bg-opacity-25 p-2 mb-3">
          
        </div>
        <a href=" index.php?ctrl=forum&action=detailTopic&id=<?=$topic->getId();?>" class="btn btn-dark">More</a>
        
            <?php if ($topic->getUser()->getPseudo() == (app\Session::getUser()->getPseudo()) && ($topic->getClosed() == 0)) :?>
                <a href=" index.php?ctrl=forum&action=closeTopic&id=<?=$topic->getId();?>" >
                    <i class="fa-solid fa-lock">
                        Close your Topic
                    </i>
                </a>
            <?php elseif ($topic->getUser()->getPseudo() == (app\Session::getUser()->getPseudo()) && ($topic->getClosed() == 1 )): ?>
                <a href=" index.php?ctrl=forum&action=openTopic&id=<?=$topic->getId();?>" >
                    <i class="fa-solid fa-lock-open">
                        Open your Topic
                    </i>
                </a>
                <?php elseif ( ($topic->getClosed() == 1 )): ?>
                    <i class="fa-solid fa-lock">
                    Close
                </i>
                <?php elseif ( ($topic->getClosed() == 0 )): ?>
                    <i class="fa-solid fa-lock-open">
                        Open
                    </i>
            <?php endif; ?>
    </div>  
    
    <?php endforeach; ?>
<?php else: ?>
    <h2>No topics</h2>

<?php endif; ?>

  
