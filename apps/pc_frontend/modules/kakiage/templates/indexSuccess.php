<div id="kakiages" class="parts">
<div class="partsHeading"><h3><?php echo date('Y-m-d (D)', strtotime($date)) ?></h3></div>

<div class="block prevNextLinkLine">
<p class="prev"><?php echo link_to(__('Prev Day'), '@kakiage_date?'.strftime('year=%Y&month=%m&day=%d', strtotime($date.' -1 day'))) ?></p>
<p class="next"><?php echo link_to(__('Next Day'), '@kakiage_date?'.strftime('year=%Y&month=%m&day=%d', strtotime($date.' +1 day'))) ?></p>
</div>

<div id="topEditLink" class="editLink"><?php echo link_to(__('Edit'), '@kakiage_edit') ?></div>

<?php foreach ($list as $item): ?>
<div id="id_<?php echo $item['Member']->getId() ?>" class="kakiage">
<?php if ($sf_user->getMemberId() === $item['Member']->getId()): ?>
<div class="editLink"><?php echo link_to(__('Edit'), '@kakiage_edit') ?></div>
<?php endif; ?>
<div class="kakiage_member"><?php echo op_link_to_member($item['Member']) ?></div>
<div class="kakiage_updated_at">(<?php echo __('Updated at') ?>: <?php echo op_format_date($item['updated_at'], 'XDateTimeJa') ?>)</div>
<div class="kakiage_body"><?php echo op_url_cmd(op_decoration(nl2br($item['body']))) ?></div>
</div>
<?php endforeach ?>

<div id="bottomEditLink" class="editLink"><?php echo link_to(__('Edit'), '@kakiage_edit') ?></div>

</div>
