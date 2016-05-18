<?php
require 'IIT_invent.class.php';

class IT_invent implements IIT_invent {
    protected $_db;
    const DB_NAME = 'it_invent.db';

    function __construct(){
        if(is_file(self::DB_NAME)){
            $this->_db = new SQLite3(self::DB_NAME);
            $this->_db->busyTimeout(2000);
            $this->_db->exec('PRAGMA journal_mode=WAL;');
            #$this->_db->exec('PRAGMA wal_checkpoint(FULL)');
            #$this->_db->exec('PRAGMA journal_mode=DELETE');
        }else{
             $this->_db = new SQLite3(self::DB_NAME);
             $this->_db->busyTimeout(2000);
             $this->_db->exec('PRAGMA journal_mode=WAL;');
             $sql = "CREATE TABLE point(
                    id_p INTEGER PRIMARY KEY AUTOINCREMENT,
                    id_city INTEGER,
                    id_p_type INTEGER,
                    adress TEXT,
                    inet_1 TEXT,
                    inet_2 TEXT)";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
            $sql = "CREATE TABLE tehn(
                    id_t INTEGER PRIMARY KEY AUTOINCREMENT,
                    id_p INTEGER,
                    id_tehn INTEGER,
                    id_model INTEGER,
                    invN TEXT,
                    serN TEXT)";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
            $sql = "CREATE TABLE listCity(
                    id_city INTEGER PRIMARY KEY AUTOINCREMENT,
                    city TEXT)";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
            $sql = "CREATE TABLE listPType(
                    id_p_type INTEGER PRIMARY KEY AUTOINCREMENT,
                    p_type TEXT)";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
            $sql = "CREATE TABLE listTehn(
                    id_tehn INTEGER PRIMARY KEY AUTOINCREMENT,
                    name TEXT)";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
            $sql = "CREATE TABLE listModel(
                    id_model INTEGER PRIMARY KEY AUTOINCREMENT,
                    id_tehn INTEGER,
                    model TEXT)";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
            $sql = "CREATE TABLE delPoint(
                    id_delPoint INTEGER PRIMARY KEY AUTOINCREMENT,
                    id_p INTEGER,
                    city TEXT,
                    adress TEXT,
                    p_type TEXT,
                    inet_1 TEXT,
                    inet_2 TEXT,
                    delReason TEXT,
                    delDate TEXT)";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
            $sql = "CREATE TABLE delTehn(
                    id_delTehn INTEGER PRIMARY KEY AUTOINCREMENT,
                    id_t INTEGER,
                    id_p INTEGER,
                    name TEXT,
                    model TEXT,
                    invN TEXT,
                    serN TEXT,
                    delReason TEXT,
                    delDate TEXT)";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
            $this->AddDefaultListValues();
            $this->makeStore();

        }
    }

    function __destruct(){
        unset($this->_db);
    }

    function changeTehnInfo($id_t, $invN, $serN){
        $check=0;
        $sql = "SELECT COUNT(id_t), invN FROM tehn WHERE invN='$invN'";
        $res = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
        $resInvN = $this->db2Arr($res);
        $sql = "SELECT COUNT(id_t), serN FROM tehn WHERE serN='$serN'";
        $res = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
        $resSerN = $this->db2Arr($res);

        if($resInvN[0]['COUNT(id_t)']=='0'){
            $sql = "UPDATE tehn SET invN='$invN' WHERE id_t='$id_t'";
            if ($this->_db->exec($sql) or die ($this->_db->lastErrorMsg())){
                $check=+1;
            }
        }

        if($resSerN[0]['COUNT(id_t)']=='0'){
            $sql = "UPDATE tehn SET serN='$serN' WHERE id_t='$id_t'";
            if ($this->_db->exec($sql) or die ($this->_db->lastErrorMsg())){
                $check=+1;
            }
        }

        if ($check>0) {return true;}
        else { return false;}

    }
    
    function getPointsInfo(){
        $sql = "SELECT point.*, listCity.*, listPType.*
                            FROM POINT
                            LEFT JOIN listPType USING (id_p_type)
                            LEFT JOIN listCity USING (id_city)
                            ORDER BY city";
        $res = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
        return $this->db2Arr($res);   
    }

    function getFilterPointsInfo($idCity, $idPType){
        $sql = "SELECT point.*, listCity.*, listPType.*
                            FROM POINT
                            LEFT JOIN listPType USING (id_p_type)
                            LEFT JOIN listCity USING (id_city)
                            WHERE id_city='$idCity' and id_p_type='$idPType'
                            ORDER BY city";
        if ($idCity!='NULL' && $idPType!='NULL'){
            $sql = "SELECT point.*, listCity.*, listPType.*
                                FROM POINT
                                LEFT JOIN listPType USING (id_p_type)
                                LEFT JOIN listCity USING (id_city)
                                WHERE id_city='$idCity' and id_p_type='$idPType'
                                ORDER BY city";
        }
        if ($idCity!='NULL' && $idPType=='NULL'){
            $sql = "SELECT point.*, listCity.*, listPType.*
                                FROM POINT
                                LEFT JOIN listPType USING (id_p_type)
                                LEFT JOIN listCity USING (id_city)
                                WHERE id_city='$idCity' 
                                ORDER BY city";
        }
        if ($idPType!='NULL' && $idCity=='NULL'){
            $sql = "SELECT point.*, listCity.*, listPType.*
                                FROM POINT
                                LEFT JOIN listPType USING (id_p_type)
                                LEFT JOIN listCity USING (id_city)
                                WHERE id_p_type='$idPType'
                                ORDER BY city";
        }

        $res = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
        return $this->db2Arr($res);   
        
    }

    function getItemPointInfo($id_p){
        $sql_point = "SELECT  point.*, listCity.*, listPType.* 
                           FROM point
                           LEFT JOIN listPtype USING (id_p_type)
                           LEFT JOIN listCity USING (id_city)
                           WHERE point.id_p=$id_p";
        $res_point = $this->_db->query($sql_point) or die ($this->_db->lastErrorMsg());
        return $this->db2arr($res_point);
               
    }

    function getTehnInfo($id_p){

        $sql_tehn = "SELECT tehn.*, listTehn.*, listModel.*
                            FROM tehn
                            LEFT JOIN listTehn USING (id_tehn)
                            LEFT JOIN listModel USING (id_model)
                            WHERE tehn.id_p='$id_p'
                            ORDER BY listTehn.name,listModel.model";

        $res_tehn = $this->_db->query($sql_tehn) or die ($this->_db->lastErrorMsg());
        return array ($this->db2arr($res_tehn));
    }

    function addPoint($adress, $id_city, $id_p_type, $inet_1, $inet_2){
        $sql = "INSERT INTO point(id_city, adress, id_p_type, inet_1, inet_2)
                            VALUES ($id_city, '$adress', $id_p_type, '$inet_1', '$inet_2')";
        $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());           
    }

    function addTehn($id_p, $id_tehn, $id_model, $invN, $serN){
        if ($invN!="" or $serN!="") {
            if($invN!="")
                $sql = "SELECT COUNT(id_t), invN, serN FROM tehn WHERE invN='$invN'";
            if($serN!="")
                $sql = "SELECT COUNT(id_t), invN, serN FROM tehn WHERE serN='$serN'";
            if($invN!="" and $serN!="")
                $sql = "SELECT COUNT(id_t), invN, serN FROM tehn WHERE invN='$invN' or serN='$serN'";
            $res = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
            $res = $this->db2Arr($res);
        } else {
           $res[0]['COUNT(id_t)']=0; 
        }
        if($res[0]['COUNT(id_t)']=='0'){
            $sql = "INSERT INTO tehn(id_p, id_tehn, id_model, invN, serN)
                                values($id_p, $id_tehn, $id_model, '$invN', '$serN')";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
            return true;
        }else{return false;}
    }

    function movTehn($id_t, $id_p){
        $sql = "UPDATE tehn SET id_p='$id_p' WHERE id_t='$id_t'";
        if ($this->_db->exec($sql) or die ($this->_db->lastErrorMsg()));
            return true;
    }

    function movDelTehn($id_delTehn, $id_p){
        $delTehn=$this->getItemDelTehnInfo($id_delTehn);
        $name=$delTehn[0]['name'];
        $model=$delTehn[0]['model'];
        $invN=$delTehn[0]['invN'];
        $serN=$delTehn[0]['serN'];
        
        $sql="SELECT COUNT(name),id_tehn FROM listTehn WHERE name='$name'";
        $res=$this->_db->query($sql) or die ($this->_db->lastErrorMsg());
        $res=$res->fetchArray(SQLITE3_NUM);
        $result=$res[0];
        if($result<0){
            $sql = "INSERT INTO listTehn(name) VALUES ('$name')";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
        } else {$id_tehn=$res[1];}
        
        $sql="SELECT COUNT(model),id_model FROM listModel WHERE model='$model'";
        $res=$this->_db->query($sql) or die ($this->_db->lastErrorMsg());
        $res=$res->fetchArray(SQLITE3_NUM);
        $result=$res[0];
        if($result<0){
            $sql = "INSERT INTO listModel(model) VALUES ('$model')";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
        } else {$id_model=$res[1];}

        if ($id_tehn!=NULL && $id_model!=NULL && $id_p!=NULL) {
            $sql = "INSERT INTO tehn(id_p, id_tehn, id_model, invN, serN) 
                                VALUES ($id_p, $id_tehn, $id_model, '$invN', '$serN')";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());

            $sql = "DELETE FROM delTehn WHERE id_delTehn='$id_delTehn'";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
            return true;
        }
        else {
            return false;
        }

    }

    function getItemDelTehnInfo($id_delTehn){
        $sql = "SELECT name, model, invN, serN from delTehn WHERE id_delTehn='$id_delTehn'";
        $result = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
        $result = $this->db2Arr($result);
        return $result;    
    }

    function getItemTehnInfo($id_t){
        $sql = "SELECT tehn.id_t, tehn.invN, tehn.serN, listTehn.name, listModel.model 
                                        FROM tehn
                                        LEFT JOIN listTehn USING(id_tehn)
                                        LEFT JOIN listModel USING(id_model)
                                        WHERE id_t='$id_t'";
        $result = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
        $result = $this->db2Arr($result);
        return $result;    
    }
   
    function showDeletedPoints(){
        $sql = "SELECT * FROM delPoint ORDER BY city";
        $res = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
        $res = $this->db2Arr($res);   
        return $res;
    }

    function showDeletedTehn(){
        $sql = "SELECT * FROM delTehn ORDER BY model";
        $res = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
        $res = $this->db2Arr($res);   
        return $res;   
    }

    function queryMaker($where){

        $sql = "SELECT *, listPType.*, listTehn.*, listModel.*, point.*, listCity.* FROM tehn 
                                        LEFT JOIN point USING(id_p)
                                        LEFT JOIN listCity USING(id_city)
                                        LEFT JOIN listPType USING (id_p_type)
                                        LEFT JOIN listTehn USING (id_tehn)
                                        LEFT JOIN listModel USING (id_model)";
        $sql=$sql.$where;    
        $res = $this->_db->query($sql) or die ($this->_db->lastErrorMsg()); 
        $res = $this->db2Arr($res);
        return $res;
    }

    function AddDefaultListValues(){
        $ini_array = parse_ini_file("ini/tehn.ini", true);

        $i=100;
        $j=100;
        foreach($ini_array as $key=>$value){
            $sqlTehn = "INSERT INTO listTehn(id_tehn, name) VALUES('$i', '$key')";
            $this->_db->exec($sqlTehn) or die ($this->_db->lastErrorMsg());
            foreach ($value as $key2=>$val2){
                $sqlModel = "INSERT INTO listModel(id_model, id_tehn, model) VALUES('$j', '$i', '$val2')";
                $this->_db->exec($sqlModel) or die ($this->_db->lastErrorMsg());
                $j++;
            }
            $i++;
        }

        $ini_array = parse_ini_file("ini/point.ini");
        foreach($ini_array as $key=>$value){
            $sql = "INSERT INTO listPtype(p_type) VALUES ('$value')";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
        }

        $ini_array = parse_ini_file("ini/store.ini");
        foreach($ini_array as $key=>$value){
            $sql = "INSERT INTO listCity(city) VALUES ('$value')";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
        }
    }

    function makeStore(){
        $sql = "INSERT INTO point(id_city, id_p_type) VALUES('1', '7')";
        $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
    }

    function remTehn($id_t, $delReason, $delDate){
        $sql = "SELECT listTehn.name, listModel.model, tehn.invN, tehn.sern, tehn.id_t, tehn.id_p FROM tehn 
                        LEFT JOIN listTehn USING (id_tehn)
                        LEFT JOIN listModel USING (id_model)
                        WHERE id_t='$id_t'";
        $res = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
        $res = $this->db2Arr($res);
        
        $id_p = $res[0]['id_p'];
        $name = $res[0]['name'];
        $model = $res[0]['model'];
        $invN= $res[0]['invN'];
        $serN = $res[0]['serN'];

        $sql = "INSERT INTO delTehn(id_t,
                                    id_p,
                                    name,
                                    model,
                                    invN,
                                    serN,
                                    delReason,
                                    delDate)
                            VALUES( $id_t,
                                    $id_p,
                                    '$name',
                                    '$model',
                                    '$invN',
                                    '$serN',
                                    '$delReason',
                                    '$delDate')";
        $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
        $sql = "DELETE FROM tehn WHERE id_t='$id_t'";
        $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
    }

    function remPoint($id_p, $delReason, $delDate){
        $point = $this->getItemPointInfo($id_p);

        $id_p = $point[0]['id_p'];
        $city = $point[0]['city'];
        $adress = $point[0]['adress'];
        $p_type = $point[0]['p_type'];
        $inet_1 = $point[0]['inet_1'];
        $inet_2 = $point[0]['inet_2'];
        
        $sql = "INSERT INTO delPoint(id_p,
                                     city,
                                     adress,
                                     p_type,
                                     inet_1,
                                     inet_2,
                                     delReason,
                                     delDate)
                            VALUES($id_p,
                                     '$city', 
                                     '$adress', 
                                     '$p_type', 
                                     '$inet_1', 
                                     '$inet_2', 
                                     '$delReason', 
                                     '$delDate')";
        $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
        $sql = "DELETE FROM point WHERE id_p='$id_p'";
        $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
    }

    function doubleFinder($tableName, $rowName, $data){
            function sqlite_NoCase($string){
                return mb_strtolower($string);
            }
            $this->_db->createFunction('sqlite_NoCase', 'sqlite_NoCase');
            $data = sqlite_NoCase($data);
            $sql = "SELECT COUNT($rowName) FROM $tableName WHERE sqlite_NoCase($rowName)='$data'";
            $res = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
            $row = $res->fetchArray(SQLITE3_NUM);
        return $row;
    }

    function addToList($tableName, $rowName, $data, $row_2_name=Null, $data2=Null){
        if (!$row_2_name and !$data2) {
            $sql = "INSERT INTO $tableName($rowName) VALUES ('$data')";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
         }else { 
            $sql = "INSERT INTO $tableName($rowName, $row_2_name) VALUES ('$data', '$data2')";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
        }
    }

    function remFromList($tableName, $rowName, $data){
            $sql = "DELETE FROM $tableName WHERE $rowName=$data";
            $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
    }

    function getCount($rowName, $tableName, $data){
        $sql = "SELECT COUNT($rowName) FROM $tableName WHERE $rowName=$data";
        $res = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
        $row = $res->fetchArray(SQLITE3_NUM);
        if ($row[0]){
            return true;
        }else{
            return false;
        }
    }

    function clearStr($data){
        $data = trim(strip_tags($data));
        return $this->_db->escapeString($data);
    }

    function clearInt($data){
        return abs((int)$data);    
    }
    
    function fillModelsAjax($id_tehn){
        $sql = "SELECT id_model, model FROM listModel WHERE id_tehn='$id_tehn'";
        $res = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
        return $this->db2Arr($res);
    }

    protected function db2Arr($data){
        $arr = array();
        while($row = $data->fetchArray(SQLITE3_ASSOC))
            $arr[] = $row;
        return $arr;
    }

    function makeSelect($table_name, $select_name=null, $select_size=null){
        if ($table_name!="listModel"){
            $sql = "PRAGMA table_info('$table_name')";
            $res = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
            $arr = $this->db2Arr($res);
            $orderColl = $arr[1]['name'];
            $col_2 = $arr[1]['name'];
            $col_1 = $arr[0]['name'];
            $sql = "SELECT * FROM '$table_name' ORDER BY $orderColl";
            $res = $this->_db->query($sql) or die ($this->_db->lastErorrMsg());
            $arr = $this->db2Arr($res);
            if (!$select_size){
                $selectWidth = "165px";
            }else{
                $selectWidth = $select_size;
            }
            if(!$select_name){
                echo "\r\n<select name='".$table_name."' style='width:".$selectWidth."'>\r\n";
            }else{
                echo "\r\n<select name='".$select_name."' style='width:".$selectWidth."'>\r\n";
            }
            echo "<option value='NULL'> </option>\r\n";
            foreach($arr as $item){
                $data_1 = $item[$col_1];
                $data_2 = $item[$col_2];
                echo <<<LABEL
                    <option value="$data_1">$data_2</option>\r\n
LABEL;
            }
            echo "</select>\r\n";
        }else{
            $sql = "PRAGMA table_info('$table_name')";
            $res = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
            $arr = $this->db2Arr($res);
            $orderColl = $arr[2]['name'];
            $col_3 = $arr[2]['name'];
            $col_2 = $arr[1]['name'];
            $col_1 = $arr[0]['name'];
            $sql = "SELECT * FROM '$table_name' ORDER BY $orderColl";
            $res = $this->_db->query($sql) or die ($this->_db->lastErorrMsg());
            $arr = $this->db2Arr($res);
            if (!$select_size){
                $selectWidth = "165px";
            }else{
                $selectWidth = $select_size;
            }
            if(!$select_name){
                echo "\r\n<select name='".$table_name."' style='width:".$selectWidth."'>\r\n";
            }else{
                echo "\r\n<select name='".$select_name."' style='width:".$selectWidth."'>\r\n";
            }

            foreach($arr as $item){
                $data_1 = $item[$col_1];
                $data_2 = $item[$col_2];
                $data_3 = $item[$col_3];
                echo <<<LABEL
                    <option value="$data_1">$data_3</option>\r\n
LABEL;
            }
            echo "</select>\r\n";
        }
    }



    function add2list(){            //***************************************** Удалить!!!!!!!!!!! ************//
         $sql = "INSERT INTO tehn(id_p, id_tehn, id_model, invN, serN) VALUES (6, 1, 2, 'Инвентарник', 'Серийник')";
         $this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
    }

    function showTable($table){     //***************************************** Удалить!!!!!!!!!!! ************//
        $sql = "SELECT * FROM $table";
        $res = $this->_db->query($sql) or die ($this->_db->lastErrorMsg());
        return $this->db2Arr($res);
    }
}

?>
