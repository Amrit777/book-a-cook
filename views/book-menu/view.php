<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\BookMenu */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Book Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-menu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php if (!empty(Yii::$app->user->id) && User::isCook()){
        	if ($model->state_id == 1){
        		echo Html::a('Mark as Complete', ['state', 'id' => $model->id], ['class' => 'btn btn-primary']) ;
        	}elseif($model->state_id == 2){
        		echo Html::a('Waiting for payment', "#", ['class' => 'btn btn-primary']) ;
        	}elseif($model->state_id == 3){
        		echo Html::a('Payement DOne. Job Completed', "#", ['class' => 'btn btn-primary']) ;
        	}
        }elseif (!empty(Yii::$app->user->id) && User::isUser()){
        	if ($model->state_id == 1){
        		echo Html::a('Pay Your Cook. Once job is completed', ['pay', 'id' => $model->id], ['class' => 'btn btn-primary']);
        	}elseif ($model->state_id == 2){
        		echo Html::a('Pay Your Cook, Clicking on this button.', ['pay', 'id' => $model->id], ['class' => 'btn btn-primary']);
        	}elseif ($model->state_id == 3){
        		echo Html::a('Job completed', ['pay', 'id' => $model->id], ['class' => 'btn btn-primary']);
        	}
        	
        	}?>
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'menu_id',
            'booking_date',
            'booking_time',
            'number_of_person',
            'updated_on',
            'state_id',
            'type_id',
            'create_user_id',
        ],
    ]) ?>

</div>
