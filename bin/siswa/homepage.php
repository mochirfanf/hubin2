<?php

include "../koneksidb.php";

if($_SESSION['level']=='siswa'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active ="";
        $active1 = "active";

        $f = mysql_query("SELECT * FROM siswa INNER JOIN jurusan ON siswa.id_jurusan=jurusan.id_jurusan WHERE nis='$_SESSION[username]'")or die(mysql_error());
        $dl=mysql_fetch_array($f);
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
                        <big>Dashboard Siswa</big>
                         <span class="pull-right">

                         </span>
                         
                    </header>
                    <div class="panel-body">
                        <div class='col-md-6 pp'>
                            <div class='col-md-12 bpk'>
                            <span class='col-md-12 hdl'>Berita Kerja</span>
                            <span class='col-md-12 hpt'></span>
                            <span>
                                <?php
                                    $f = mysql_query("SELECT *, hb_lamar_kerja.status as st FROM hb_lamar_kerja INNER JOIN hb_du_permintaan_kerja  ON hb_du_permintaan_kerja.id_du_kerja = hb_lamar_kerja.id_du_kerja INNER JOIN hb_du_umum ON hb_du_umum.id_du = hb_du_permintaan_kerja.id_du WHERE nis='$_SESSION[username]' AND ( hb_lamar_kerja.status='Lamaran Diterima' OR hb_lamar_kerja.status='Lamaran Ditolak')")or die(mysql_error());
                                    
                                    while($dl=mysql_fetch_array($f)){

                                        if($dl['st']=='Lamaran Diterima'){
                                            ?>
                                            <div class='col-md-12 blam'>
                                            <?php
                                            echo 'Lamaran Anda di '.$dl['nama_du']." diterima, Silahkan hubungi perusahaan yang bersangkutan ";
                                            ?>
                                            </div>
                                            <a href='#detail' data-toggle='modal' data-id='<?php echo $dl['id_du_kerja']?>'><span class='btn btn-warning' style='float:right;'>Detail</span></a>
                                            <div class='col-md-12' style='border-bottom: 1px solid #fff;height:8px'></div>
                                            <?php

                                        }else if($dl['st']=='Lamaran Ditolak'){
                                            ?>
                                            <div class='col-md-12 blam'>
                                            <?php
                                            echo 'Mohon Maaf '.$dl['nama_du']." belum dapat menerima anda sebagai Karyawan";
                                            ?>
                                            </div>
                                            <a href='#detail' data-toggle='modal' data-id='<?php echo $dl['id_du_kerja']?>'><span class='btn btn-warning' style='float:right'>Detail</span></a>

                                            <?php
                                        }
                                    }
                                ?>
                            </span>
                            </div>
                        </div>
                        <div class='col-md-6 pp'>
                            <div class='col-md-12 bpk'>
                            <span class='col-md-12 hdl'>Berita Prakerin</span>
                            <span class='col-md-12 hpt'></span>
                            <span>
                            <div class='col-md-12 blam'>

                                <?php
                                $d = mysql_query("SELECT * FROM hb_prakerin WHERE nis='$_SESSION[username]'");
                                 $g = mysql_fetch_array($d);

                                  $d2 = mysql_query("SELECT * FROM hb_monitoring INNER JOIN guru ON guru.nip_guru = hb_monitoring.nip_guru WHERE id_du='$g[id_du]' AND tahun_ajaran='$_SESSION[tahun_ajaran]'");
                                 $g2 = mysql_fetch_array($d2);

                                 if($g2['tgl_monitoring']!=''){
                                    ?>

                                    <div class='col-md-12 blam'>
                                    <?php echo "$g2[nama_guru] akan memonitoring pada $g2[tgl_monitoring]";?>
                                    </div>
                                    <div class='col-md-12' style='border-bottom: 1px solid #fff;height:8px'></div>
                                    <?php
                                 }

                                 if($g['saran_pembimbing']!=''){
                                    ?>

                                    <div class='col-md-12 blam'>
                                    <?php echo "Kaprog Telah menentukkan Pembimbing Anda";?>
                                    </div>
                                    <div class='col-md-12' style='border-bottom: 1px solid #fff;height:8px'></div>
                                    <?php
                                 }

                                 if($g['status_verifikasi_hubin']!=''){
                                    ?>

                                    <div class='col-md-12 blam'>
                                    <?php echo "Tempat Prakerin Telah Diverifikasi Hubin";?>
                                    </div>
                                    <div class='col-md-12' style='border-bottom: 1px solid #fff;height:8px'></div>
                                    <?php
                                 }

                                 //$f = mysql_fetch_row(mysql_query("SELECT * FROM hb_monitoring WHERE id_du='$g[id_du]'")) or die(mysql_error());
                                 
                                 //if($f>0){
                                 //   echo 'Tanggal Monitoring : '.$f['tgl_monitoring'];
                                 //}else{

                                 //   echo "Tanggal Monitoring Belum Ditentukan";
                                 //}
                                 //echo $f;

                                 ?>
                                 </div>
                            </span>
                            </div>
                        </div>
                    </div>
                    </section>
                </div>
            </div>
        </div>

        <!--body wrapper end-->


            <div class='modal fade' id='detail' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<?php

                                    

?>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Detail Pekerjaan Kerja</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='' enctype='multipart/form-data'>
                        
                        <div class="col-lg-12"><?php
                                    echo "<input type='hidden' id='id' name='id'>";
                                    ?>
                                    <div class='col-md-12'>
                                        <h3 id='namadu'></h3><br>

                                <span class="form-horizontal form-label-left">
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Jurusan : </label>
                                        <div class="col-lg-6 flat-green">
                                            <span id='jurusan'></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Nama Penanggung Jawab :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <span id='penanggung'></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Kontak Penanggung Jawab :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                           <span id='cp'></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Jenis Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <span id='jenis_seleksi'></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tempat Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <span id='tempat'></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <span id='tanggal'></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Gaji :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <span id='gaji'></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Lainnya :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <span id='lain'></span>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                </div>
                <div class='modal-footer' style='border: 0'>
                    <div class='form-group'>
                        <div class='col-md-4 col-md-offset-8'>
                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                            <button style=' margin-top: -5px;' value='pilih' id='send' type='submit' class='btn btn-success' name='pilih'>Pilih</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php       include "footer.php";
    }else{
        header('location:tahun_ajaran.php');
    }
}else{
    header('location:../login.php');
}

?>
