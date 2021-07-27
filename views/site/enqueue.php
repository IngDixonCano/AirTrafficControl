<?php

/* @var $this yii\web\View */

use app\modules\api\models\Aircraft;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\modules\api\models\Type;
use app\modules\api\models\Size;

$this->title = 'Enqueue';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-enqueue">

    <div class="row">
        <div class="col-sm-6">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                Add an AC to the queue
            </p>

            <?php $form = ActiveForm::begin(['id' => $aircraft->formName()]); ?>

            <?= $form->field($aircraft, 'type_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(Type::find()->all(), 'id', 'name'),
                ['prompt' => 'Choose one']
            ); ?>

            <?= $form->field($aircraft, 'size_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(Size::find()->all(), 'id', 'name'),
                ['prompt' => 'Choose one']
            ); ?>

            <div class="form-group">
                <?= Html::submitButton('Enqueue', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

        <div class="col-sm-6">

            <h1><?= Html::encode('Dequeue') ?></h1>

            <p>
                Remove an AC from the queue based on priority
            </p>

            <?php $form = ActiveForm::begin(['id' => 'dequeueForm']); ?>

            <div class="form-group">
                <?= Html::submitButton('Dequeue', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

        <div class="col-sm-12">
            <hr>
            <p>
                Provide the current order of the AC in the queue
            </p>

            <?php \yii\widgets\Pjax::begin([
                'id' => 'pjaxwidget',
                'enablePushState' => FALSE
            ]); ?>

            <?php

            $dataProvider = new ActiveDataProvider([
                'query' => Aircraft::find(),
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);

            echo GridView::widget([
                'id' => 'list',
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    [
                        'attribute' => 'type_id',
                        'value' => function ($model, $index, $dataColumn) {
                            return $model->type->name;
                        }
                    ],
                    [
                        'attribute' => 'size_id',
                        'value' => function ($model, $index, $dataColumn) {
                            return $model->size->name;
                        }
                    ],
                    [
                        'attribute' => 'state',
                        'value' => function ($model, $index, $dataColumn) {
                            return $model->state == 0 ? 'Enqueue' : 'Dequeue';
                        }
                    ],
                    'date'
                ],
            ]);
            ?>

            <?php \yii\widgets\Pjax::end(); ?>

        </div>
    </div>

</div>

<?php

$script = <<< JS

$('form#{$aircraft->formName()}').on('beforeSubmit', function(e)
{
    var \$form = $(this);

    console.log("data:", \$form.serialize());

    toastr.options = {
        "closeButton": true,
        "preventDuplicates": true,
        "timeOut": "10000",
        "extendedTimeOut": "1000",
        "positionClass": "toast-top-right"
    }

    $.post(
        'index.php?r=api/aircraft/enqueue ',
        \$form.serialize()
    )

    .done(function(result){
        console.log("result:", result);
        if (result.status == 200) {
            toastr.success(result.detail);
            \$form.trigger("reset");
            $.pjax.reload({container:'#pjaxwidget'});
            //$.pjax.reload({container:'#pjaxForm'});
        } else {
            toastr.error(result.detail);
        }
    })
    
    .fail(function(){
        console.log('Server error!');  
        toastr.error('An error has occurred!');
    });

    return  false;
});


$('form#dequeueForm').on('beforeSubmit', function(e)
{
    var \$form = $(this);

    toastr.options = {
        "closeButton": true,
        "preventDuplicates": true,
        "timeOut": "10000",
        "extendedTimeOut": "1000",
        "positionClass": "toast-top-right"
    }

    $.post(
        'index.php?r=api/aircraft/dequeue ',
        \$form.serialize()
    )

    .done(function(result){
        console.log("result:", result);
        if (result.status == 200) {
            toastr.success(result.detail);
            \$form.trigger("reset");
            $.pjax.reload({container:'#pjaxwidget'});
            //$.pjax.reload({container:'#pjaxForm'});
        } else {
            toastr.error(result.detail);
        }
    })
    
    .fail(function(){
        console.log('Server error!');  
        toastr.error('An error has occurred!');
    });

    return  false;
});

JS;
$this->registerJs($script);
?>