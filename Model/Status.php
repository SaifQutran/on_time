<?php 
namespace Model;
class Status extends Table{
    protected static $tableName = "statuses";
    private $status_id;
    private $status;
    private $statusColor;
    function getStatus(){
        return $this->status;
    }
    function getStatusColor(){
        return $this->statusColor;
    }
    function setStatus($status){
        $this->status = $status;
    }
    function setStatusColor($statusColor){
        $this->statusColor = $statusColor;
    }
}
?>