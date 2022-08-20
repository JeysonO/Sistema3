<?php
include_once 'conexion.php';

class AlumnoModel 
{
	
 private $bd;
    public function Listar()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM alumno where eliminado=0 order by idAlumno;" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }       
    }

    public function ListarAlumnosTI()
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM alumno where eliminado=0 and activo=1 order by nombre asc;" );
        $stmt->execute();

        if (!$stmt->execute()) {
            return 'error';
            //print_r($stmt->errorInfo());
        }else{            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }       

    }


    public function Consultar(Alumno $alumno)
    {
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("SELECT * FROM alumno WHERE idAlumno = :idAlumno;");
        $var=$alumno->__GET('idAlumno');
        $stmt->bindParam(':idAlumno', $var);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);      
        $objAlumno = new Alumno(); 
        $objAlumno->__SET('idAlumno',$row->idAlumno);
        $objAlumno->__SET('primer_nombre',$row->primer_nombre);
        $objAlumno->__SET('apellido_paterno',$row->apellido_paterno);
        $objAlumno->__SET('apellido_materno',$row->apellido_materno);
        $objAlumno->__SET('edad',$row->edad);
        $objAlumno->__SET('dni',$row->dni);
        $objAlumno->__SET('fecha_nacimiento',$row->fecha_nacimiento);
        $objAlumno->__SET('curso',$row->curso);
        $objAlumno->__SET('carrera',$row->carrera);
        $objAlumno->__SET('activo',$row->activo);
   
        return $objAlumno;
    }


    public function Actualizar(Alumno $alumno)
    {
      
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE alumno SET  primer_nombre=:primer_nombre,apellido_paterno=:apellido_paterno,apellido_materno=:apellido_materno,edad=:edad,fecha_nacimiento=:fecha_nacimiento,curso=:curso,carrera=:carrera,activo=:activo,modificado_por=:modificado_por WHERE idAlumno=:idAlumno;");

        $var1=$alumno->__GET('idAlumno');
        $var2=$alumno->__GET('primer_nombre');
        $var3=$alumno->__GET('apellido_paterno');
        $var4=$alumno->__GET('apellido_materno');
        $var5=$alumno->__GET('edad');
        $var6=$alumno->__GET('fecha_nacimiento');
        $var7=$alumno->__GET('curso');
        $var8=$alumno->__GET('carrera');
        $var9=$alumno->__GET('activo');
        $var10=$alumno->__GET('modificado_por');

        $stmt->bindParam(':idAlumno',$var1);
        $stmt->bindParam(':primer_nombre',$var2);
        $stmt->bindParam(':apellido_paterno',$var3);
        $stmt->bindParam(':apellido_materno',$var4);
        $stmt->bindParam(':edad',$var5);
        $stmt->bindParam(':fecha_nacimiento',$var6);
        $stmt->bindParam(':curso',$var7);
        $stmt->bindParam(':carrera',$var8);
        $stmt->bindParam(':activo',$var9);
        $stmt->bindParam(':modificado_por',$var10);

           
        if (!$stmt->execute()) {
          
           // $errors = $stmt->errorInfo();
            
             return 'error';
           //return $errors[2];  
        }else{
            
            return 'exito';
        }
    }    

    public function Registrar(Alumno $alumno)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("INSERT INTO alumno(primer_nombre,apellido_paterno,apellido_materno,edad,dni,fecha_nacimiento,curso,carrera,ingresado_por) VALUES(:primer_nombre,:apellido_paterno,:apellido_materno,:edad,:dni,:fecha_nacimiento,:curso,:carrera,:ingresado_por)");
        
        $var1=$alumno->__GET('primer_nombre');
        $var2=$alumno->__GET('apellido_paterno');
        $var3=$alumno->__GET('apellido_materno');
        $var4=$alumno->__GET('edad');
        $var5=$alumno->__GET('dni');
        $var6=$alumno->__GET('fecha_nacimiento');
        $var7=$alumno->__GET('curso');
        $var8=$alumno->__GET('carrera');
        $var9=$alumno->__GET('ingresado_por');
        
        $stmt->bindParam(':primer_nombre',$var1);
        $stmt->bindParam(':apellido_paterno',$var2);
        $stmt->bindParam(':apellido_materno',$var3);
        $stmt->bindParam(':edad',$var4);
        $stmt->bindParam(':dni',$var5);
        $stmt->bindParam(':fecha_nacimiento',$var6);
        $stmt->bindParam(':curso',$var7);
        $stmt->bindParam(':carrera',$var8);
        $stmt->bindParam(':ingresado_por',$var9);
        if (!$stmt->execute()) {
            //$errors = $stmt->errorInfo();
            //echo($errors[2]);
            //return $errors[2];
           return 'error';          
            //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }

        
    }

    public function Eliminar(Alumno $alumno)
    {
       
        $this->bd = new Conexion();
        $stmt = $this->bd->prepare("UPDATE alumno SET  modificado_por=:modificado_por,eliminado=:eliminado WHERE idAlumno = :idAlumno");

        $stmt->bindParam(':idAlumno',$alumno->__GET('idAlumno'));         
        $stmt->bindParam(':modificado_por',$alumno->__GET('modificado_por'));
        $stmt->bindParam(':eliminado',$alumno->__GET('eliminado'));    
        if (!$stmt->execute()) {
            return 'error';
        //print_r($stmt->errorInfo());
        }else{
            
            return 'exito';
        }
         
    }
 
}