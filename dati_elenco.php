<?php
    
    //prove per vedere come funziona
    $errors = array('db' => false, 'mail' => false, 'psw' => false); //To store errors
    $form_data = array(); //Pass back the data 
    
    /* Validate the form on the server side */
    if(isset($_POST['idutentenonautenticato'])){
            
        require 'db.php';

        $idutentenonautenticato = $_POST['idutentenonautenticato'];     

        //questa va poi modificata con il db appartenente
        $sql = "SELECT LATITUDINE, LONGITUDINE FROM POSIZIONE WHERE idutentenonautenticato=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $errors['db'] = true; //problma db
            $form_data['posted'] = 'DB problem !';
        }
        else {
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while($riga = mysqli_fetch_assoc($result))
                    {
                        $row = array();
                        array_push($row, $riga['nome']);
                        array_push($row, $riga['tipo']);
                        array_push($row, $riga['indirizzo']);
                        array_push($row, $riga['attesa']);
                        array_push($data, $row);
                    }  
                    $form_data['success'] = true;
                    $form_data['posted'] = 'Successo';
                    $form_data['userId'] = $riga['ID'];
                
            }
            
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        if ($errors['db'] || $errors['mail'] || $errors['psw']) { //If errors in validation
            $form_data['success'] = false;
            $form_data['errors']  = $errors;
            echo("CHE SUCCEDE")
        }

        echo json_encode($form_data);
        
?>