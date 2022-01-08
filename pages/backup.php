<?php

    //ENTER THE RELEVANT INFO BELOW
    // $mysqlUserName      = "root";
    // $mysqlPassword      = "";
    // $mysqlHostName      = "localhost";
    // $DbName             = "shah_center";
    // $backup_name        = "databaseBackUp.sql";

    $mysqlUserName      = "babarali_smc_user";
    $mysqlPassword      = "FVlEajq7a)5S";
    $mysqlHostName      = "localhost:3306";
    $DbName             = "babarali_smc";
    $backup_name        = "databaseBackUp.sql";
    $tables             = array(
        "add_medicines", 
        "anesthetic_surgery_charges", 
        "anes_confirm_charges_list", 
        "anethetic_paid_amount", 
        "area", 
        "charges_confirm_list", 
        "device_tbl", 
        "discharge_patients", 
        "discharge_patients_charges", 
        "doctor_paid_amount", 
        "doctor_surgery_charges", 
        "doctor_visit_charges", 
        "employee_designation", 
        "employee_registration", 
        "employee_salary", 
        "emp_advance_payment", 
        "expense", 
        "expense_category", 
        "floors", 
        "inventory_items", 
        "lab_order", 
        "lab_test_category", 
        "lab_test_report", 
        "login_user",
        "medicine_category",
        "medicine_order",
        "message_tbl",
        "ot_items",
        "patient_registraion_date",
        "patient_registration",
        "pat_details",
        "pat_observation_bp",
        "pat_observation_drain",
        "pat_observation_ng",
        "pat_observation_pulse",
        "pat_observation_respiratory",
        "pat_observation_urine",
        "pharmacy_amount",
        "postpone_patient",
        "rooms",
        "select_organization",
        "staff_category",
        "staff_members",
        "surgeries"
    );

   //or add 5th parameter(array) of specific tables:    array("mytable1","mytable2","mytable3") for multiple tables

    Export_Database($mysqlHostName,$mysqlUserName,$mysqlPassword,$DbName, $tables=false, $backup_name=false );

    function Export_Database($host,$user,$pass,$name,  $tables=false, $backup_name=false )
    {
        $mysqli = new mysqli($host,$user,$pass,$name);
        $mysqli->select_db($name);
        $mysqli->query("SET NAMES 'utf8'");

        $queryTables    = $mysqli->query('SHOW TABLES');
        while($row = $queryTables->fetch_row()) {
            $target_tables[] = $row[0];
        }
        if($tables !== false) {
            $target_tables = array_intersect( $target_tables, $tables);
        }
        foreach($target_tables as $table) {
            $result         =   $mysqli->query('SELECT * FROM '.$table);
            $fields_amount  =   $result->field_count;
            $rows_num=$mysqli->affected_rows;
            $res            =   $mysqli->query('SHOW CREATE TABLE '.$table);
            $TableMLine     =   $res->fetch_row();
            $content        = (!isset($content) ?  '' : $content) . "\n\n".$TableMLine[1].";\n\n";

            for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
                while($row = $result->fetch_row())
                { //when started (and every after 100 command cycle):
                    if ($st_counter%100 == 0 || $st_counter == 0 ) {
                            $content .= "\nINSERT INTO ".$table." VALUES";
                    }
                    $content .= "\n(";
                    for($j=0; $j<$fields_amount; $j++) {
                        $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) );
                        if (isset($row[$j])) {
                            $content .= '"'.$row[$j].'"' ;
                        }
                        else {
                            $content .= '""';
                        }
                        if ($j<($fields_amount-1)) {
                                $content.= ',';
                        }
                    }
                    $content .=")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {
                        $content .= ";";
                    }
                    else {
                        $content .= ",";
                    }
                    $st_counter=$st_counter+1;
                }
            } $content .="\n\n\n";
        }
        //$backup_name = $backup_name ? $backup_name : $name."___(".date('H-i-s')."_".date('d-m-Y').")__rand".rand(1,11111111).".sql";
        $date = date("Y-m-d");
        $backup_name = $backup_name ? $backup_name : $name.".$date.sql";
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"".$backup_name."\"");
        echo $content; 
        exit;
    }
?>