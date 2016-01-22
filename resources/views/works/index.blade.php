@extends('layouts.main')
@section('content')
    @parent
    <?php
    foreach($works as $item){
        ?>
        <article class="work">
            <header class="work-header">
                <img src="<?php echo $item->image?>" />
                <h1><?php echo $item->title ?></h1>
            </header>
            <div class="work-content">
                <p><?php echo $item->text?></p>
                <h2>Skills used:</h2>
                <ul class="tags">
                    <li class="html">HTML</li>
                    <li class="css">CSS</li>
                    <li class="js">JavaScript</li>
                </ul>
            </div>
        </article>
    <?php

    }

    ?>

    @stop