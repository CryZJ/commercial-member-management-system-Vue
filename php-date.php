<?php
    require'conn.php';
    require'AHeader.php';
    
    $TabArr_5[5] = "市级,2018-04-10,项目名称";
    $TabArr_5[6] = "2018-04-10,资质项目名称";
    
    
    //保存项目信息
        //各级政府项目
    $Tab_5Arr = explode('//',$TabArr_5[5]);
    for($i=0;$i<count($Tab_5Arr);$i++){
        $Tab_5 = explode(',',$Tab_5Arr[$i]);
        $sql_GPro = "insert into 企业项目(级别,时间,名称,类型,创建人,创建时间,企业id)";
        $sql_GPro.= "values('".$Tab_5[0]."','".$Tab_5[1]."','".$Tab_5[2]."','政府','".$name."','".$date."','".$Clientid."')";
//      $result_GPro = $conn->query($sql_GPro);
    }
        //其他资质证书
    $Tab_5Arr = explode('//',$TabArr_5[6]);
    for($i=0;$i<count($Tab_5Arr);$i++){
        $Tab_5 = explode(',',$Tab_5Arr[$i]);
        $sql_GPro = "insert into 企业项目(级别,时间,名称,类型,创建人,创建时间,企业id)";
        $sql_GPro.= "values('".$Tab_5[0]."','".$Tab_5[1]."','".$Tab_5[2]."','其他','".$name."','".$date."','".$Clientid."')";
//      $result_GPro2 = $conn->query($sql_GPro2);
    }
    
    echo $sql_GPro;
    
    $conn->close();
?>