<?php

require_once 'lib/main.php';
require_once 'lib/bdd.php';

class Events extends Main
{
    protected $id=null;
    protected $title=null;
    protected $dateTime=null;
    protected $duration=null;
    protected $tablename='Events';


    public function allPeople()
    {

        $db = BDD::getConnexion();
        $query= 'SELECT people.* FROM people INNER JOIN event_people ON event_people.idPeople=people.id INNER JOIN events ON events.id=event_people.idEvent WHERE event_people.idEvent='.$this->id;
        var_dump($query);
        $request = $db->query($query);
        return $request->fetchAll(PDO::FETCH_CLASS, 'People');

    }
}