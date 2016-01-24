<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laravel</title>

    <link href="/css/main.css" rel="stylesheet" type="text/css">
    <link href="/css/works.css" rel="stylesheet" type="text/css">
    <link href="/css/articles.css" rel="stylesheet" type="text/css">
    <link href="/css/codeblock.css" rel="stylesheet" type="text/css">
    <link href="/css/social.css" rel="stylesheet" type="text/css">
    {{--<link href="/css/editor.css" rel="stylesheet" type="text/css">--}}
    {{--<link href="/css/form.css" rel="stylesheet" type="text/css">--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zepto/1.1.4/zepto.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.js"></script>
    <script src="//cdn.ckeditor.com/4.5.6/full/ckeditor.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/articles.js"></script>

    {{--<script src="/js/editor.js"></script>--}}
</head>
<body>

{{--LEFT MENU BLOCK OPEN--}}
<?php
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
$menu = MenuController::generateMenuItems();

?>
<nav id="nav" class="nav">
    {{--USER BLOCK OPEN--}}
    <?php
    $user = UserController::getUserFromSession();
    if($user){?>
    <img src="<?php echo $user['photo']?>" class="profile-img">
    <div class="profile-text">
        <h1 class="profile-name"><?php echo $user['name']?></h1>
        <span class="profile-title"><?php echo UserController::getUserStatusTitle()?></span>
    </div>

    <?php
    }
    ?>
    {{--USER BLOCK CLOSE--}}


    {{--LEFT MENU ITEMS OPEN--}}
    <ul class="offcanvas__nav--list">
        <?php foreach($menu as $item){?>
        <li class="offcanvas__nav--item"><a href="<?php echo '/admin/'.$item->alias ?>"><?php echo $item->title ?></a></li>
        <?php }?>
    </ul>
    {{--LEFT MENU ITEMS CLOSE--}}
</nav>
{{--LEFT MENU BLOCK CLOSE--}}


<section id="page-wrap" class="page--wrap">
    <div id="nav-toggle" class="nav__toggle">
        <div class="nav__toggle--span"></div>
    </div>
    <header class="page__header">
        <nav class="menu__main">
            <ul class="social-block">
                <li><a href="/vk" class="btn vk naked">login<span>with Вконтакте</span></a></li>
                <li><a class="btn fb naked">login<span>with facebook</span></a></li>
            </ul>
            <ul class="menu__main--list">
                <li class="menu__main--list-item" itemprop="url"><a href="" itemprop="name">menu item</a></li>
            </ul>

        </nav>
    </header>
    @yield('content')
</section>


</body>
</html>
