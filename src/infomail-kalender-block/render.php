<?php

/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

/* Attributes: startDate, endDate (Both strings in the format `2026-04-01T20:03:46`) */

$start_raw = isset($attributes['startDate']) ? (string) $attributes['startDate'] : '';
$end_raw   = isset($attributes['endDate']) ? (string) $attributes['endDate'] : '';
$ical_url = 'https://chischte.oberfeld.be/remote.php/dav/public-calendars/Mr282TY3ekfKGPNF/?export';

// Expecting values like: 2026-04-01T20:03:46 (or compatible ISO date strings).
$start_ts = strtotime($start_raw);
$end_ts   = strtotime($end_raw);

if (! $start_ts || ! $end_ts) {
	return '<p>Infomail-Kalender-Block: Bitte Start- und Enddatum setzen.</p>';
}

// Ical parsing
require_once __DIR__ . '/vendor/autoload.php';

use ICal\ICal;

$ical_content = fetch_ical_cached($ical_url);

$ical = new ICal(false, array(
	'defaultTimeZone'       => 'Europe/Zurich',
));

try {
	$ical->initString($ical_content);
} catch (Exception $e) {
	return '<p>Infomail-Kalender-Block: Fehler beim Laden des Kalenders.</p>';
}

// Filter events by date range
$events = $ical->eventsFromRange($start_raw, $end_raw);

// Table output
$html = '<div class="infomail-kalender">';
$html .= '<table class="infomail-kalender-table"><tbody>';

foreach ($events as $event) {
	$event_start = $ical->iCalDateToDateTime($event->dtstart);

	$date = wp_date('j. F', $event_start->getTimestamp());
	$time = wp_date('H:i', $event_start->getTimestamp());

	// Remove midnight deadlines
	if ($time === '00:00') {
		$time = '';
	}

	$title = esc_html($event->summary ?? '???');

	$html .= '<tr>';
	$html .= '<td class="infomail-kalender-date">' . $date . '</td>';
	$html .= '<td class="infomail-kalender-time">' . $time . '</td>';
	$html .= '<td class="infomail-kalender-title">' . $title . '</td>';
	$html .= '</tr>';
}

$html .= '</tbody></table>';
$html .= '</div>';

echo $html;


if (! function_exists('fetch_ical_cached')) {
	function fetch_ical_cached(string $url)
	{
		$cache_key = 'ical_' . hash('sha256', $url);
		$cached    = get_transient($cache_key);

		if ($cached !== false) {
			return $cached;
		}

		$request = wp_remote_get($url);
		$body = wp_remote_retrieve_body($request);

		set_transient($cache_key, $body, 600);
		return $body;
	}
}
