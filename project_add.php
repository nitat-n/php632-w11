<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>php-id-w11</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="bootstrap/js/html5shiv.min.js"></script>
            <script src="bootstrap/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>        
        <div class="container">
            <div class="row"> 
                <div class="jumbotron" style="background-color: cornflowerblue;">
                    <?php include 'topbanner.php';?>
                </div>
            </div>
            <div class="row">
                <?php include 'menu.php';?>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <p>Login Area</p>
                </div>  
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <h4>เพิ่มข้อมูลโครงงาน</h4>
                    <?php
                        if(isset($_GET['submit'])){
                            $prg_name_th = $_GET['prg_name_th'];
                            $prg_name_en = $_GET['prg_name_en'];
                            $prj_stt_id = $_GET['prj_stt_id'];
                            $prj_ptt_id = $_GET['prj_ptt_id'];
                            $prj_lct_id = $_GET['prj_lct_id'];
                            $tools = $_GET['tools'];
                            $student = $_GET['student'];
                            $sql1 = "insert into project value";
                            $sql1 .= " ('null','$prg_name_th','$prg_name_th','$prj_stt_en','$prj_ptt_id','$prj_lct_id')";
                            echo $sql1."<br>";
                            if(mysqli_query($conn,$sql1)){
                            $prg_id = mysqli_insert_id($conn);
                            foreach($tools as $tls){
                                $sql1 = "insert into project_tools (pjt_prg_id,pjt_tls_id) value";
                                $sql2 .= "('$prj_id','$tls')";
                                mysqli_query($conn,$sql2);
                                echo $sql2."<br>";
                            }
                            foreach($student as $stds){
                                $sql3 = "insert into project_tools (pjt_prj_id,pjt_std_id) value";
                                $sql3 .= "('$prj_id','$tls')";
                                mysqli_query($conn,$sql2);
                                echo $sql2."<br>";
                            }
                            
                            echo "บันทึกโปรเจค $prj_name_th เรียบร้อย";

                            }else{
                            echo "บันทึกโปรเจค ผิดพลาด";
                            }
                            mysqli_close($conn);
                            
                        }else{
                    ?>
                    <br>
                        <div class="form-group">
                            <label for="prg_name_th" class="col-md-2 col-lg-2 control-label">ชื่อโครงงาน(ภาษาไทย)</label>
                            <div class="col-md-10 col-lg-10"> 
                                <textarea name="prj_name_th" rows="5" id="prj_name_th" class="form-control"></textarea>
                                <br>
                            </div>    
                        </div> 
                        <br>   
                        <div class="form-group">
                            <label for="prg_name_en" class="col-md-2 col-lg-2 control-label">ชื่อโครงงาน(ภาษาอังกฤษ)</label>
                            <div class="col-md-10 col-lg-10">
                            <textarea name="prj_name_en" rows="5" id="prj_name_en" class="form-control"></textarea>
                            <br>
                            </div>    
                        </div>
                        <div class="form-group">
                            <label for="prj_stt_id" class="col-md-2 col-lg-2 control-label">สถานะโครงงาน</label>
                            <div class="col-md-10 col-lg-10">
                                <select name="prj_stt_id" id="prj_stt_id" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql =  'SELECT * FROM project_status '
                                            . 'order by pst_id';
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['pst_id'] . '">';
                                        echo $row['pst_name'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                                <br>
                           </div> 
                              
                        </div>

                        
                        <div class="form-group">
                            <label for="prj_pij_id" class="col-md-2 col-lg-2 control-label">สาขาวิชา</label>
                            <div class="col-md-10 col-lg-10">
                                <select name="prj_pij_id" id="prj_pij_id" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql =  'SELECT * FROM program '
                                            . 'order by prg_id';
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['prg_id'] . '">';
                                        echo $row['prg_name'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                                <br>
                           </div>    
                        </div> 
                        
                        <div class="form-group">
                             <label class="col-md-2 col-lg-2 control-label">เครื่องมือ</label>
                            <div class="col-md-10 col-lg-10">        
                            <?php 
                                include 'connectdb.php';
                                $sql =  'SELECT * FROM tools ';
                                $result = mysqli_query($conn,$sql);
                                while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                    $tid = 'tools['.$row['tls_id'].']';
                                    echo '<input type ="checkbox" name="'.$tid.'"';
                                    echo 'id="'.$tid . '" ' ;
                                    echo 'value="'.$row['tls_id'].'" class="form-control-lg">';
                                    echo '<label for="'.$tid.'"> '.$row['tls_name'];
                                    echo ' </label>';
                                }
                                mysqli_free_result($result);
                                echo '</tabel>';
                                mysqli_close($conn);
                                
                            ?>
                            </div>
                            <br><br>
                        </div>
                    
                        <div class="form-group">
                            <label for="prj_lct_id" class="col-md-2 col-lg-2 control-label">อาจารย์ที่ปรึกษา</label>
                            <div class="col-md-10 col-lg-10">
                                <select name="prj_lct_id" id="prj_lct_id" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql =  'SELECT * FROM lecturer_detail';
                                        
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['lct_id'] . '">';
                                        
                                        echo $row['lct_fname'];
                                        echo $row['lct_lname'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                                <br>
                           </div>    
                        </div>

                        <div class="form-group">
                          <label class="col-md-2 col-lg-2 control-label">นักศึกษา</label>
                          <div class="col-md-10 col-lg-10">
                          <?php 
                                include 'connectdb.php';
                                $sql =  'SELECT * FROM student_detail ';
                                $result = mysqli_query($conn,$sql);
                                while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                    $tid = 'student['.$row['std_id'].']';
                                    echo '<input type ="checkbox" name="'.$tid.'"';
                                    echo 'id="'.$tid . '" ' ;
                                    echo 'value="'.$row['std_id'].'"  class="form-control-lg">';
                                    echo '<label for="'.$tid.'">'.$row['std_fname'].$row['std_lname']; 
                                    echo '</label>';
                                }
                                mysqli_free_result($result);
                                echo '</tabel>';
                                mysqli_close($conn);
                            ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-lg-10">
                                <input type="submit" name="submit" value="ตกลง" class="btn btn-default">
                            </div>    
                        </div>
                         
                    </form>
                    <?php
                        }
                    ?>
                </div>    
            </div>
            <div class="row">
                <address>คณะวิทยาการคอมพิวเตอร์และเทคโนโลยีสารสนเทศ</address>
            </div>
        </div>    
    </body>
</html>