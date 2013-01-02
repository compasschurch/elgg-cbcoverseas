<?php


$mailer = new Evan_Email_ElggSender();
$clock = new Evan_SystemClock();
$db = new Evan_Db_Mysql();

$site = elgg_get_site_entity();
$views = new Evan_ViewService();
$i18n = new Evan_I18n();
$emailFactory = new Cbcoverseas_Digest_EmailFactory($clock, $site, $views, $db, $i18n);

$notifier = new Cbcoverseas_Digest_Notifier($mailer, $clock, $db, $emailFactory);

$notifier->hourly();