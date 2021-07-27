<?php

/* @var $this yii\web\View */

use app\modules\api\models\Aircraft;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

$this->title = 'List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-list">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Provide the current order of the AC in the queue
    </p>

    <div class="row">
        <div class="col-lg-12">

            <?php

            echo GridView::widget([
                'id' => 'list',
                'dataProvider' => $dataProvider,
            ]);

            ?>

        </div>
    </div>

</div>