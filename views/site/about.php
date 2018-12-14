<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the SCMA Interactive Student Handbook CMS. This CMS powers an API that can be consumed by mobile and/or frontend applications.
        Text and Media content can be queried via this API.
    </p><br>
    <p>
        <h4>API Documentation</h4>
        <p>
            The API primarily provides information about posts and media. To query the api, a <kbd>GET</kbd> request to the corresponding api
            endpoint in the following format is required. The post, media, category info and tags will all be forwarded by the API.
            <br>
            <code>http://{hostname:port}/api/post?key={API_KEY}</code>
            <br>
            <a href="/api/post?key=491a5964c727c39f54d2be9ddf18028c" class="btn btn-default btn-sm" target="_blank"><kbd>GET</kbd> all posts</a>
        </p>
    <hr>
        <p>
            To get data on a specific post, the request has to be formatted as follows. The relevant post, associated media, category info and tags will all be forwarded by the API.
            <br>
            <code>http://{hostname:port}/api/post/view?id={id}&key={API_KEY}</code>
            <br>
            <a href="/api/post/view?id=2&key=491a5964c727c39f54d2be9ddf18028c" class="btn btn-default btn-sm" target="_blank"><kbd>GET</kbd> post with ID = 2</a>
        </p>
    </p>


</div>
