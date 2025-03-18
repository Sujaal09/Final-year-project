<?php

    $hname='localhost';
    $uname = 'root';
    $pass = '';
    $db = 'hotel';

    $con = mysqli_connect($hname,$uname,$pass,$db);

    if(!$con){
        die("Cannot connect to the database" . mysqli_connect_error());

    }


    function filteration($data){
        if (is_array($data)) {
            foreach($data as $key => $value){                               
                $data[$key] = trim($value);                         // trim()                  //remove extra spaces
                $data[$key] = stripslashes($value);                 // stripslashes()         //backslashes are removed
                $data[$key] = htmlspecialchars($value);             // htmlspecialchars()      //special characters are converted to html entities
                $data[$key] = strip_tags($value);                   // strip_tags()            //removes html tags 
            }
        } else {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = strip_tags($data);
        }
        return $data;
    }
    

    function select($sql,$values,$datatypes){
        $con=$GLOBALS['con'];
            
        if($stmt = mysqli_prepare($con,$sql)){    // executes (if) query is prepare with con
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);  //(...) splat operator which helps to dynamically pass multiple values to bind_param
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt); // closing prepare statement
                return $result;

            }else{
                mysqli_stmt_close($stmt);
                die("Query was unable to execute- Select"); 
            }
            

        }else{
            die("Query was unable to preapred- Select");    
        }
    }
    function insert($sql, $values, $datatypes){
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, $datatypes,...$values);
            if(mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
            }else{
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Insert");
            }

        }else{
            die("Query cannot be executed - Insert");

        }
            
    }

    

    function update($sql,$values,$datatypes){
        $con=$GLOBALS['con'];
            
        if($stmt = mysqli_prepare($con,$sql)){    // executes (if) query is prepare with con
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);  //(...) splat operator which helps to dynamically pass multiple values to bind_param
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt); // closing prepare statement
                return $result;

            }else{
                mysqli_stmt_close($stmt);
                die("Query was unable to execute- Update"); 
            }
            

        }else{
            die("Query was unable to preapred- Update");    
        }
    }

    function delete($sql,$values,$datatypes){
        $con=$GLOBALS['con'];
            
        if($stmt = mysqli_prepare($con,$sql)){    // executes (if) query is prepare with con
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);  //(...) splat operator which helps to dynamically pass multiple values to bind_param
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt); // closing prepare statement
                return $result;

            }else{
                mysqli_stmt_close($stmt);
                die("Query was unable to execute- Delete"); 
            }
            

        }else{
            die("Query was unable to preapred- Delete");    
        }
    }

    function selectAll($table){
        $con = $GLOBALS['con'];
        $query = "SELECT * FROM `$table`"; // ✅ Enclose table name in backticks
        $res = mysqli_query($con, $query);
    
        if(!$res){
            die("SQL Error: " . mysqli_error($con));
        }
    
        return $res;
    }
    


?>