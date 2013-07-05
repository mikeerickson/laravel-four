<?php

$I = new TestGuy($scenario);
$I->wantTo('verify lacrosse on the home page');
$I->amOnPage('/');
$I->see('Lacrosse');