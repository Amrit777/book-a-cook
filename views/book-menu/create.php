<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BookMenu */

$this->title = 'Create Book Menu';
$this->params['breadcrumbs'][] = ['label' => 'Book Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
