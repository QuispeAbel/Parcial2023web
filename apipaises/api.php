<?php
class Api{
    private $connect='';
    function __construct()
    {
        $this->connect = new PDO("mysql:host=localhost;dbname=paises;charset=utf8","root","");
    }

    function list_paises($limit,$order,$order_dir){
        try {
            $query="select * from pais order by :pOrder :pOrder_dir limit :pLimit";
            $sql = $this->connect->prepare($query);
			$sql->bindParam(':pLimit',$limit,PDO::PARAM_INT);
			$sql->bindParam(':pOrder',$order,PDO::PARAM_STR);
			$sql->bindParam(':pOrder_dir',$order_dir,PDO::PARAM_STR);
            $ok= $sql->execute();						
            if($ok){				
                $data=null;
                while($row = $sql->fetch(PDO::FETCH_ASSOC))
                {
                    $data[] = $row;
                }				
                $datasuccess=[
                    'status'=>200,
                    'data'=>$data
                ];
                return $datasuccess;
            }
            else{	
                $datasuccess=[
                    'status'=>500,
                    'message'=>'error al ejecutar la consulta'
                ];
                return $datasuccess;
            }
        } catch (Exception $e) {
            $datasuccess[]=[
                'status'=>500,
                'menssage'=>'algo malo paso'
            ];
            return  $datasuccess;
        }
    }
	
	function list_provincias($limit,$order,$order_dir,$idPais){
        try {
            $query="select * from provincia where idPais=:pIdPais order by :pOrder :pOrder_dir limit :pLimit";			
            $sql = $this->connect->prepare($query);
			$sql->bindParam(':pLimit',$limit,PDO::PARAM_INT);
			$sql->bindParam(':pOrder',$order,PDO::PARAM_STR);
			$sql->bindParam(':pOrder_dir',$order_dir,PDO::PARAM_STR);			
			$sql->bindParam(':pIdPais',$idPais,PDO::PARAM_INT);			
            $ok= $sql->execute();
            if($ok){
                $data=null;
                while($row = $sql->fetch(PDO::FETCH_ASSOC))
                {
                    $data[] = $row;
                }
                $datasuccess=[
                    'status'=>200,
                    'data'=>$data
                ];
                return $datasuccess;
            }
            else{
                $datasuccess=[
                    'status'=>500,
                    'message'=>'error al ejecutar la consulta'
                ];
                return $datasuccess;
            }
        } catch (Exception $e) {
            $datasuccess[]=[
                'status'=>500,
                'menssage'=>'algo malo paso'
            ];
            return  $datasuccess;
        }
    }	
	
	function list_localidades($limit,$order,$order_dir,$idProvincia){
        try {			
            $query="select * from localidad where idProvincia=:pIdProvincia order by :pOrder :pOrder_dir limit :pLimit";			
            $sql = $this->connect->prepare($query);
			$sql->bindParam(':pLimit',$limit,PDO::PARAM_INT);
			$sql->bindParam(':pOrder',$order,PDO::PARAM_STR);
			$sql->bindParam(':pOrder_dir',$order_dir,PDO::PARAM_STR);			
			$sql->bindParam(':pIdProvincia',$idProvincia,PDO::PARAM_INT);			
            $ok= $sql->execute();
            if($ok){
                $data=null;
                while($row = $sql->fetch(PDO::FETCH_ASSOC))
                {
                    $data[] = $row;
                }
                $datasuccess=[
                    'status'=>200,
                    'data'=>$data
                ];
                return $datasuccess;
            }
            else{
                $datasuccess=[
                    'status'=>500,
                    'message'=>'error al ejecutar la consulta'
                ];
                return $datasuccess;
            }
        } catch (Exception $e) {
            $datasuccess[]=[
                'status'=>500,
                'menssage'=>'algo malo paso'
            ];
            return  $datasuccess;
        }
    }		
/*
    function insert(){
        try {			
            $query="insert into tortas (nombre,descripcion,precio) values(:pNombre,:pDescripcion,:pPrecio)";
            $sql = $this->connect->prepare($query);
            $sql->bindParam(':pNombre',$_POST['nombre'],PDO::PARAM_STR);
            $sql->bindParam(':pDescripcion',$_POST['descripcion'],PDO::PARAM_STR);
            $sql->bindParam(':pPrecio',$_POST['precio'],PDO::PARAM_INT);
            $ok= $sql->execute();
            if($ok){
                $datasuccess=[
                    'status'=>200
                ];
                return $datasuccess;
            }
            else{
                $datasuccess=[
                    'status'=>500,
                    'message'=>'error al ejecutar la consulta'
                ];
                return $datasuccess;
            }
        } catch (Exception $e) {
            $datasuccess[]=[
                'status'=>500,
                'menssage'=>'algo malo paso'
            ];
            return  $datasuccess;
        }
    }
	*/
}
?>