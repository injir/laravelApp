<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="/css/main.css" rel="stylesheet" type="text/css">
    <link href="/css/works.css" rel="stylesheet" type="text/css">
    <link href="/css/articles.css" rel="stylesheet" type="text/css">
    <link href="/css/codeblock.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zepto/1.1.4/zepto.min.js"></script>

    <script src="/js/main.js"></script>
    <script src="/js/articles.js"></script>
</head>
<body>
<?php
  use App\Http\Controllers\MenuController;

  $menu = MenuController::generateMenuItems();

?>
<nav id="nav" class="nav">
    <ul class="offcanvas__nav--list">
        <?php foreach($menu as $item){?>
        <li class="offcanvas__nav--item"><a href="<?php echo '/'.$item->alias ?>"><?php echo $item->title ?></a></li>
       <?php }?>
    </ul>
</nav>
<section id="page-wrap" class="page--wrap">
    <div id="nav-toggle" class="nav__toggle">
        <div class="nav__toggle--span"></div>
    </div>
    <header class="page__header">
        <nav class="menu__main">
            <ul class="menu__main--list">
                <li class="menu__main--list-item" itemprop="url"><a href="" itemprop="name">menu item</a></li>
                <li class="menu__main--list-item" itemprop="url"><a href="" itemprop="name">menu item</a></li>
            </ul>

        </nav>
    </header>
    @yield('content')
</section>
<?php

    var_dump(\Illuminate\Support\Facades\Session::all());
    echo "ÒÎÊÅÍ".csrf_token();

?>
</body>
</html>
