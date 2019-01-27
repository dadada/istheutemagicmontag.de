<?php
// See http://php.net/manual/en/function.strftime.php

function isMonday($timestamp) {
	// %u - ISO-8601 numeric representation of the day of the week
	return strftime("%u", $timestamp) == 1;
}

function isEvenCalendarWeek($timestamp) {
	// %V - ISO-8601:1988 week number of the given year.
	$calendarWeek = strftime("%-V", $timestamp);
	return $calendarWeek % 2 == 0;
}

function isMagicMonday($timestamp = null) {
	if($timestamp == null) {
		$timestamp = time();
	}

	return isMonday($timestamp) && isEvenCalendarWeek($timestamp);
}

function nextMagicMonday() {
	$dateToCheck = time();
	$nextMagicMonday = null;
	do {
		$dateToCheck = strtotime("next Monday", $dateToCheck);	
		if(isMagicMonday($dateToCheck)) {
			$nextMagicMonday = $dateToCheck;
		}
	} 
	while($nextMagicMonday == null);

	return $nextMagicMonday;
}
?>
<!doctype html>
<html>
	<head>
		<title>Ist heute Magic-Montag?</title>
		<style>
			html { text-align: center; }
			.answer { font-size: 12em; }
		</style>
	</head>
	<body>
		<h1>Ist heute Magic-Montag?</h1>
		<div class="answer">
			<?php echo isMagicMonday() ? "Ja" : "Nein"; ?>

		</div>
		<div>
			Magic-Montag ist wieder am <?php echo strftime("%d.%m.%Y (KW %-V)", nextMagicMonday()); ?>.
		</div>
		<br>
		<a href="faq.html">FAQ</a>
	</body>
</html>
