<?php
include_once 'conexion.php';
class UniversidadModel 
{
	
 private $bd;

   

    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM universidad where eliminado=0 order by idUniversidad;" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }       

    }

/*---------POR EDITAR--------------*/
    public function ListarUniversidadesTI()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM universidad where eliminado=0 and activo=1 order by nombre asc;" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }       

    }


    public function Consultar(Universidad $universidad)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM universidad WHERE idUniversidad = :idUniversidad;");
        $variable=$universidad->__GET('idUniversidad');
        $stmt->bindParam(':idUniversidad', $variable);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      
        $objUniversidad = new Universidad(); 
        $objUniversidad->__SET('idUniversidad',$row->idUniversidad);
        $objUniversidad->__SET('codigo',$row->codigo);
        $objUniversidad->__SET('nombre',$row->nombre);
        $objUniversidad->__SET('activo',$row->activo);
   
        return $objUniversidad;
    }


    public function Actualizar(Universidad $universidad)
    {
      
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE universidad SET  codigo=:codigo,nombre=:nombre,direccion=:direccion,licenciado=:licenciado,cantidad_carreras=:cantidad_carreras,activo=:activo,modificado_por=:modificado_por WHERE idUniversidad=:idUniversidad;");

        $var=$universidad->__GET('idUniversidad');
        $var1=$universidad->__GET('codigo');
        $var2=$universidad->__GET('nombre');
        $var3=$universidad->__GET('direccion');
        $var4=$universidad->__GET('licenciado');
        $var5=$universidad->__GET('cantidad_carreras');
        $var6=$universidad->__GET('modificado_por');
        $var7=$universidad->__GET('modificado_por');
        $stmt->bindParam(':idUniversidad',$var0);
        $stmt->bindParam(':codigo',$var1);
        $stmt->bindParam(':nombre',$var2);
        $stmt->bindParam(':direccion',$var3);
        $stmt->bindParam(':licenciado',$var4);
        $stmt->bindParam(':cantidad_carreras',$var5);
        $stmt->bindParam(':activo',$var6);
        $stmt->bindParam(':modificado_por',$var7); 

           
        if (!$stmt->execute()) {
          
           // $errors = $stmt->errorInfo();
            
             return 'error';
           //return $errors[2];  
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Universidad $universidad)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO universidad(codigo,nombre,direccion,licenciado,cantidad_carreras,ingresado_por) VALUES(:codigo,:nombre,:direccion,:licenciado,:cantidad_carreras,:ingresado_por)");

        $var1=$universidad->__GET('codigo');
        $var2=$universidad->__GET('nombre');
        $var3=$universidad->__GET('direccion');
        $var4=$universidad->__GET('licenciado');
        $var5=$universidad->__GET('cantidad_carreras');
        $var6=$universidad->__GET('ingresado_por');
        $stmt->bindParam(':codigo',$var1);
        $stmt->bindParam(':nombre',$var2);
        $stmt->bindParam(':direccion',$var3);
        $stmt->bindParam(':licenciado',$var4);
        $stmt->bindParam(':cantidad_carreras',$var5);
        $stmt->bindParam(':ingresado_por',$var6); 
        $stmt->execute();
        if (!$stmt){
            //$errors = $stmt->errorInfo();
             //echo($errors[2]);
           //return $errors[2];
           return 'error';          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }

        
    }

    public function Eliminar(Universidad $universidad)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE universidad SET  modificado_por=:modificado_por,eliminado=:eliminado WHERE idUniversidad = :idUniversidad");

        $stmt->bindParam(':idUniversidad',$universidad->__GET('idUniversidad'));         
        $stmt->bindParam(':modificado_por',$universidad->__GET('modificado_por'));
        $stmt->bindParam(':eliminado',$universidad->__GET('eliminado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
 
}