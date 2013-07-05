<?php

$I = new TestGuy($scenario);
$I->wantTo('verify softball on the home page');
$I->amOnPage('/');
$I->see('Softball');