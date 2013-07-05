<?php

$I = new TestGuy($scenario);
$I->wantTo('verify Erickson on contacts edit'); // NOTE: Note this
$I->amOnPage('/contacts/93/edit'); // TODO: Test this
$I->see('Last Name:'); // BUG:  Fix this!