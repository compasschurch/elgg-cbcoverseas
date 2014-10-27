<?php

$blogs = (int)$vars['blogs'];
$photos = (int)$vars['photos'];
$messages = (int)$vars['messages'];

$site = $vars['site'];
$user = $vars['user'];

?>
Hi, <?php echo $user->name; ?>!

There was activity recently on CBC Overseas:

<?php if ($blogs > 0): ?>
New blogs: <?php echo $blogs; ?> 
<?php endif; ?>
<?php if ($photos > 0): ?>
New photos: <?php echo $photos; ?> 
<?php endif; ?>
<?php if ($messages > 0): ?>
New messages: <?php echo $messages; ?> 
<?php endif; ?>

Login at <?php echo $site->url; ?> to view them.

Thanks!
---
Email questions or problems to <?php echo $site->email; ?>.
