@extends('layouts.adminLayout')
@section('content')
    @parent


  <form method="post">

      <input type = "text" name="title" value="<?php echo $article ? $article->title : false ; ?>">

     <textarea id="editor_area" name="text">
         <?php echo $article ? $article->text : false ; ?>
     </textarea>
      <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
      <input type="submit" value="Создать">

  </form>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replaceAll();
    </script>

@stop