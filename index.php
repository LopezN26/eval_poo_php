<?php

require_once 'lib/main.php';
require_once 'lib/agenda.php';
require_once 'lib/events.php';
require_once 'lib/people.php';
require_once 'lib/bdd.php';


//var_dump(Agenda::findOne(['name'=>'1stAgenda']));
//var_dump(People::findOne(['name'=>"joe"]));

var_dump(Events::findOne(['duration'=>'180'])->allPeople());

$joe=People::findOne(['name'=>'joe']);
var_dump($joe->getAllEvents(['date'=>'2020-03-06']));

//var_dump(People::findOne(['name'=>'joe']));


