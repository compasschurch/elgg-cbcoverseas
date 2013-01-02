<?php

$blogs = (int)$vars['blogs'];
$photos = (int)$vars['photos'];
$site = $vars['site'];
$user = $vars['user'];

?>
Hi, <?php echo $user->name; ?>!

There was activity recently on CBC Overseas:

New blogs: <?php echo $blogs; ?>
New photos: <?php echo $photos; ?>

Login at <?php echo $site->url; ?> to view them.

Thanks!
---
Email questions or problems to <?php echo $site->email; ?>.