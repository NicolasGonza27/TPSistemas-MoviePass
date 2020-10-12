<form action="<?php echo FRONT_ROOT.'Movie/ShowContentViews'?>" method="post">
            <div class="container content">
                <div class="row">
                    <?php foreach($listMovie as $movie) 
                            {
                            ?>              
                                <div class="col-2">
                                    <a type="submit" name="id" value="<?php echo $movie->getId();?>">
                                        <img class="img-movies" src="<?php echo $movie->getImage();?>" alt="" width="80%" height="80%" title=" <?php echo $movie->getTitle(); ?>">
                                    </a>
                                </div>
                            <?php
                            }?>
                </div>
            </div>
</form>