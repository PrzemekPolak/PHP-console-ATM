<?php

$coins = [
    500 => 1,
    200 => 3,
    100 => 5,
    50 => 10,
    20 => 20,
    10 => 200,
    5 => 100,
    2 => 100,
    1 => 10000,
];

$valuesToPayout = [];
$maxValue = 0;
foreach($coins as $coin => $amount) {
    $maxValue += $coin * $amount;
}

foreach ($argv as $argument) {
    if (is_numeric($argument)) {
        $valuesToPayout[] = $argument * 100;
    }
}

foreach ($valuesToPayout as $payout) {
    echo "\n\tDla reszty " . $payout / 100 . " zł:\n\n";
    $maxValue = $maxValue - $payout;
    if ($maxValue < 0) {
        echo "Nie ma tylu monet w banku\n";
        continue;
    }
    foreach ($coins as $coin => $amount) {
        if ($payout >= $coin) {
            $coinsNeeded = floor($payout / $coin);
            if ($coinsNeeded > $amount) {
                $coinsNeeded = $amount;
            }
            $payout -= $coinsNeeded * $coin;
            $denomination = $coin / 100 >= 1 ? "zł" : "gr";
            if ($denomination === "zł") {
                if ($coinsNeeded > 0) {
                    echo "Wydaj " . $coinsNeeded . " monet " . $coin / 100 . " " . $denomination . "\n";
                }
            } else {
                if ($coinsNeeded > 0) {
                    echo "Wydaj " . $coinsNeeded . " monet " . $coin . " " . $denomination . "\n";
                }
            }
            $coins[$coin] -= $coinsNeeded;
        }
    }
}

?>
