<?php
class Compartilhamento extends Model
{
    public function getByIdComp($id){                                        
        $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE id_documento = :id AND usuarios_compartilhados_id = :usercomp");
        
        $sql->bindParam(':id', $id);
        $sql->bindParam(':usercomp', $_SESSION['id_usuario']);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
    }
