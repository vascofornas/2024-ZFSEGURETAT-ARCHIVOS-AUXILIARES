<?php
    header("Access-Control-Allow-Origin: *");
    require_once('connect.php');

 
    if($_SERVER['REQUEST_METHOD']=='POST'){
       
        $fecha_alumbrado = $_POST['fecha_alumbrado'];
        $responsable = $_POST['responsable'];
        $observaciones = $_POST['observaciones'];
        $turno = $_POST['turno'];
        $c_A_1 = $_POST['c_A_1'];
        $c_A_2 = $_POST['c_A_2'];
        $c_B_1 = $_POST['c_B_1'];
        $c_B_2 = $_POST['c_B_2'];
        $c_C_2 = $_POST['c_C_2'];
        $c_D_2 = $_POST['c_D_2'];
    
        $c_E_2 = $_POST['c_E_2'];
        $c_E_3 = $_POST['c_E_3'];
        $c_F_3 = $_POST['c_F_3'];
        $c_H_2 = $_POST['c_H_2'];
        $c_K_3 = $_POST['c_K_3'];
        $c_L_3 = $_POST['c_L_3'];
        $c_M_3 = $_POST['c_M_3'];
        $c_Z_1 = $_POST['c_Z_1'];
        $c_1_1 = $_POST['c_1_1'];
        $c_2_1 = $_POST['c_2_1'];
    
        $c_3_1 = $_POST['c_3_1'];
        $c_3_2 = $_POST['c_3_2'];
        $c_4_2 = $_POST['c_4_2'];
        $c_4_3 = $_POST['c_4_3'];
        $c_5_2 = $_POST['c_5_2'];
        $c_6_2 = $_POST['c_6_2'];
        $c_6_3 = $_POST['c_6_3'];
        $c_11_3 = $_POST['c_11_3'];
        $c_40_1 = $_POST['c_40_1'];
        $c_40_2 = $_POST['c_40_2'];
    
        $c_40_3 = $_POST['c_40_3'];
        $c_41_1 = $_POST['c_41_1'];
        $c_41_2 = $_POST['c_41_2'];
        $c_41_3 = $_POST['c_41_3'];
        $c_42_1 = $_POST['c_42_1'];
        $c_42_2 = $_POST['c_42_2'];
        $c_42_3 = $_POST['c_42_3'];
        $c_43_1 = $_POST['c_43_1'];
        $c_43_2 = $_POST['c_43_2'];
        $c_43_3 = $_POST['c_43_3'];
    
        $c_50_1 = $_POST['c_50_1'];
        $c_50_2 = $_POST['c_50_2'];
        $c_50_3 = $_POST['c_50_3'];
        $c_60_1 = $_POST['c_60_1'];
        $c_60_2 = $_POST['c_60_2'];
        $c_60_3 = $_POST['c_60_3'];
        $c_61_1 = $_POST['c_61_1'];
        $c_61_2 = $_POST['c_61_2'];
        $c_61_3 = $_POST['c_61_3'];
        $c_62_1 = $_POST['c_62_1'];
    
        $c_62_2 = $_POST['c_62_2'];
        $c_62_3 = $_POST['c_62_3'];
        $c_F_llarga_1 = $_POST['c_F_llarga_1'];
        $c_F_llarga_2 = $_POST['c_F_llarga_2'];
        $c_F_llarga_3 = $_POST['c_F_llarga_3'];
        $c_Motors_1 = $_POST['c_Motors_1'];
        $c_Motors_2 = $_POST['c_Motors_2'];
        $c_Motors_3 = $_POST['c_Motors_3'];
        $c_Enll_1 = $_POST['c_Enll_1'];
        $c_Enll_2 = $_POST['c_Enll_2'];
        $c_Enll_3 = $_POST['c_Enll_3'];
        $firma1 = $_POST['firma1'];
        $firma2 = $_POST['firma2'];
       
        $id = $_POST['id'];

        
        
         
        
        $get_result = $con->query("UPDATE 
        tb_alumbrado SET
        
        fecha_alumbrado = '".$fecha_alumbrado."',
        responsable = '".$responsable."',
        observaciones = '".$observaciones."',
        turno = '".$turno."',
        c_A_1 = '".$c_A_1."',
        c_A_2 = '".$c_A_2."',
        c_B_1 = '".$c_B_1."',
        c_B_2 = '".$c_B_2."',
        c_C_2 = '".$c_C_2."',
        c_D_2 = '".$c_D_2."',
        c_E_2 = '".$c_E_2."',
        c_E_3 = '".$c_E_3."',
        c_F_3 = '".$c_F_3."',
        c_H_2 = '".$c_H_2."',
        c_K_3 = '".$c_K_3."',
        c_L_3 = '".$c_L_3."',
        c_M_3 = '".$c_M_3."',
        c_Z_1 = '".$c_Z_1."',
        c_1_1 = '".$c_1_1."',
        c_2_1 = '".$c_2_1."',
        c_3_1 = '".$c_3_1."',
        c_3_2 = '".$c_3_2."',
        c_4_2 = '".$c_4_2."',
        c_4_3 = '".$c_4_3."',
        c_5_2 = '".$c_5_2."',
        c_6_2 = '".$c_6_2."',
        c_6_3 = '".$c_6_3."',
        c_11_3 = '".$c_11_3."',
        c_40_1 = '".$c_40_1."',
        c_40_2 = '".$c_40_2."',
        c_40_3 = '".$c_40_3."',
        c_41_1 = '".$c_41_1."',
        c_41_2 = '".$c_41_2."',
        c_41_3 = '".$c_41_3."',
        c_42_1 = '".$c_42_1."',
        c_42_2 = '".$c_42_2."',
        c_42_3 = '".$c_42_3."',
        c_43_1 = '".$c_43_1."',
        c_43_2 = '".$c_43_2."',
        c_43_3 = '".$c_43_3."',
        c_50_1 = '".$c_50_1."',
        c_50_2 = '".$c_50_2."',
        c_50_3 = '".$c_50_3."',
        c_60_1 = '".$c_60_1."',
        c_60_2 = '".$c_60_2."',
        c_60_3 = '".$c_60_3."',
        c_61_1 = '".$c_61_1."',
        c_61_2 = '".$c_61_2."',
        c_61_3 = '".$c_61_3."',
        c_62_1 = '".$c_62_1."',
        c_62_2 = '".$c_62_2."',
        c_62_3 = '".$c_62_3."',
        firma1 = '".$firma1."',
        firma2 = '".$firma2."',
        c_F_llarga_1 = '".$c_F_llarga_1."',
        c_F_llarga_2 = '".$c_F_llarga_2."',
        c_F_llarga_3 = '".$c_F_llarga_3."',
        c_Motors_1 = '".$c_Motors_1."',
        c_Motors_2 = '".$c_Motors_2."',
        c_Motors_3 = '".$c_Motors_3."',
        c_Enll_1 = '".$c_Enll_1."',
        c_Enll_2 = '".$c_Enll_2."',
        c_Enll_3 = '".$c_Enll_3."'



        
        WHERE id = '".$id."'
         "); 
 
        if($get_result === true){
        echo "OK";
       
        
        }else{
        echo $username." Error actualizando foto de usuario";
        }
    }else{
        echo 'error';
    }
?>