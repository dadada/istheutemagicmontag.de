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
			<h2>
				Ist heute Magic-Montag?
			</h2>

			<div class="display-1 center">
			<?php echo isMagicMonday() ? "Ja" : "Nein"; ?>
			</div>
			<div class="container-fluid">
				Magic-Montag ist wieder am <?php echo strftime("%d.%m.%Y (KW %-V)", nextMagicMonday()); ?>.
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<h5>
					Wo treffen wir uns?
				</h5>
				</div>
				<div class="col-sm-8">
						Im IZ Raum 358.
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<h5>
					Wann treffen wir uns?
				</h5>
				</div>
				<div class="col-sm-8">
					Alle 14 Tage in geraden Kalenderwochen um 17 Uhr.
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<h5>Wo kann ich Fragen stellen?</h5>
				</div>
				<div class="col-sm-8">
					Komm in den Matrix-Room: <a href="https://matrix.to/#/#fgmtg:stratum0.org" target="_blank">#fgmtg:stratum0.org</a>.
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<h5>
						Muss ich die Regeln kennen?
					</h5>
				</div>
			<div class="col-sm-8">
					Nein, wir bringen dir gerne bei, wie man spielt.
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<h5>
						Muss ich ein Deck mitbringen?
					</h5>
				</div>
				<div class="col-sm-8">
					Nein, es sind mehr als genug Decks vorhanden.
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<h5>
						Welches Format wird gepielt?
					</h5>
				</div>
				<div class="col-sm-8">
					Alles m&ouml;gliche: Modern, Standard, Commander und Pauper Decks waren schonmal anwesend.
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
						<h5>Sind Proxies erlaubt?</h5>
				</div>
				<div class="col-sm-8">
					Klar, alles was Spa&szlig; macht.
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
						<h5>Kann ich zu dieser Seite beitragen?</h5>
				</div>
				<div class="col-sm-8">
					Der Code befindet sich auf <a href="https://github.com/ngrash/istheutemagicmontag.de">GitHub</a> und Pull-Requests sind erw&uuml;nscht.
				</div>
			</div>






			<h3></h3>


		</div>

		<br>
		<a href="faq.html">FAQ</a>
	</body>
</html>
