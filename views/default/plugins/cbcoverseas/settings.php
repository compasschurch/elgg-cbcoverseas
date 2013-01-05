<?php

$plugin = $vars['plugin'];

global $EVAN;

$emailFactory = new Cbcoverseas_Digest_EmailFactory(
    $EVAN->clock, elgg_get_site_entity(), $EVAN->views, $EVAN->db, $EVAN->i18n);

?>

<div class="elgg-input-wrapper">
	<label><?php echo elgg_echo('object:plugin:cbcoverseas:posters:label'); ?></label><br/>
	<textarea name="params[posters]" class="elgg-input-textarea"><?php echo $plugin->posters; ?></textarea>
</div>

Next 50 users slated to receive a digest:
<table class="elgg-table">
    <thead>
        <tr>
            <td>User</td>
            <td>Last Digest Time</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($emailFactory->getUsers(50) as $user): ?>
        <tr>
            <td><?php echo elgg_view('output/text', array('value' => $user->name)); ?></td>
            <td><?php echo elgg_view('output/date', array('value' => $user->cbc_last_digest_time)); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>