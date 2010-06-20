<div id="kakiages" class="parts">
<?php foreach ($list as $item): ?>
<div class="kakiage">
<div class="kakiage_member"><?php echo op_link_to_member($item['Member']) ?></div>
<div class="kakiage_body"><?php echo op_url_cmd(op_decoration(nl2br($item['body']))) ?></div>
<div class="kakiage_updated_at">(<?php echo __('Updated at') ?>: <?php echo op_format_date($item['updated_at'], 'XDateTimeJa') ?>)</div>
</div>
<?php endforeach ?>
</div>

<div class="parts">
<?php echo link_to(__('Edit'), 'kakiage/edit') ?>
</div>
