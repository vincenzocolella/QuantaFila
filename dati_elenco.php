<?php


    $errors = array('db' => false); //To store errors
    $form_data = array(); //Pass back the data
    $data = array();
    
    /* Validate the form on the server side */
            
        require 'db.php';
        
        $citta = $_POST['citta'];     

        //questa va poi modificata con il db appartenente
        $sql = "SELECT nome, tipo, indirizzo, attesa FROM attivitacommerciale WHERE Citta= ?;";
        
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $errors['db'] = true; //problma db
            $form_data['posted'] = 'DB problem !';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $citta);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while($riga = mysqli_fetch_assoc($result))
                    {
                    
                        #echo $riga['nome'];
                        #echo $riga['indirizzo']; // etc..
                        $row = array();
                        array_push($row, $riga['nome']);
                        array_push($row, $riga['tipo']);
                        array_push($row, $riga['indirizzo']);
                        array_push($row, $riga['attesa']);
                        array_push($data, $row);
                    }  
                    $form_data['success'] = true;
                    $form_data['posted'] = 'Successo';
                    $form_data['data'] = $data;
                
            }
            
        
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        if ($errors['db']) { //If errors in validation
            $form_data['success'] = false;
            $form_data['errors']  = $errors;
        }

        echo json_encode($form_data);


