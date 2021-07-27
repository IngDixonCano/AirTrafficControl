<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Dequeue';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-list">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Remove an AC from the queue based on priority
    </p>

    <div class="row">
        <div class="col-lg-12">

            <?php \yii\widgets\Pjax::begin([
                'id' => 'pjaxwidget',
                'enablePushState' => FALSE
            ]); ?>
            <?php

            echo GridView::widget([
                'id' => 'list',
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'type_id',
                    'size_id',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        /*'value' => function ($data) {
                            return '';
                        },*/
                        'template' => '{Dequeue}',  // the default buttons + your custom button
                        'buttons' => [
                            'Dequeue' => function ($url, $model, $key) {     // render your custom button
                                return '<form id="dequeue' . $model->id . '" method="post">
                                <input type="hidden" value=' . $model->id . ' id="aircraft-id" name="Aircraft[id]">
                                <button type="button" class="btn btn-primary" name="contact-button" onclick="dequeue(' . $model->id . ');">Dequeue</button>
                                </from>';
                            }
                        ]
                    ],
                ],
            ]);

            ?>

            <?php \yii\widgets\Pjax::end(); ?>

        </div>
    </div>

</div>