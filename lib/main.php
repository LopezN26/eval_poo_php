<?php
require_once 'bdd.php';


class Main
{
    public function __construct($id=null)
    {
        if (!empty($id)) {

            // requete BDD get properties for $id
            $db = BDD::getConnexion();
            $query='SELECT * FROM '.$this->tablename.' WHERE id='.$id;
            var_dump($query);
            $inst = $db->query($query);

            $result = $inst->fetch(PDO::FETCH_ASSOC);
            //on récupère les données requete et on les affect a ce propre objet
            foreach ($result as $k=>$v)
            {
                $this->$k = $v;
            }
        }
    }

    public static function findOne($filters=[])
    {

        $db = BDD::getConnexion();
        $clauses = [];
        foreach ($filters as $k=>$v)
        {
            $clauses[]= $k."=".$db->quote($v);
        }
        $where ="";
        if (!empty($filters))
        {
            $where = "WHERE ".implode(" AND ",$clauses);
        }
        $query= 'SELECT * FROM '.lcfirst(get_called_class()).' '.$where;
        var_dump($query);
        $request=$db->query($query);
        $request->setFetchMode(PDO::FETCH_CLASS, get_called_class()); //indique a fetch comment fetch, ici en créer un objet via la classe parcAuto
        return $request->fetch();
    }

    /*public static function findAll($filters=[])

    {
        $db = BDD::getConnexion();
        $clauses = [];
        foreach ($filters as $key => $value) {
            $clauses[] = $key . "=" . $db->quote($value);
        }
        $where = "";
        if (!empty($clauses)) {
            $where = " WHERE " . implode(" AND ", $clauses);
        }
        var_dump($where);
        $query = 'SELECT * FROM '.lcfirst(get_called_class()).' ' . $where;
        var_dump($query);
        $request = $db->query($query);

        return $request->fetchAll(PDO::FETCH_CLASS, "Voiture"); //
    }*/
}