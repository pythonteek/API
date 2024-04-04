<?php

class DB{
    private $host;
    private $username;
    private $password;
    private $db;
    
    function set(){
        $this->host = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->db = "";
    }
    
    function connect(){
        $this->set();
        $host = $this->host;
        $username = $this->username;
        $password = $this->password;
        $db = $this->db;
        
        $conn = new mysqli($host, $username, $password, $db);
        
        if ($conn->connect_error) {
            return(0);//failed
        }else{
            return($conn);//success
        }
    }
}

class Classes{
    
    function class_data_json(){
        $db = new DB;
        $conn = $db->connect();
        // Check connection
        if ($conn == true) {
            $data = array();
            $sql = "SELECT * FROM tb1 INNER JOIN tb2 on tb1.tb2_id=tb2.id";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
              // output data of each row
                while($row = $result->fetch_assoc()) {
                    
                    $cource = $row["course"];
                    $level = $row["level"];
                    $section = $row["section"];
                    
                    $curr_array = array(
                        "course" => $cource,
                        "level" => $level,
                        "section" => $section
                    );
                    
                    array_push($data, $curr_array);
                }
                $jsonData = var_dump(json_encode($data, JSON_UNESCAPED_UNICODE));
                return($jsonData);
            }else{
              return($data);
            }
        }else{
            echo "no";
        }
    }
    
}


?>
