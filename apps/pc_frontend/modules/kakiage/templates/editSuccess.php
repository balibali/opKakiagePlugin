<?php
$form->getWidget('body')->setAttribute('rows', 15);
$form->getWidget('body')->setAttribute('cols', 40);

$options = array(
  'url'   => url_for('@kakiage_update_date?'.strftime('year=%Y&month=%m&day=%d', strtotime($date))),
  'title' => date('Y-m-d (D)', strtotime($date)),
);

op_include_form('kakiageForm', $form, $options);
?>

<?php if ($previous): ?>
<div id="id_<?php echo $previous['Member']->getId() ?>" class="kakiage">
<div class="kakiage_date"><?php echo $previous['target_date'] ?></div>
<div class="editLink"><?php echo link_to(__('Edit'), '@kakiage_edit_date?'.strftime('year=%Y&month=%m&day=%d', strtotime($previous['target_date']))) ?></div>
<div class="kakiage_updated_at">(<?php echo __('Updated at') ?>: <?php echo op_format_date($previous['updated_at'], 'XDateTimeJa') ?>)</div>
<textarea cols="50" rows="20" class="kakiage_body"><?php echo $previous['body'] ?></textarea>
</div>
<?php endif ?>

<div class="parts">
<?php echo link_to(__('Index'), '@kakiage_date?'.strftime('year=%Y&month=%m&day=%d', strtotime($date))) ?>
</div>
