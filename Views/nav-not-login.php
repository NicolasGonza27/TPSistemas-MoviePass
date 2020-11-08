<nav class="navbar navbar-expand-lg navbar-dark fixed-top mb-5" style="background-color: black;">
    <a class="navbar-brand" href="#">Movie-Pass</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class = "nav-item">  
              <a class="nav-link"  href= "<?php echo FRONT_ROOT."Home/ShowFiltersNotLogin"?>" id="navbarDropdownMenuLink" role="button">
                Billboard
              </a>
            </li>
        </ul>

        <form class="form-inline my-2 my-lg-0" action="<?php echo FRONT_ROOT."Movie/ShowListViewsByTitleNotLogin"?>" method="post">
          <input class="form-control mr-sm-2" type="search" placeholder="Title of movie" name="title" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <a class="nav-link text-white"  href= "<?php echo FRONT_ROOT."Home/StartLogin"?>" >Log in</a>
    </div>
</nav>
