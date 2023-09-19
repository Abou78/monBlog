<?php
/* @var string $title */
?>

<h1><?= $title; ?></h1>
<div>Add your first handler as above:</div>

<pre>
    <code lang="php">
        $router->get('/', function() {
        echo 'Home Page';
        });
    </code>
</pre>