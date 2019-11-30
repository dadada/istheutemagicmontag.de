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
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<title>Ist heute Magic-Montag?</title>
		<style>
			html { text-align: center; }
			.answer { font-size: 12em; }


			{
				display: flex;
		    align-items: flex-end;
			}
		</style>
	</head>
	<body>
		<div class="jumbotron">
			<div class="container">
				<h2>Ist heute Magic-Montag?</h2>
				<div class="display-1">
					<?php echo isMagicMonday() ? "Ja" : "Nein"; ?>
				</div>
				<div>
					Magic-Montag ist wieder am <?php echo strftime("%d.%m.%Y (KW %-V)", nextMagicMonday()); ?>.
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<h5>Wo treffen wir uns?</h5>
				</div>
				<div class="col-lg-8">
					<p>Im IZ Raum 358.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<h5>Wann treffen wir uns?</h5>
				</div>
				<div class="col-lg-8">
					<p>Alle 14 Tage in geraden Kalenderwochen um 17 Uhr.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<h5>Wo kann ich Fragen stellen?</h5>
				</div>
				<div class="col-lg-8">
					<p>Komm in den Matrix-Room: <a href="https://matrix.to/#/#fgmtg:stratum0.org" target="_blank">#fgmtg:stratum0.org</a>.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<h5>Muss ich die Regeln kennen?</h5>
				</div>
				<div class="col-lg-8">
					<p>Nein, wir bringen dir gerne bei, wie man spielt.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<h5>Muss ich ein Deck mitbringen?</h5>
				</div>
				<div class="col-lg-8">
					<p>Nein, es sind mehr als genug Decks vorhanden.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<h5>Welches Format wird gespielt?</h5>
				</div>
				<div class="col-lg-8">
					<p>Alles m&ouml;gliche: Modern, Standard, Commander und Pauper Decks waren schonmal anwesend.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<h5>Sind Proxies erlaubt?</h5>
				</div>
				<div class="col-lg-8">
					<p>Klar, alles was Spa&szlig; macht.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<h5>Kann ich zu dieser Seite beitragen?</h5>
				</div>
				<div class="col-lg-8">
					<p>Der Code befindet sich auf <a href="https://github.com/ngrash/istheutemagicmontag.de">GitHub</a> und Pull-Requests sind erw&uuml;nscht.</p>
				</div>
			</div>
		</div>
	</body>
</html>
