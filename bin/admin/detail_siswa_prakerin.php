<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="DU Sistem Seleksi";
        $active ="";
        $active16 = "active";
        $navactive9 ="nav-active";

        $id_du = $_GET["id"];

        if (empty($id_du)) {
            header("location:dusistemseleksi.php");
        }

        $data = mysql_query( "SELECT * FROM hb_du_umum, siswa, hb_prakerin, jurusan WHERE hb_prakerin.id_du=hb_du_umum.id_du AND siswa.nis = hb_prakerin.nis AND hb_prakerin.id_du='$id_du' AND jurusan.id_jurusan = siswa.id_jurusan");

        function tanggal($tglnya){
            $asli = date($tglnya);
            $ganti=str_replace("-", "/", $asli);
            $jadi= strtotime($ganti);

            $tanggal = date("j", $jadi);
            $tahun = date("Y", $jadi);
            $bulan = date("n", $jadi);

            $array_bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" );
            $bulan2 = $array_bulan[date($bulan)];

            $hasil = "$tanggal $bulan2 $tahun";
            return $hasil;
        }


        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <?php 
                            $f = mysql_fetch_array(mysql_query("SELECT nama_du FROM hb_du_umum WHERE id_du='$id_du'"));
                        ?>
                        <label><big>Detail Siswa Prakerin di <?php echo "$f[nama_du]" ;?></big></label>
                        <?php 
                            $g = mysql_fetch_array(mysql_query("SELECT status_verifikasi_hubin FROM hb_prakerin WHERE id_du='$id_du'"));
                            if ($g["status_verifikasi_hubin"]=="Terverifikasi Hubin") {
                                echo "
                                <span class='pull-right'>
                                 <a href='#print' data-toggle='modal' class='btn btn-danger'><span class='fa fa-print'></span> PRINT SURAT PENGANTAR</a>
                                </span>";
                            }

                        ?>
                    </header>

                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d[nama_siswa] </td>
                                        <td> $d[singkatan] - $d[kelas]</td>
                                        <td> $d[email_siswa]</td>
                                        <td> $d[no_telepon]</td>
                                    </tr>
                                    ";
                            }
                        ?>
                    </tbody>
                    </table>
                    </div>
                    </div>
                    </section>
                </div>
            </div>
        </div>

                <div class='modal fade' id='print' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Print Surat Pengantar</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='suratpengantar.php' enctype='multipart/form-data'>
                        
                       <?php
                                    echo "<input type='hidden' id='id' name='id_du' value='$_GET[id]'>";
                                    ?>
                                    
                        <label class='control-label col-md-2 col-sm-3 col-xs-12' for='name'>No Surat <span class='required'></span> </label>
                        <div class='col-lg-10'>

                                    <div class='col-md-2' style='padding: 0'><input type="text" value='422' required class='form-control m-bot15' id='petugas' style="width:50px" readonly>
                                    </div>
                                    <div class='col-md-2' style='padding: 0'><input type="text" required class='form-control m-bot15' id='petugas' style="width:60px" name='surat1'></div>
                                    <div class='col-md-4' style='padding: 0'><input type="text" value='SMKN.I-HUB' required class='form-control m-bot15' name='no_surat' id='petugas' style="width:120px" readonly></div>
                                    <div class='col-md-2' style='padding: 0'><input type="text" required class='form-control m-bot15' id='petugas' style="width:60px" name='surat2'></div>
                                    <div class='col-md-2' style='padding: 0'><input type="text" value='K.2016' required class='form-control m-bot15'  id='petugas' name='surat3'></div>
                                           
                                            </div>
                        <label class='control-label col-md-2 col-sm-3 col-xs-12' for='name'>Yth <span class='required'></span> </label>
                        <div class='col-lg-10'>
                        <input type="text" required class='form-control m-bot15' id='petugas' name='yth'>
                                    
                        </div>
                                
                </div>
                <div class='modal-footer' style="border: 0">
                    <div class='form-group'>
                        <div class='col-md-4 col-md-offset-8'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                            <button style=' margin-top: -5px;' value='pilih' id='send' type='submit' class='btn btn-success' name='pilih'>Print</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!--body wrapper end-->

<?php       include "footer.php";
    }else{
        header('location:tahun_ajaran.php');
    }
}else{
    header('location:../login.php');
}

?>
