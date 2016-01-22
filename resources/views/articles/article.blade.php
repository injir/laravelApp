@extends('layouts.main')
@section('content')
    @parent
        <section class="article-view">
            <article>
                <div class="article-content">
                    <h2> <?php echo $article->title ?></h2>
                    <p>
                        <?php echo $article->text ?>
                    <h1>Code Blocks</h1>

<pre class="codeblock html"><code>
        &lt;pre class=&quot;html&quot;&gt;&lt;code&gt;
        &lt;!doctype html&gt;
        &lt;html lang=&quot;en&quot;&gt;
        &lt;head&gt;
        &lt;meta charset=&quot;UTF-8&quot;&gt;
        &lt;title&gt;Document&lt;/title&gt;
        &lt;/head&gt;
        &lt;body&gt;

        &lt;/body&gt;
        &lt;/html&gt;
        &lt;/code&gt;&lt;/pre&gt;
    </code></pre>

<pre class="codeblock cpp"><code>
        .css:before { content: "CSS";  }
        .html:before { content: "HTML"; }
        .javascript:before { content: "JavaScript"; }
        .jquery:before { content: "jQuery"; }
        .php:before { content: "PHP"; }
        .scss:before { content: "SCSS"; }
        .sublime-snippet:before { content: "Sublime Snippet"; }
    </code></pre>
                    </p>
                </div>
            </article>
        </section>
@stop