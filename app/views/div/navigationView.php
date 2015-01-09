<!-- Static navbar -->
<div class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./"><?php echo $settings->getSiteName(); ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <!--
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            -->
            <ul class="nav navbar-nav navbar-right">
                <!--
                <li class="active"><a href="./">Default</a></li>
                <li><a href="../navbar-static-top/">Static top</a></li>
                <li><a href="../navbar-fixed-top/">Fixed top</a></li>
                -->
                <?php foreach ($settings->getSiteNavigationArr() as $navPageUrl => $navPageTitle) : ?>
                <?php $active = ($navPageUrl == $this->getPage()) ? ' class="active"' : ''; ?>
                <?php if ($navPageUrl == 'home') : ?>
                <li<?php echo $active; ?>><a href="./"><?php echo $navPageTitle; ?></a></li>
                <?php else : ?>
                <li<?php echo $active; ?>><a href="./?page=<?php echo $navPageUrl ?>"><?php echo $navPageTitle; ?></a></li>
                <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container -->
</div>
