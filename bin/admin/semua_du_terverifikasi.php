<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
	if ($_SESSION['tahun_ajaran']!='') {
        $title="Permohonan Perizinan Prakerin";
        $active = "";
        $active4 = "active";
        $navactive1 ="nav-active";


        $data2 = mysql_query("SELECT * FROM hb_du_umum,hb_du_permintaan WHERE hb_du_permintaan.tahun_ajaran = '$_SESSION[tahun_ajaran]' AND hb_du_umum.id_du = hb_du_permintaan.id_du AND status_permintaan!='Verifikasi Ditolak'");


		include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <big>Semua DU / DI yang telah diverifikasi</big>
                     </span>
                    </header>

                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama DU/DI</th>
                        <th>Alamat </th>
                        <th>Email</th>
                        <th>Keterangan Permintaan </th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no =0;
                            while( $d = mysql_fetch_array($data2)) {
                                $kel = mysql_fetch_array(mysql_query("SELECT nama FROM kelurahan WHERE id_kel='$d[id_kel]'"));
                                $kec = mysql_fetch_array(mysql_query("SELECT nama FROM kecamatan WHERE id_kec='$d[id_kec]'"));
                                $kab = mysql_fetch_array(mysql_query("SELECT nama FROM kabupaten WHERE id_kab='$d[id_kab]'"));
                                $prov = mysql_fetch_array(mysql_query("SELECT nama FROM provinsi WHERE id_prov='$d[id_prov]'"));
                                $no = $no+1;


                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d[nama_du] </td>
                                        <td> $d[alamat]
                                             <br> Kelurahan : $kel[nama]
                                             <br> Kecamatan : $kec[nama]
                                             <br> Kab/Kota : $kab[nama]
                                             <br> Provinsi : $prov[nama]
                                             <br> Kode Pos : $d[no_kodepos]
                                        </td>
                                        <td> $d[email_du]</td>
                                        <td> ";
                                            if ($d["permintaan_hubin"] == "Ya") {
                                               echo "Hubin";
                                            }
                                            if ($d["permintaan_kapprog"] == "Ya") {
                                               $j = mysql_fetch_array(mysql_query("SELECT singkatan FROM jurusan WHERE id_jurusan='$d[du_id_jurusan]'"));
                                               echo "Jurusan $j[singkatan]";
                                            }
                                            if ($d["permintaan_du"] == "Ya") {
                                               echo "Perusahaan";
                                            }

                                         echo "</td>
                                    </tr>
                                    ";
                            }
                        ?>
                    </tbody>
                    </table>
                    </div>

                                <label> <br>
                                    &nbsp; &nbsp; ** Data DU/DI Dari Perusahaan akan muncul ketika DU/DI (Perusahaan) meminta prakerin.<br><br>
                                </label>
                    </div>
                    </section>
                </div>
            </div>
        </div>
        <!--body wrapper end-->

<?php		include "footer.php";
	}else{
		header('location:tahun_ajaran.php');
	}
}else{
	header('location:../login.php');
}

?>
