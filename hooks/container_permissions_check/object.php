$subtype = $params['subtype'];

switch ($subtype) {
	case 'blog':
	case 'image':
	case 'album':
		$approved = explode("\n", elgg_get_plugin_setting('posters', 'missions.compasschurch.org'));
		return in_array($params['user']->username, $approved);
	default:
		return NULL;
}
