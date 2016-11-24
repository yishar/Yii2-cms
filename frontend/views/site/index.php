<?php

/* @var $this yii\web\View */

$this->title = 'Anthony-cms';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <?php
            $noticia = common\models\Noticia::find()->all();
            foreach ($noticia as $key => $valueNoticia):
            ?>
            
            
            
            <h4 >
                <a href="<?= \yii\helpers\Url::to(['noticia/'. $valueNoticia->seo_slug]) ?>">
                <?= $valueNoticia->titulo?>
                </a>
            </h4>
            
            <?php endforeach; ?>
            
       </div>   
    </div>
</div>
