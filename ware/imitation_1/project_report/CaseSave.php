<?php
	require'../../../AHeader.php';
	$falg = $_REQUEST['falg'];
	require'../../../conn.php';
	switch($falg){
		case 'casesave':
			$ayr=$_GET['ayr'];
			$dlr=$_GET['dlr'];
			$ProName=$_GET['ProName'];
			$AgentName=$_GET['AgentName'];
			$CaseElse=$_GET['CaseElse'];
			$date = date('Y-m-d H:i:s');
			$pageFalg = $_GET['pageFalg'];
			$CaseType = $_GET['CaseType'];
			$beginTime = $_GET['beginTime'];
			$endTime = $_GET['endTime'];
			if($pageFalg=='new'){
				$pageFalg='待启动';
			}else{
				$pageFalg='处理中';
			}
			//保存信息
			$new_id = "0";
			$sql = "insert into 专案_项目申报 (案源人,代理人,创建人,创建时间,项目名称,客户名,备注,案件状态,案件类型,计划开始,计划结束) values('".$ayr."','".$dlr."','".$name."','".$date."','".$ProName."','".$AgentName."','".$CaseElse."','".$pageFalg."','".$CaseType."','".$beginTime."','".$endTime."')";
			if($conn->query($sql)){
				$Stu = '新建成功';
				$new_id = $conn->insert_id;
			}else{
				$Stu = '新建失败';
			}
			echo $Stu.",".$new_id;
			break;
		case 'del':
			$id = $_GET['id'];
			$sql = "UPDATE 专案_项目申报  set `冻结状态`='2' WHERE `id`='".$id."' ";
			$conn->query($sql);
			break;
		case 'hidden':
			$id = $_GET['id'];
			$sql = "UPDATE 专案_项目申报  set `冻结状态`='3' WHERE `id`='".$id."' ";
			$conn->query($sql);
			break;
		case 'Save_upfile':
			$self_id = $_POST['self_id'];
			$save_path = "../../../filesave_xm/".$self_id;
			$ret_msg = "";
			if(count($_FILES)>0){
				require("../../../upload_func.php");
				foreach($_FILES as $ky =>$fileinfo){
					$all_path = File_share($fileinfo,$save_path);
					$savesql_path = "filesave_xm/".$self_id."/".pathinfo($all_path,PATHINFO_BASENAME);
					$sql = "INSERT INTO 专案_项目申报文件(对应id,文件路径,创建人,创建时间) VALUES(";
					$sql .= "'".$self_id."','".$savesql_path."','".$name."','".date("Y-m-d H:i:s")."')";
					if($conn->query($sql)){
						$ret_msg .= pathinfo($all_path,PATHINFO_BASENAME)."保存成功\n";
					}else{
						$ret_msg .= pathinfo($all_path,PATHINFO_BASENAME)."保存失败\n";
					}
				}
			}
			echo $ret_msg;
			break;
		case 'DelFile_info':
			$id = $_GET['id'];
			$ret = "";
			$sql = "update 专案_项目申报文件  set 删除状态=1 where id = '".$id."'";
			$sql1 = "SELECT 文件路径 ,对应id,创建人 FROM 专案_项目申报文件 WHERE id='".$id."'";
			$result1 = $conn->query($sql1);
			if($result1->num_rows>0){
			while($row1 = $result1->fetch_assoc()){
				$selfpath = $row1['文件路径'];
				$self_id= $row1['对应id'];
			}
			$sql2 = "INSERT INTO 专案_项目申报文件操作记录(Caseid,文件路径,操作员,操作名,记录时间) VALUES(";
			$sql2 .= "'".$self_id."','".$selfpath."','".$name."','3','".date("Y-m-d H:i:s")."')";
			$conn->query($sql2);
			}
			if($conn->query($sql)){
				$ret .= "删除记录成功";
				if($admin){
					$sql = "SELECT 文件路径 FROM 专案_项目申报文件 WHERE id='".$id."'";
					$result = $conn->query($sql);
					if($result->num_rows>0){
						$path = "";
						while($row = $result->fetch_assoc()){
							$path = $row['文件路径'];
						}
						if($path){
							$path_gbk = iconv("utf-8", "gbk", "../../../filesave_xm/".$path);
							if(file_exists($path_gbk)){
								if(unlink($path_gbk)){
									$ret .= ";\n".pathinfo($path,PATHINFO_BASENAME)."删除成功";
								}
							}
						}
					}
				}
			}else{
				$ret .= "删除失败";
			}
			echo $ret;
			break;
		case 'change':
			$order = $_GET['order'];
			$CaseId = $_GET['CaseId'];
			$sql = "update `专案_项目申报` set 案件状态 = '".$order."' WHERE id = '".$CaseId."'";
			$result = $conn->query($sql);
			if($result){
				echo '案件状态修改成功';
			}else{
				echo '案件状态修改失败';
			}
			break;
		case 'changeCaseType':
            $order = $_GET['order'];
            $CaseId = $_GET['CaseId'];
            $sql = "update `专案_项目申报` set 案件类型 = '".$order."' WHERE id = '".$CaseId."'";
            $result = $conn->query($sql);
            if($result){
                echo '案件类型修改成功';
            }else{
                echo '案件类型修改失败';
            }
            break;
        case 'CMS_Save':
//          $ayr = $_GET['ayr'];
//          $TabMes_1 = $_GET['TabMes_1'];
//          $TabMes_2 = $_GET['TabMes_2'];
//          $TabMes_3 = $_GET['TabMes_3'];
//          $TabMes_4 = $_GET['TabMes_4'];
//          $TabMes_5 = $_GET['TabMes_5'];
//          $TabMes_6 = $_GET['TabMes_6'];
//          $TabMes_7 = $_GET['TabMes_7'];
//          $CaseBz = $_GET['CaseBz'];
			$ayr = $_POST['ayr'];
            $TabMes_1 = $_POST['TabMes_1'];
            $TabMes_2 = $_POST['TabMes_2'];
            $TabMes_3 = $_POST['TabMes_3'];
            $TabMes_4 = $_POST['TabMes_4'];
            $TabMes_5 = $_POST['TabMes_5'];
            $TabMes_6 = $_POST['TabMes_6'];
            $TabMes_7 = $_POST['TabMes_7'];
            $CaseBz = $_POST['CaseBz'];
            $date = date('Y-m-d H:i:s');
//          echo $CaseBz;
            
            $TabArr_1 = explode('||',$TabMes_1);
            $TabArr_2 = explode('||',$TabMes_2);
            $TabArr_3 = explode('||',$TabMes_3);
            $TabArr_5 = explode('||',$TabMes_5);
            $TabArr_6 = explode('||',$TabMes_6);
            //检查企业名称是否重复
            $sql_Che = "select 企业名称 from 企业信息 where 企业名称='".$TabArr_1[0]."' and 状态=0";
            $result_Che = $conn->query($sql_Che);
            if($result_Che->num_rows>0){
                echo '企业名称重复，请检查后再新建';
                return;
            }else{
                //保存企业信息
                $sql0 = "insert into 企业信息 (企业名称,成立时间,企业类型,查账征收,主要营业,所属领域,注册资产,";//表格一
                $sql0.= "发明,实用,外观,软件,植物,集成,";//表格二
                $sql0.= "员工总数,个税申报,社保人数,社保比例,大专人数,大专比例,本科人数,本科比例,";//表格三
                $sql0.= "研发中心,高校合作,主导标准,";//表格五
                $sql0.= "技术改造,设备总额,";//表格六
                $sql0.= "备注,案源人,创建时间,创建人)";//其他
                //保存第一张表的信息
                $sql0.= "values('".$TabArr_1[0]."','".$TabArr_1[1]."','".$TabArr_1[2]."','".$TabArr_1[3]."','".$TabArr_1[4]."','".$TabArr_1[5]."','".$TabArr_1[6]."',";
                //保存第二张表的信息
                $sql0.= "'".$TabArr_2[0]."','".$TabArr_2[1]."','".$TabArr_2[2]."','".$TabArr_2[3]."','".$TabArr_2[4]."','".$TabArr_2[5]."',";
                //保存第三张表的信息
                $sql0.= "'".$TabArr_3[0]."','".$TabArr_3[1]."','".$TabArr_3[2]."','".$TabArr_3[3]."','".$TabArr_3[4]."','".$TabArr_3[5]."','".$TabArr_3[6]."','".$TabArr_3[7]."',";
                //保存第五张表的信息
                $sql0.= "'".$TabArr_5[0]."','".$TabArr_5[1]."','".$TabArr_5[2]."',"; 
                //保存第六张表的信息
                $sql0.= "'".$TabArr_6[0]."','".$TabArr_6[1]."',"; 
                //其他
                $sql0.= "'".$CaseBz."','".$ayr."','".$date."','".$name."')"; 
                $result = $conn->query($sql0);
                if($result){
                    //获取企业信息id
                    $sql_GetId = "select id from 企业信息 where 创建时间 = '".$date."' and 创建人 = '".$name."'";
                    $result_GetId = $conn->query($sql_GetId);
                    if($result_GetId->num_rows>0){
                        while($row=$result_GetId->fetch_assoc()){
                            $Clientid = $row['id'];
                        }
                    }
                }
                
                //保存财务情况
                $TabArr_4 = explode('||',$TabMes_4);
                for($i=0;$i<count($TabArr_4);$i++){
                    $Tab_4 = explode(',',$TabArr_4[$i]);
                    $sql_Fare = "insert into 企业财务 (年度,总资产,固定资产,总负债,总销售,净资产,研发经费,纳税总额,企业得税,年度负率,企业id,创建人,创建时间)";
                    $sql_Fare.= "values ('".$Tab_4[0]."','".$Tab_4[1]."','".$Tab_4[2]."','".$Tab_4[3]."','".$Tab_4[4]."','".$Tab_4[5]."','".$Tab_4[6]."','".$Tab_4[7]."','".$Tab_4[8]."','".$Tab_4[9]."','".$Clientid."','".$name."','".$date."')";
                    $result_Fare = $conn->query($sql_Fare);
                }
                
                //保存项目信息
                    //各级政府项目
                $Tab_5Arr = explode('//',$TabArr_5[3]);
                for($i=0;$i<count($Tab_5Arr);$i++){
                    $Tab_5 = explode(',',$Tab_5Arr[$i]);
                    $sql_GPro = "insert into 企业项目(级别,时间,名称,类型,创建人,创建时间,企业id)";
                    $sql_GPro.= "values('".$Tab_5[0]."','".$Tab_5[1]."','".$Tab_5[2]."','政府','".$name."','".$date."','".$Clientid."')";
                    $result_GPro = $conn->query($sql_GPro);
                }
                    //其他资质证书
                $Tab_5Arr = explode('//',$TabArr_5[4]);
                for($i=0;$i<count($Tab_5Arr);$i++){
                    $Tab_5 = explode(',',$Tab_5Arr[$i]);
                    $sql_GPro = "insert into 企业项目(级别,时间,名称,类型,创建人,创建时间,企业id)";
                    $sql_GPro.= "values('','".$Tab_5[0]."','".$Tab_5[1]."','其他','".$name."','".$date."','".$Clientid."')";
                    $result_GPro = $conn->query($sql_GPro);
                }
                
                //保存人员信息
                $TabArr_7 = explode('||',$TabMes_7);
                    //法人代表
                    $Tab_7A = explode('//',$TabArr_7[0]);
                    for($i=0;$i<count($Tab_7A);$i++){
                        $Tab_7 = explode(',',$Tab_7A[$i]);
                        $sql_Peo = "insert into 企业联系人(姓名,联系方式,人员类型,创建人,创建时间,企业id)";
                        $sql_Peo.= "values('".$Tab_7[0]."','".$Tab_7[1]."',0,'".$name."','".$date."','".$Clientid."')";
                        $result_Peo = $conn->query($sql_Peo);
                    }
                    
                    //财务管理
                    $Tab_7B = explode('//',$TabArr_7[1]);
                    for($i=0;$i<count($Tab_7B);$i++){
                        $Tab_7 = explode(',',$Tab_7B[$i]);
                        $sql_Peo = "insert into 企业联系人(姓名,联系方式,人员类型,创建人,创建时间,企业id)";
                        $sql_Peo.= "values('".$Tab_7[0]."','".$Tab_7[1]."',1,'".$name."','".$date."','".$Clientid."')";
                        $result_Peo = $conn->query($sql_Peo);
                    }
                    //技术管理
                    $Tab_7C = explode('//',$TabArr_7[2]);
                    for($i=0;$i<count($Tab_7C);$i++){
                        $Tab_7 = explode(',',$Tab_7C[$i]);
                        $sql_Peo = "insert into 企业联系人(姓名,联系方式,人员类型,创建人,创建时间,企业id)";
                        $sql_Peo.= "values('".$Tab_7[0]."','".$Tab_7[1]."',2,'".$name."','".$date."','".$Clientid."')";
                        $result_Peo = $conn->query($sql_Peo);
                    }
                    //日常联系
                    $Tab_7D = explode('//',$TabArr_7[3]);
                    for($i=0;$i<count($Tab_7D);$i++){
                        $Tab_7 = explode(',',$Tab_7D[$i]);
                        $sql_Peo = "insert into 企业联系人(姓名,联系方式,人员类型,创建人,创建时间,企业id)";
                        $sql_Peo.= "values('".$Tab_7[0]."','".$Tab_7[1]."',3,'".$name."','".$date."','".$Clientid."')";
                        $result_Peo = $conn->query($sql_Peo);
                    }
                
				//保存文件
				if(count($_FILES)>0){
					require_once "../../../upload_func.php";//连接函数保存文件
					foreach($_FILES as $index_val =>$fileinfo){
						$path = "../../../filesave_qy/".$Clientid;
						$ret_msg =  uploadFile_rj($fileinfo,$path);
						$ret_path = $ret_msg['dest'];
						$ret_path = substr($ret_path, 9);
						$ret_path_arr = explode("/", $ret_path);
						$file_basename = end($ret_path_arr);
						$sql = "INSERT INTO 企业文件(企业id,文件路径,上传时间,上传人) VALUES(";
						$sql .= "'".$Clientid."','".$ret_path."','".date("Y-m-d H:i:s")."','".$name."')";
						$conn->query($sql);
					}
				}
				    
                //保存
                if($sql_Fare){
                    echo 'ok';
                }else{
                    echo '操作失败请联系管理员';
                }
            }
            
            break;
        case 'CMS_Change':
            $Cid = $_POST['Cid'];
            //改变信息状态
                //企业信息
            $SQL_MesA = "update 企业信息 set 状态=2,删除时间='".date('Y-m-d H:i:s')."',删除人='".$name."' where id='".$Cid."' ";
            $conn->query($SQL_MesA);
                //企业财务
            $SQL_MesB = "update 企业财务 set 状态=2,删除时间='".date('Y-m-d H:i:s')."',删除人='".$name."' where 企业id='".$Cid."' ";
            $conn->query($SQL_MesB);
                //企业项目
            $SQL_MesC = "update 企业项目 set 状态=2,删除时间='".date('Y-m-d H:i:s')."',删除人='".$name."' where 企业id='".$Cid."'";
            $conn->query($SQL_MesC);
                //企业联系人
            $SQL_MesD = "update 企业联系人 set 状态=2,删除时间='".date('Y-m-d H:i:s')."',删除人='".$name."' where 企业id='".$Cid."' ";
            $conn->query($SQL_MesD);
            
            $ayr = $_POST['ayr'];
            $TabMes_1 = $_POST['TabMes_1'];
            $TabMes_2 = $_POST['TabMes_2'];
            $TabMes_3 = $_POST['TabMes_3'];
            $TabMes_4 = $_POST['TabMes_4'];
            $TabMes_5 = $_POST['TabMes_5'];
            $TabMes_6 = $_POST['TabMes_6'];
            $TabMes_7 = $_POST['TabMes_7'];
            $CaseBz = $_POST['CaseBz'];
            $date = date('Y-m-d H:i:s');
//          echo $CaseBz;
            
            $TabArr_1 = explode('||',$TabMes_1);
            $TabArr_2 = explode('||',$TabMes_2);
            $TabArr_3 = explode('||',$TabMes_3);
            $TabArr_5 = explode('||',$TabMes_5);
            $TabArr_6 = explode('||',$TabMes_6);
            //检查企业名称是否重复
            $sql_Che = "select 企业名称 from 企业信息 where 企业名称='".$TabArr_1[0]."' and id<>'".$Cid."' and 状态=0";
            $result_Che = $conn->query($sql_Che);
            if($result_Che->num_rows>0){
                echo '企业名称重复，请检查后再新建';
                return;
            }else{
                //保存企业信息
                $sql0 = "insert into 企业信息 (企业名称,成立时间,企业类型,查账征收,主要营业,所属领域,注册资产,";//表格一
                $sql0.= "发明,实用,外观,软件,植物,集成,";//表格二
                $sql0.= "员工总数,个税申报,社保人数,社保比例,大专人数,大专比例,本科人数,本科比例,";//表格三
                $sql0.= "研发中心,高校合作,主导标准,";//表格五
                $sql0.= "技术改造,设备总额,";//表格六
                $sql0.= "备注,案源人,创建时间,创建人)";//其他
                //保存第一张表的信息
                $sql0.= "values('".$TabArr_1[0]."','".$TabArr_1[1]."','".$TabArr_1[2]."','".$TabArr_1[3]."','".$TabArr_1[4]."','".$TabArr_1[5]."','".$TabArr_1[6]."',";
                //保存第二张表的信息
                $sql0.= "'".$TabArr_2[0]."','".$TabArr_2[1]."','".$TabArr_2[2]."','".$TabArr_2[3]."','".$TabArr_2[4]."','".$TabArr_2[5]."',";
                //保存第三张表的信息
                $sql0.= "'".$TabArr_3[0]."','".$TabArr_3[1]."','".$TabArr_3[2]."','".$TabArr_3[3]."','".$TabArr_3[4]."','".$TabArr_3[5]."','".$TabArr_3[6]."','".$TabArr_3[7]."',";
                //保存第五张表的信息
                $sql0.= "'".$TabArr_5[0]."','".$TabArr_5[1]."','".$TabArr_5[2]."',"; 
                //保存第六张表的信息
                $sql0.= "'".$TabArr_6[0]."','".$TabArr_6[1]."',"; 
                //其他
                $sql0.= "'".$CaseBz."','".$ayr."','".$date."','".$name."')"; 
                $result = $conn->query($sql0);
                if($result){
                    //获取企业信息id
                    $sql_GetId = "select id from 企业信息 where 创建时间 = '".$date."' and 创建人 = '".$name."'";
                    $result_GetId = $conn->query($sql_GetId);
                    if($result_GetId->num_rows>0){
                        while($row=$result_GetId->fetch_assoc()){
                            $Clientid = $row['id'];
                        }
                    }
                }
                
                //保存财务情况
                $TabArr_4 = explode('||',$TabMes_4);
                for($i=0;$i<count($TabArr_4);$i++){
                    $Tab_4 = explode(',',$TabArr_4[$i]);
                    $sql_Fare = "insert into 企业财务 (年度,总资产,固定资产,总负债,总销售,净资产,研发经费,纳税总额,企业得税,年度负率,企业id,创建人,创建时间)";
                    $sql_Fare.= "values ('".$Tab_4[0]."','".$Tab_4[1]."','".$Tab_4[2]."','".$Tab_4[3]."','".$Tab_4[4]."','".$Tab_4[5]."','".$Tab_4[6]."','".$Tab_4[7]."','".$Tab_4[8]."','".$Tab_4[9]."','".$Clientid."','".$name."','".$date."')";
                    $result_Fare = $conn->query($sql_Fare);
                }
                
                //保存项目信息
                    //各级政府项目
                $Tab_5Arr = explode('//',$TabArr_5[3]);
                for($i=0;$i<count($Tab_5Arr);$i++){
                    $Tab_5 = explode(',',$Tab_5Arr[$i]);
                    $sql_GPro = "insert into 企业项目(级别,时间,名称,类型,创建人,创建时间,企业id)";
                    $sql_GPro.= "values('".$Tab_5[0]."','".$Tab_5[1]."','".$Tab_5[2]."','政府','".$name."','".$date."','".$Clientid."')";
                    $result_GPro = $conn->query($sql_GPro);
                }
                    //其他资质证书
                $Tab_5Arr = explode('//',$TabArr_5[4]);
                for($i=0;$i<count($Tab_5Arr);$i++){
                    $Tab_5 = explode(',',$Tab_5Arr[$i]);
                    $sql_GPro = "insert into 企业项目(级别,时间,名称,类型,创建人,创建时间,企业id)";
                    $sql_GPro.= "values('','".$Tab_5[0]."','".$Tab_5[1]."','其他','".$name."','".$date."','".$Clientid."')";
                    $result_GPro = $conn->query($sql_GPro);
                }
                
                //保存人员信息
                $TabArr_7 = explode('||',$TabMes_7);
                    //法人代表
                    $Tab_7A = explode('//',$TabArr_7[0]);
                    for($i=0;$i<count($Tab_7A);$i++){
                        $Tab_7 = explode(',',$Tab_7A[$i]);
                        $sql_Peo = "insert into 企业联系人(姓名,联系方式,人员类型,创建人,创建时间,企业id)";
                        $sql_Peo.= "values('".$Tab_7[0]."','".$Tab_7[1]."',0,'".$name."','".$date."','".$Clientid."')";
                        $result_Peo = $conn->query($sql_Peo);
                    }
                    
                    //财务管理
                    $Tab_7B = explode('//',$TabArr_7[1]);
                    for($i=0;$i<count($Tab_7B);$i++){
                        $Tab_7 = explode(',',$Tab_7B[$i]);
                        $sql_Peo = "insert into 企业联系人(姓名,联系方式,人员类型,创建人,创建时间,企业id)";
                        $sql_Peo.= "values('".$Tab_7[0]."','".$Tab_7[1]."',1,'".$name."','".$date."','".$Clientid."')";
                        $result_Peo = $conn->query($sql_Peo);
                    }
                    //技术管理
                    $Tab_7C = explode('//',$TabArr_7[2]);
                    for($i=0;$i<count($Tab_7C);$i++){
                        $Tab_7 = explode(',',$Tab_7C[$i]);
                        $sql_Peo = "insert into 企业联系人(姓名,联系方式,人员类型,创建人,创建时间,企业id)";
                        $sql_Peo.= "values('".$Tab_7[0]."','".$Tab_7[1]."',2,'".$name."','".$date."','".$Clientid."')";
                        $result_Peo = $conn->query($sql_Peo);
                    }
                    //日常联系
                    $Tab_7D = explode('//',$TabArr_7[3]);
                    for($i=0;$i<count($Tab_7D);$i++){
                        $Tab_7 = explode(',',$Tab_7D[$i]);
                        $sql_Peo = "insert into 企业联系人(姓名,联系方式,人员类型,创建人,创建时间,企业id)";
                        $sql_Peo.= "values('".$Tab_7[0]."','".$Tab_7[1]."',3,'".$name."','".$date."','".$Clientid."')";
                        $result_Peo = $conn->query($sql_Peo);
                    }
                
                //保存文件
                if(count($_FILES)>0){
                    require_once "../../../upload_func.php";//连接函数保存文件
                    foreach($_FILES as $index_val =>$fileinfo){
                        $path = "../../../filesave_qy/".$Clientid;
                        $ret_msg =  uploadFile_rj($fileinfo,$path);
                        $ret_path = $ret_msg['dest'];
                        $ret_path = substr($ret_path, 9);
                        $ret_path_arr = explode("/", $ret_path);
                        $file_basename = end($ret_path_arr);
                        $sql = "INSERT INTO 企业文件(企业id,文件路径,上传时间,上传人) VALUES(";
                        $sql .= "'".$Clientid."','".$ret_path."','".date("Y-m-d H:i:s")."','".$name."')";
                        $conn->query($sql);
                    }
                }
                    
                //保存
                if($sql_Fare){
                    echo 'ok';
                }else{
                    echo '操作失败请联系管理员';
                }
            }
            
            break;
        case 'OpenPro':
            $CaseId = $_GET['CaseId'];
            $sql = "update `专案_项目申报` set 案件状态 = '处理中',实际开始='".date('Y-m-d H:i:s')."' WHERE id = '".$CaseId."'";
            $result = $conn->query($sql);
            break;
        case 'EndPro':
            $CaseId = $_GET['CaseId'];
            $sql = "update `专案_项目申报` set 案件状态 = '已完成',实际结束='".date('Y-m-d H:i:s')."' WHERE id = '".$CaseId."'";
            $result = $conn->query($sql);
            break;
        case 'ChangeBZ':
            $CaseId = $_GET['CaseId'];
            $CaseBz = $_GET['CaseBz'];
            $sql = "update `专案_项目申报` set 备注 = '".$CaseBz."' WHERE id = '".$CaseId."'";
            $result = $conn->query($sql);
            break;
		case 'Delete_file':
			$file_id = $_GET["file_id"];//企业文件的id
			$sql = "UPDATE 企业文件 SET 删除状态='1',删除时间='".date("Y-m-d H:s:i")."' WHERE id='".$file_id."'";
			if($conn->query($sql)){
				echo "删除成功";
			}else{
				echo "删除失败";
			}
			break;
	    case 'DelCase':
	        $CId = $_GET["CId"];
	        $sql = "UPDATE 企业信息  SET 状态='1',删除时间='".date("Y-m-d H:s:i")."',删除人='".$name."' WHERE id='".$CId."'";
            if($conn->query($sql)){
                echo "ok";
            }else{
                echo "删除失败";
            }
	        break;
		case 'Del_file':
			$file_id = $_GET['file_id'];
			$ret_msg = "";
			if($admin){
				$sql = "SELECT 文件路径 FROM 项目文件管理 WHERE id='".$file_id."'";
				$result = $conn->query($sql);
				if($result->num_rows>0){
					$utf_path = "";
					$file_name = "";
					while($row = $result->fetch_assoc()){
						$utf_path = "../../../".$row["文件路径"];
						$tmp_arr = explode("/", $utf_path);
						$file_name = end($tmp_arr);
					}
					if($utf_path != ""){
						$gbk_path = iconv("utf-8", "gbk", $utf_path);
						if(file_exists($gbk_path)){
							if(unlink($gbk_path)){
								$sql = "UPDATE 项目文件管理 SET 删除状态='1',删除时间='".date("Y-m-d H:i:s")."' WHERE id='".$file_id."'";
								if($conn->query($sql)){
									$ret_msg = "删除记录成功\n删除".$file_name."文件成功";
								}else{
									$ret_msg = "删除记录失败\n删除".$file_name."文件成功";
								}
							}
						}else{//文件不存在
							$sql = "UPDATE 项目文件管理 SET 删除状态='1',删除时间='".date("Y-m-d H:i:s")."' WHERE id='".$file_id."'";
							if($conn->query($sql)){
								$ret_msg = "删除记录成功";
							}else{
								$ret_msg = "删除记录失败";
							}
						}
						
					}else{
						$ret_msg = "删除失败：查询文件路径不存在！";
					}
				}
				
			}else{
				$sql = "UPDATE 项目文件管理 SET 删除状态='1',删除时间='".date("Y-m-d H:i:s")."' WHERE id='".$file_id."'";
				if($conn->query($sql)){
					$ret_msg = "删除记录成功";
				}else{
					$ret_msg = "删除记录失败";
				}
			}
			
			echo $ret_msg;
			break;
		default:break;
	}
	
$conn->close();
?>