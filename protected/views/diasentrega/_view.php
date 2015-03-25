<?php
/* @var $this DiasentregaController */
/* @var $data Diasentrega */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('frecuency')); ?>:</b>
	<?php echo CHtml::encode($data->frecuency); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rdate')); ?>:</b>
	<?php echo CHtml::encode($data->rdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('udate')); ?>:</b>
	<?php echo CHtml::encode($data->udate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dias_id')); ?>:</b>
	<?php echo CHtml::encode($data->dias_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('registros_id')); ?>:</b>
	<?php echo CHtml::encode($data->registros_id); ?>
	<br />

	*/ ?>

</div>