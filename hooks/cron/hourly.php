<?php

global $EVAN;

// Limit on number of users to respect hosting rate limits.
$usersPerHour = 50;
$emailFactory = new Cbcoverseas_Digest_EmailFactory(
    $EVAN->clock, elgg_get_site_entity(), $EVAN->views, $EVAN->db, $EVAN->i18n);

$users = $emailFactory->getUsers($usersPerHour);

foreach ($users as $user) {
    $EVAN->mailer->send($emailFactory->createForUser($user));
}