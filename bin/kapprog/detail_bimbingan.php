<?php

include "../koneksidb.php";
?>

<?php
if($_SESSION['level']=='kapprog'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Daftar Siswa yang Dimonitoring";
        $active ="";
        $active19 = "active";
        $id = $_GET['id'];

        include "leftside2.php";

        $_SESSION['nis'] = $_GET['id'];

        ?>
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Monitoring</big>
                         
                    </header>
                   
                    <div class="panel-body">
                        <div class='col-md-12' id='cb' style='height: 380px;overflow: auto'>
                        
                            <div id="chat"></div>
                        </div>
                        <div class='col-md-12' style='height: 100px'>

                        <form method="post" action="detail_bimbingan.php?id=<?php echo $id;?>">
                        <textarea class='col-md-11' name="msg" placeholder="Enter Message"></textarea>
                            <input type="submit" class='btn btn-primary' style='margin:5px' name="submit" value="Send it"/>
                            
                        </form>
                        </div>
                    </div>
                    </section>
                </div>
            </div>
        </div>
        <!--body wrapper end-->

       <?php 
        if(isset($_POST['submit'])){ 
        
        $msg = $_POST['msg'];
        $tgl = date('Y-m-d H:i:s');
        $query = "INSERT INTO hb_bimbingan (pengirim,penerima,pesan,tanggal) values ('$_SESSION[username]','$id','$msg','$tgl')";
        
        mysql_query($query);
        
        }
        
        include "footer2.php";
    }else{
        header('location:tahun_ajaran.php');
    }
}else{
    header('location:../login.php');
}

?>