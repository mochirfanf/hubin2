<?php

include "../koneksidb.php";

if($_SESSION['level']=='siswa'){
        $title="DU Sistem Seleksi";
        $active ="";
        $active4 = "active";
        $navactive2 ="nav-active";

        $id_du = $_GET["id"];

        if (empty($id_du)) {
            header("location:dusistemseleksi.php");
        }

        $data = mysql_query( "SELECT * FROM hb_du_permintaan, hb_du_umum, siswa, hb_du_prakerin_tes, jurusan WHERE seleksi_du ='Ya' AND hb_du_permintaan.id_du=hb_du_umum.id_du AND siswa.nis = hb_du_prakerin_tes.nis AND hb_du_umum.id_du = hb_du_prakerin_tes.id_du AND hb_du_prakerin_tes.id_du='$id_du' AND jurusan.id_jurusan = siswa.id_jurusan");

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
                            $f = mysql_fetch_array(mysql_query("SELECT nama_du FROM hb_du_umum WHERE id_du='$id_du'"))
                        ?>
                        <label><big>Detail Pendaftaran di <?php echo "$f[nama_du]" ;?></big></label>
                    </header>

                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pendaftar</th>
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
        <!--body wrapper end-->

<?php       include "footer.php";
   
}else{
    header('location:../login.php');
}

?>
