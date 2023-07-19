<?php
    /**
     * Connects to database
     * @param string $sql SQL statment to execute.
     * @return array if SQL stament has data.
     * @return boolean if SQL statement doesn't return data
     * @return boolean if SQL statement is INSERT OR UPDATE
     */
    function dbConnect($sql){
        $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

        if($conn->prepare($sql)){
            $result = $conn->query($sql);
            if(isset($result->num_rows)){
                $rows = $result->num_rows;
                if ($rows > 1) {
                    $data = array();
                    for($i=0; $i<$rows; $i++){
                        $data[$i] = $result->fetch_assoc();
                    }
                    return $data;
                }else if($rows > 0 && $rows == 1){
                    $data = array();
                    $data = $result->fetch_assoc();
                    return $data;
                }else{
                    return false;
                }
            } else if($result){
                return true;
            }else {
                if(!$result){
                    die($conn->error);
                }
            }
        }else{
            die($conn->error);
        }
        
        $conn->close();
    }

    /**
     * @param string $sql SQL statment to execute.
     * @return stirng from dbConnect.
     */
    function exeSQL($sql){
        return dbConnect($sql);
    }

?>