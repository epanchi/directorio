<?php
/* @var $this TiposproductoController */
/* @var $model Tiposproducto */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tiposproducto-form',
	'enableAjaxValidation'=>false,

)); ?>

	<?php echo Yii::app()->params['requerido']; ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'consorcios_id'); ?>
		<?php echo $form->dropDownList($model,'consorcios_id',
              //  CHtml::listData(Consorcios::model()->findAll(), 'id', 'description')
               CHtml::listData(Consorcios::model()->findAll('registros_id=?',array(Yii::app()->user->getState('REGISTROID'))), 'id', 'description'));?>
		<?php echo $form->error($model,'consorcios_id'); ?>
        <code>OCULTAR</code>
	</div>

    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => $model->isNewRecord ? 'primary' : 'info',
        'label' => $model->isNewRecord ? 'Guardar' : 'Save',
        'loadingText'=>'Verificando...',
        'htmlOptions'=>array('id'=>'buttonSave'),
    ));
    ?>
    <script>
        $('#buttonSave').click(function() {
            var btn = $(this);
            btn.button('loading'); // call the loading function
            setTimeout(function() {
                btn.button('reset'); // call the reset function
            }, 15000);
        });
    </script>

<?php $this->endWidget(); ?>

</div><!-- form -->