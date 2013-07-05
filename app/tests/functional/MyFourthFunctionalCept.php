<?php

$I = new TestGuy($scenario);
$I->wantTo('verify companies listing');
$I->amOnPage('/companies');
$I->see('New Company');