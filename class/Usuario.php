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
            ':ID'=>$id
        ));
        if(count($results) > 0){
            $this->setData($results[0]);
           
        }
    }
    static function getList(){
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios;");
    }
    static function search($login){
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :DESLOGIN ORDER BY deslogin",array(
        ':DESLOGIN'=>"%" . $login . "%"
        ));
    }
    function login($login,$password){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD ",array(
            ':LOGIN'=>$login,
            ':PASSWORD'=>$password
        ));
        if(count($results) > 0){
            $this->setData($results[0]);
 
        } else {
            throw new Exception("LOGIN e/ou Senha Inválidos.");
            
        }
    }

    function setData($data){
        $this->setId($data['id']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDataTime(new DateTime($data['datatime']));
    }
    function insert(){
        $sql = new Sql();
        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",array(
          ':LOGIN'=>$this->getDeslogin(),
          ':PASSWORD'=>$this->getDessenha()
        ));
      if(count($results)>0){
          $this->setData($results[0]);
      }
    }

    function Update($login,$password){
        
        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();

        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD where id = :ID", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha(),
            ':ID'=>$this->getId()
        ));
    }

    function __construct($login="", $senha=""){
        $this->setDeslogin($login);
        $this->setDessenha($senha);
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