<?php
$d = new DateTime('2018-01-01');
$d->modify('+7days');
echo $d->format('Y-m-d')."\n";

