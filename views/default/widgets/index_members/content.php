<?php

$widget = $vars["entity"];

$count = sanitise_int($widget->member_count , false);
if (empty($count) || $count < 1 || $count > 10) {
	$count = 10;
}

$site = elgg_get_site_entity();

if (class_exists("ESInterface")) {
	$results = ESInterface::get()->search("*", SEARCH_DEFAULT, "user", [], $count, 0, "name", "asc");

	if (count($results["hits"]) > 0) {
		$result = elgg_view_entity_list($results["hits"], [
			"type" => "user",
			"limit" => $count,
			"full_view" => false,
			"pagination" => false,
			"list_type" => "users",
			"gallery_class" => "elgg-gallery-users",
			"size" => "small"
		]);
	} else {
		$result = elgg_echo("widget_manager:widgets:index_members:no_result");
	}
} else {
	$options = array(
		"type" => "user",
		"limit" => $count,
		"relationship" => "member_of_site",
		"relationship_guid" => elgg_get_site_entity()->getGUID(),
		"inverse_relationship" => true,
		"full_view" => false,
		"pagination" => false,
		"list_type" => "users",
		"gallery_class" => "elgg-gallery-users",
		"size" => "small"
	);

	if ($widget->user_icon == "yes") {
		$options["metadata_name"] = "icontime";
	}

	$result = elgg_list_entities_from_relationship($options);
	if (!$result) {
		$result = elgg_echo("widget_manager:widgets:index_members:no_result");
	}
}

echo $result;
