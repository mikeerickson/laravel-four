<?php

$I = new TestGuy($scenario);
$I->wantTo('verify Baseball on the home page');
$I->amOnPage('/');
$I->see('Baseball');