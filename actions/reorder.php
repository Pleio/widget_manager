<?php

$guid = get_input('guid');
$order = get_input('elgg-object');

$widget = get_entity($guid);

if (!$widget) {
    register_error('Widget does not exists.');
    forward(REFERER);
}

if (!$widget->canEdit()) {
    register_error('Could not edit widget.');
    forward(REFERER);
}

$widget->content_order = array_flip($order);

if ($widget->save()) {
    system_message('Order is saved.');
}