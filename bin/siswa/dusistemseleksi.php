<?php

include "../koneksidb.php";

if($_SESSION['level']=='siswa'){
        $title="DU Sistem Seleksi";
        $active ="";
        $active4 = "active";
        $navactive2 ="nav-active";

        $data = mysql_query("SELECT * FROM hb_du_permintaan, hb_du_umum, hb_du_penerima WHERE seleksi_du ='Ya' AND hb_du_permintaan.id_du=hb_du_umum.id_du AND status_penerimaan!='Menolak' AND status_permintaan!='Belum Terverifikasi' AND status_permintaan!='Verifikasi Ditolak' AND hb_du_penerima.id_du = hb_du_permintaan.id_du AND hb_du_penerima.id_jurusan='$_SESSION[jurusan]' AND tutup_tes!='Ya'");
        $data2 = mysql_query("SELECT * FROM hb_du_permintaan, hb_du_umum, hb_du_penerima WHERE seleksi_du ='Ya' AND hb_du_permintaan.id_du=hb_du_umum.id_du AND status_penerimaan!='Menolak' AND status_permintaan!='Belum Terverifikasi' AND status_permintaan!='Verifikasi Ditolak' AND hb_du_penerima.id_du = hb_du_permintaan.id_du AND hb_du_penerima.id_jurusan='$_SESSION[jurusan]' AND tutup_tes!='Ya'");

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
                        <label><big>DU Yang Menggunakan Sistem Seleksi</big></label>
                        <span class="pull-right">
                        <!-- modal -->
                     </span>
                    </header>

                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dunia Usaha</th>
                        <th>Email</th>
                        <th>Tempat Seleksi</th>
                        <th>Tanggal Seleksi</th>

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
                                        <td> $d[nama_du] </td>
                                        <td> $d[email_du]</td>
                                        <td>";
                                        if ($d["seleksi_tempat"] == "") {
                                           echo "Belum Ditentukan";
                                        }else{
                                            echo $d["seleksi_tempat"];
                                        }

                                 echo " </td>
                                        <td>";
                                        if ($d["seleksi_tanggal"] == 0000-00-00) {
                                           echo "Belum Ditentukan";
                                        }else{
                                            $tanggal = tanggal($d["seleksi_tanggal"]);
                                            echo "$tanggal";
                                        }

                                 echo " </td>
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
    header('location:../login.php');
}

?>
