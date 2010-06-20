<?php
$form->getWidget('body')->setAttribute('rows', 15);
$form->getWidget('body')->setAttribute('cols', 40);

$options['url'] = url_for('kakiage/update');

op_include_form('kakiageForm', $form, $options);
?>

<div class="parts">
<?php echo link_to(__('Index'), 'kakiage/index') ?>
</div>
