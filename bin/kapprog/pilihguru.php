<?php

include "../koneksidb.php";

if($_SESSION['level']=='kapprog'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Daftar Siswa yang Dimonitoring";
        $active ="";
        $active19 = "active";
        $navactive7 ="nav-active";

        $data = mysql_query( "SELECT *, hb_monitoring.nip_guru as ng FROM hb_prakerin INNER JOIN hb_monitoring ON hb_prakerin.id_du=hb_monitoring.id_du INNER JOIN hb_du_jumlah_permintaan_du ON hb_du_jumlah_permintaan_du.id_du = hb_prakerin.id_du WHERE hb_prakerin.tahun_ajaran='$_SESSION[tahun_ajaran]' AND hb_du_jumlah_permintaan_du.id_jurusan=$_SESSION[jurusan] GROUP BY hb_prakerin.id_du")or die(mysql_error());
       
       
        include "leftside.php"; ?>
                
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Daftar Perusahaan</big>
                         
                    </header>
                   
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tempat Prakerin</th>
                        <th>Alamat Tempat Prakerin</th>
                        <th>Kota</th>
                        <th>Penanggung Jawab</th>
                        <th>Petugas</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                $d2 = mysql_fetch_array(mysql_query("SELECT nama_guru FROM guru WHERE nip_guru ='$d[ng]'"))or die(mysql_error());
                                $d3 = mysql_fetch_array(mysql_query("SELECT nama_siswa,id_jurusan,kelas FROM siswa WHERE nis ='$d[nis]'"));
                                $d4 = mysql_fetch_array(mysql_query("SELECT id_du, kabupaten.nama AS namakab, nama_du, alamat, nama_penanggung_jawab_umum FROM hb_du_umum INNER JOIN kabupaten ON kabupaten.id_kab=hb_du_umum.id_kab WHERE id_du ='$d[id_du]'"))or die(mysql_error());

                                $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE id_jurusan='$d3[id_jurusan]'"));
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d4[nama_du]</td>
                                        <td> $d4[alamat]</td>
                                        <td> $d4[namakab]</td>
                                        <td> $d4[nama_penanggung_jawab_umum]</td>
                                        <td> $d2[nama_guru]</td>
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
        <!--body wrapper end-->



<?php       include "footer.php";
    }else{
        header('location:tahun_ajaran.php');
    }
}else{
    header('location:../login.php');
}

?>