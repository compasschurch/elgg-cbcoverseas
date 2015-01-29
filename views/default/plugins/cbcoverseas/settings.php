<?php

$plugin = $vars['plugin'];

global $EVAN;

$emailFactory = $EVAN->get('Cbcoverseas\Digest\EmailFactory');
?>

<div class="elgg-input-wrapper">
	<label><?php echo elgg_echo('object:plugin:cbcoverseas:posters:label'); ?></label><br/>
	<textarea name="params[posters]" class="elgg-input-textarea"><?php echo $plugin->posters; ?></textarea>
</div>

<?php $recentUsers = $emailFactory->getMostRecentlyNotifiedUsers(50); ?>

Last <?php echo count($recentUsers); ?> users to receive a digest:
<table class="elgg-table">
	<thead>
		<tr>
			<th>User</th>
			<th>Digest Time</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($recentUsers as $user): ?>
		<tr>
			<td>
				<?php echo elgg_view('output/url', array(
					'text' => $user->name,
					'href' => $user->getUrl(),
				)); ?>
			</td>
			<td><?php echo date('r', $user->cbc_last_digest_time); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php $upcomingUsers = $emailFactory->getUsers(50); ?>

Next <?php echo count($upcomingUsers); ?> users slated to receive a digest:
<table class="elgg-table">
	<thead>
		<tr>
			<th>User</th>
			<th>Last Digest Time</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($upcomingUsers as $user): ?>
		<tr>
			<td>
				<?php echo elgg_view('output/url', array(
					'text' => $user->name,
					'href' => $user->getUrl(),
				)); ?>
			</td>
			<td><?php echo date('r', $user->cbc_last_digest_time); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
