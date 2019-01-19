<?php

Class Usuario{
    private $id,$deslogin,$dessenha,$datatime;

    function getId(){
        return $this->id;
    }
    function setId($value){
        $this->id = $value;
    }
    function getDeslogin(){
        return $this->deslogin;
    }
    function setDeslogin($value){
        $this->deslogin = $value;
    }
    function getDessenha(){
        return $this->dessenha;
    }
    function setDessenha($value){
        $this->dessenha = $value;
    }
    function getDataTime(){
        return $this->datatime;
    }
    function setDataTime($value){
        $this->datatime = $value;
    }

    /**********************************/
    public function loadById($id){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE id = :ID",array(
            ":ID"=>$id
        ));
        if(count($results) > 0){
            $row = $results[0];
            $this->setId($row['id']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDataTime(new DateTime($row['datatime']));
        }
    }

    function __toString(){
        return json_encode(array(
            "id"=>$this->getId(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "datatime"=>$this->getDataTime()
        ));
    }
}



?>