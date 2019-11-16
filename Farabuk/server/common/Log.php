<?php

require_once __DIR__ . '/Colors.php';
use Colors\Colors;

class Log {
	public static function msg($message, $type = 'ERROR', $output = 0) {
		$colors = new Colors();
		$color = '';

		switch(strtolower($type)) {
			case 'error':
			case 'err':
			case 'er':
			case 'e':
				$color = 'red';
				break;
			case 'warning':
			case 'warn':
			case 'war':
			case 'w':
				$color = 'yellow';
				break;
			case 'debug':
			case 'dbg':
			case 'd':
				$color = 'green';
				break;
			case 'system':
			case 'nocolor':
			case 'nc':
				$color = '';
				break;
			default:
				$message = 'UNKNOWN TYPE OF LOG MESSAGE!';
				$color = 'red';
				$type = 'error';
		}

		$pretty_type = '[' . strtoupper($type) . ']';
		error_log($colors->getColoredString($pretty_type . ': ' . $message, $color), $output);
	}
}
