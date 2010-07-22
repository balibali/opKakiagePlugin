<?php
$form->getWidget('body')->setAttribute('rows', 15);
$form->getWidget('body')->setAttribute('cols', 40);

$options = array(
  'url'   => url_for('@kakiage_update_date?'.strftime('year=%Y&month=%m&day=%d', strtotime($date))),
  'title' => date('Y-m-d (D)', strtotime($date)),
);

op_include_form('kakiageForm', $form, $options);
?>

<div class="parts">
<?php echo link_to(__('Index'), '@kakiage_date?'.strftime('year=%Y&month=%m&day=%d', strtotime($date))) ?>
</div>
