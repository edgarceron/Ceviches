<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="row">
        <?php echo $form->label($model, 'referencia'); ?>
        <?php echo $form->textField($model, 'referencia', array('size' => 20, 'maxlength' => 20)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'descripcion'); ?>
        <?php echo $form->textField($model, 'descripcion', array('size' => 60, 'maxlength' => 200)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'costo'); ?>
        <?php echo $form->textField($model, 'costo'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'precio'); ?>
        <?php echo $form->textField($model, 'precio'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->