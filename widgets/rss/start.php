<?php
/* init file for rss widget */

function widget_rss_init() {
	// load SimplePie autoloader
	require_once(elgg_get_plugins_path() . "widget_manager/widgets/rss/vendors/simplepie/autoloader.php");

	elgg_register_widget_type("rss", elgg_echo("widgets:rss:title"), elgg_echo("widgets:rss:description"), "groups,index,profile,dashboard", true);

	// extend CSS
	elgg_extend_view("css/elgg", "widgets/rss/css");

}

// register widget init
elgg_register_event_handler("widgets_init", "widget_manager", "widget_rss_init");