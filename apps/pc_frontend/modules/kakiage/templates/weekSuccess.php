<div id="kakiages" class="parts">
<div class="partsHeading"><h3><?php echo __('Weekly List') ?></h3></div>

<?php foreach ($list as $item): ?>
<div id="id_<?php echo $item['target_date'] ?>" class="kakiage">
<div class="kakiage_member"><?php echo date('Y-m-d (D)', strtotime($item['target_date'])) ?></div>
<div class="kakiage_updated_at">(<?php echo __('Updated at') ?>: <?php echo op_format_date($item['updated_at'], 'XDateTimeJa') ?>)</div>
<div class="kakiage_body"><?php echo op_url_cmd(op_decoration(nl2br($item['body']))) ?></div>
</div>
<?php endforeach ?>

</div>

<div class="parts">
<?php echo link_to(__('Index'), '@kakiage_index') ?>
</div>
