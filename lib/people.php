<?php

require_once 'lib/main.php';
require_once 'lib/bdd.php';

class People extends Main
{
    protected $id=null;
    protected $name=null;
    protected $tablename='People';

    public function getAllEvents($filters=[])
    {
        $db = BDD::getConnexion();
        $clauses = [];
        foreach ($filters as $key => $value) {
            if ($key!='date')
            {
                $clauses[] = $key . "=" . $db->quote($value);
            }
            else
            {
                $clauses[]= "DATE(dateTime)=". $db->quote($value);
            }
        }
        $where = "";
        if (!empty($clauses)) {
            $where = " WHERE " . implode(" AND ", $clauses);
        }
        var_dump($where);
        $query= 'SELECT events.* FROM events INNER JOIN event_people ON events.id=event_people.idEvent INNER JOIN people ON event_people.idPeople=people.id'.$where;
        var_dump($query);
        $request = $db->query($query);
        return $request->fetchAll(PDO::FETCH_CLASS, 'People');
    }
}