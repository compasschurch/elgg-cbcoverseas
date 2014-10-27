<?php

$plugin = $vars['plugin'];

global $EVAN;

$emailFactory = $EVAN->get('Cbcoverseas\Digest\EmailFactory');
$users = $emailFactory->getUsers(50);
?>

<div class="elgg-input-wrapper">
	<label><?php echo elgg_echo('object:plugin:cbcoverseas:posters:label'); ?></label><br/>
	<textarea name="params[posters]" class="elgg-input-textarea"><?php echo $plugin->posters; ?></textarea>
</div>

Next <?php echo count($users); ?> users slated to receive a digest:
<table class="elgg-table">
	<thead>
		<tr>
			<th>User</th>
			<th>Last Digest Time</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo elgg_view('output/text', array('value' => $user->name)); ?></td>
			<td><?php echo elgg_view('output/date', array('value' => $user->cbc_last_digest_time)); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
