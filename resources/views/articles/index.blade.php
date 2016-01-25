@extends('layouts.main')
@section('content')
    @parent
    <?php
    foreach($model as $item){
    ?>

    <div class="article-wrapper" id="article-<?php echo $item->id ?>">

        <div class="card radius shadowDepth1">
            <div class="card__image border-tlr-radius">
                <img src="http://lorempixel.com/400/200/sports/" alt="image" class="border-tlr-radius">
            </div>

            <div class="card__content card__padding">
                <div class="card__share">
                    <div class="card__social">
                        <a class="share-icon facebook" href="#"><span class="fa fa-facebook"></span></a>
                        <a class="share-icon twitter" href="/repost/articles/<?php echo $item->id ?>"><span class="fa fa-twitter"></span></a>
                        <a class="share-icon googleplus" onclick="repostVk()" href="#"><span class="fa fa-google-plus"></span></a>
                    </div>

                    <a id="share" class="share-toggle share-icon" href="#"></a>
                </div>

                <div class="card__meta">
                    <a href="#">Web Design</a>
                    <time><?php echo $item->created_at ?></time>
                </div>

                <article class="card__article">
                    <h2><a href="/articles/<?php echo $item->id ?>"><?php echo $item->title ?></a></h2>

                    <p><?php echo $item->text ?></p>
                </article>
            </div>

            <div class="card__action">

                <div class="card__author">
                    <img src="http://lorempixel.com/40/40/sports/" alt="user">
                    <div class="card__author-content">
                        By <a href="#"><?php echo $item->author ?></a>
                    </div>
                </div>
            </div>
        </div>
     </div>
    <?php

    }

    ?>

@stop