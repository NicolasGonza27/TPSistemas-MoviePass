<?php
   require_once(VIEWS_PATH."header.php");
   require_once(VIEWS_PATH."Views-Cliente/nav.php");
?>

<div class="mt8"> 


  <div class="jumbotron" style="border: 8px solid #292626;">
    <h1 class="display-4">Movie by world</h1>
    <p class="lead">
      Welcome to our personalized movie page, we invite you to use the filters to see all the options for you and have a good night..</p>
    <hr class="my-4">
    <p>Here we leave you a link that takes you directly to the billboard so you can start browsing.</p>
    <a class="btn btn-primary btn-lg" href="<?php echo FRONT_ROOT."Home/ShowFiltersViews"?>" role="button">Go to Billboard</a>
  </div>

  </div>
   




<?php require_once(VIEWS_PATH."footer.php"); ?>