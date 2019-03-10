<?php
use yii\widgets\ListView;
use yii\widgets\Pjax;
?>
<?php Pjax::begin(['enablePushState' => false]);?>
<?php
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '/post/_list',
    'summary' => false,
    'layout' => '{items}<div class="custom_pgn">{pager}</div>',
    'pager' => [
        'linkOptions' => [
            'class' => 'pgn__num'
        ]
    ]
]);
?>
<?php Pjax::end();?>

