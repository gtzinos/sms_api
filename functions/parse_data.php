<?php

    /*
        Parameters: 
            $file_name: File path (Absolute/ Relative)
        
        Return:
                    
    */
    function getContactsFromCSV($file_name, &$params)
    {
        $row_counter = 1;

        $file_rows = substr_count(file_get_contents($file_name), "\n");

        if (($file = fopen($file_name, "r")) !== FALSE) {

            while (($row_data = fgetcsv($file, 0, ",")) !== FALSE) {
            //Skip field names
            if($row_counter == 1){ $row_counter++; continue; } 

                //Check cells number
                if (count($row_data) != 3)
                {
                    echo "Line " . $row_counter . " is not correct. Data: ";
                    print_r($row_data);
                    return false;
                }

                $params['to'] .= $row_data['2'];
                $params['param1'] .= $row_data['0'];
                $params['param2'] .= $row_data['1'];
    
                if ($row_counter <= $file_rows)
                {
                    $params['to'] .= ",";
                    $params['param1'] .= "|"; 
                    $params['param2'] .= "|";
                    $row_counter++;  
                }

            }

            fclose($file);
            return true;
        }
        else {
            echo "Can't find file with name " . $file_name;
            return false;
        }
    }
    

?>