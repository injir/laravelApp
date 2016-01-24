@extends('layouts.main')
@section('content')
    @parent
    <h1><a href="/admin/works/create">Create</a></h1>
    <?php

    foreach($model as $item){
        ?>

        <article class="work">
            <a href = "/admin/works/update/<?php echo $item->id?>">Update</a>
            <a href = "/admin/works/delete/<?php echo $item->id?>">Delete</a>
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