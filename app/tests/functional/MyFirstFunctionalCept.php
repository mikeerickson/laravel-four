<?php
$I = new TestGuy($scenario);
$I->wantTo('verify the home page');
$I->amOnPage('/');
$I->see('Lacrosse');