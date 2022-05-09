<div class="menu-right">
    <ul class="notification-menu">
        <li>
            <div class="dropdown-menu dropdown-menu-head pull-right" >
                <h5 class="title">事件监控</h5>
            		<?php
		        		//表“事件监控”
            			require("conn.php");
            			$sqlC = "SELECT count(id) as Num FROM 事件监控  WHERE 状态='0'";
						$resultC = $conn->query($sqlC);
						if($resultC->num_rows>0){
							while($rowC = $resultC->fetch_assoc()){
								$Num2 = $rowC['Num'];
							}
						}
					?>
					<div <?php if($Num2>5){echo "style='width:300px;height:400px;overflow:auto;'";} ?> > 
						<ul class="dropdown-list normal-list">
					<?php
							$sql2 = "SELECT id,案卷号,创建时间,提醒时间,截止时间,监控描述,DATEDIFF(截止时间,DATE_FORMAT(NOW(),'%Y-%m-%d')) AS 剩余天数 FROM 事件监控  WHERE 状态='0'";
							$result2 = $conn->query($sql2);
							if($result2->num_rows>0){
								while($row2 = $result2->fetch_assoc()){
									if($row2['剩余天数'] <=10){
										if($row2['剩余天数'] <= 0  ){
						?>
									<li class="new">
				                        <!--<a href="">-->
				                            <span class="label label-danger"><i class="fa fa-bolt"></i></span>
				                            <span class="name"><?php echo $row2['案卷号']; ?>-<?php echo $row2['剩余天数'];?></span>
				                            <em class="small"><?php echo $row2['监控描述']; ?></em>
				                        <!--</a>-->
				                    </li>
						<?php
										}else{
						?>
									<li class="new">
				                        <!--<a href="">-->
				                            <span class="label label-warning"><i class="fa fa-bolt"></i></span>
				                            <span class="name"><?php echo $row2['案卷号']; ?>-<?php echo $row2['剩余天数'];?></span>
				                            <em class="small"><?php echo $row2['监控描述']; ?></em>
				                        <!--</a>-->
				                    </li>
						<?php
										}
									}			
								}
							}
						?>
                	
                    <li class="new"><a href="../../../remindT.php">
                    		<span class="desc">
                              <span >进入提醒页面</span>
                            </span>
                    </a></li>
                </ul>
                </div>
            </div>
            <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                <i class="fa fa-clock-o"></i>
                <span class="badge"><?php if($Num2){echo $Num2;} ?></span>
            </a>
        </li>
        <li>
            <div class="dropdown-menu dropdown-menu-head pull-right">
                <h5 class="title">日程备忘</h5>
            		<?php
            			$sqlC = "select count(id) as Num  from 日程设置 where 用户id='".$userid."' and 事件时间='".date('Y-m-d')."' and 删除状态=0 ";
						$resultC = $conn->query($sqlC);
						if($resultC->num_rows>0){
							while($rowC = $resultC->fetch_assoc()){
								$Num = $rowC['Num'];
							}
						}
					?>
					<div <?php if($Num>5){echo "style='width:300px;height:400px;overflow:auto;'";} ?> > 
						<ul class="dropdown-list normal-list">
					<?php
							$sql = "select id,事件名,状态,备注  from 日程设置 where 用户id='".$userid."' and 事件时间='".date('Y-m-d')."' and 删除状态=0 ";
						    $result = $conn->query($sql);
							if($result->num_rows>0){
								while($row = $result->fetch_assoc()){
						?>
									<li class="new">
				                        <!--<a href="">-->
				                            <span class="label label-danger"><i class="fa fa-bolt"></i></span>
				                            <span class="name"><?php echo $row['事件名']; ?></span>
				                            <em class="small"><?php echo $row['备注']; ?></em>
				                        <!--</a>-->
				                    </li>
						<?php
								}
							}
						?>
                	
                    <li class="new"><a href="../../imitation_2/dateworks.php">
                    		<span class="desc">
                              <span >进入日程管理</span>
                            </span>
                    </a></li>
                </ul>
                </div>
            </div>
            <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                <i class="fa fa-calendar"></i>
                <span class="badge"><?php if($Num){echo $Num;} ?></span>
            </a>
        </li>
        <li>
            <div class="dropdown-menu dropdown-menu-head pull-right">
                <h5 class="title">待处理文件</h5>
            		<?php
            			require("conn.php");
						$sqlC = "SELECT count(id) as Num FROM 接收文件 WHERE 接收人用户id LIKE '%".$userid."%' AND 删除状态=0";
						$resultC = $conn->query($sqlC);
						if($resultC->num_rows>0){
							while($rowC = $resultC->fetch_assoc()){
								$Num3 = $rowC['Num'];
							}
						}
					?>
					<div <?php if($Num3>5){echo "style='width:300px;height:400px;overflow:auto;'";} ?> > 
						<ul class="dropdown-list normal-list">
					<?php
							$sql3 = "SELECT id,b.名称 AS 发送人,文件路径,发送时间 FROM 接收文件 a,用户 b WHERE a.发送人用户id=b.id AND  接收人用户id LIKE '%".$userid."%' AND 删除状态=0";
							$result3 = $conn->query($sql3);
							if($result3->num_rows>0){
								while($row3 = $result3->fetch_assoc()){
						?>
								<li class="new">
			                        <!--<a href="">-->
			                            <span class="label label-danger"><i class="fa fa-bolt"></i></span>
			                            <span class="name"><?php echo $row3['发送人']; ?>-<?php echo $row3['发送时间'];?></span>
			                            <em class="small"><?php echo pathinfo($row3['文件路径'],PATHINFO_BASENAME); ?></em>
			                        <!--</a>-->
			                    </li>
						<?php
								}
							}
						?>
                	
                    <li class="new"><a href="../../../remindT.php">
                    		<span class="desc">
                              <span >进入提醒页面</span>
                            </span>
                    </a></li>
                </ul>
                </div>
            </div>
            <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                <i class="fa fa-sign-in"></i>
                <span class="badge"><?php if($Num3){echo $Num3;} ?></span>
            </a>
        </li>
        <li>
            <div class="dropdown-menu dropdown-menu-head pull-right">
                <h5 class="title">缴费通知</h5>
            		<?php
            			require("conn.php");
            			$sqlC = "SELECT count(id) as Num  from  专案待缴费  where (费用状态=0 or 费用状态=1 or 费用状态=8) and 剩余天数<'10'";
						$resultC = $conn->query($sqlC);
						if($resultC->num_rows>0){
							while($rowC = $resultC->fetch_assoc()){
								$Num4 = $rowC['Num'];
							}
						}
					?>
					<div <?php if($Num4>5){echo "style='width:300px;height:400px;overflow:auto;'";} ?> > 
						<ul class="dropdown-list normal-list">
					<?php
							$sql4 = "SELECT id,`案卷号`,类型,`申请号`,费用名称,`金额`,`缴费期限`,申请人,案源人,代理人,申请日,`专利名称`,提醒时间,剩余天数,申请人id  from  专案待缴费  where (费用状态=0 or 费用状态=1 or 费用状态=8) and 剩余天数<'10'";
							$result4 = $conn->query($sql4);
							if($result4->num_rows>0){
								while($row4 = $result4->fetch_assoc()){
						?>
									<li class="new">
				                        <!--<a href="">-->
				                            <span class="label label-danger"><i class="fa fa-bolt"></i></span>
				                            <span class="name"><?php echo $row4['案卷号']; ?>-<?php echo $row4['费用名称']; ?></span>
				                            <em class="small">(<?php echo $row4['剩余天数'];?>)</em>
				                        <!--</a>-->
				                    </li>
						<?php
								}
							}
							$conn->close();
						?>
                	
                    <li class="new"><a href="../../../remindT.php">
                    		<span class="desc">
                              <span >进入提醒页面</span>
                            </span>
                    </a></li>
                </ul>
                </div>
            </div>
            <a href="#" class="btn btn-default dropdown-toggle info-number" data-toggle="dropdown">
                <i class="fa fa-tasks"></i>
                <span class="badge"><?php if($Num4){echo $Num4;} ?></span>
            </a>
        </li>
        <li>
            <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <?php echo $name; ?>
            </a>
        </li>
    </ul>
</div>
