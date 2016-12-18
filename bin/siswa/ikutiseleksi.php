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
                        <!-- Modal -->
                         <?php
                             while ($t = mysql_fetch_array($data2)) {

                                ?>
                                <div style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="<?php echo "atur$t[id_du]"; ?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambah Keterangan</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="<?php echo "proses_admin.php?a=ketseleksi&id=$t[id_du]"; ?>" enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Tempat Seleksi</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" name="tempat" placeholder="Tempat Seleksi">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Tanggal Seleksi</label>
                                                        <div class="col-lg-8">
                                                            <input type="date" class="form-control" name="tanggal" placeholder="Alamat">
                                                        </div>
                                                    </div>
                                            </div>
                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                <input type='submit' value='Tambahkan' name='Tambahkan'class='btn btn-success'>  </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
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
                        <th>Aksi</th>
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

                                        <td>";
                                                $queryada = mysql_query("SELECT * FROM hb_du_prakerin_tes WHERE nis='$_SESSION[username]'");
                                                $jml = mysql_fetch_row($queryada); 
                                                if ($jml > 0) {
                                                    echo "
                                                    <a href='#hapusikuti$d[id_du]' data-toggle='modal'>
                                                        <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-trash-o'></i> Hapus Pendaftaran </button>
                                                    </a>
                                                    ";
                                                }else{
                                                     echo "
                                                    <a href='#ikuti$d[id_du]' data-toggle='modal'>
                                                        <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-edit'></i> Ikuti Seleksi </button>
                                                    </a>
                                                    ";
                                                }

                                                echo "
                                            
                                            <a href='detail_pendaftaran_tes.php?id=$d[id_du]' data-toggle='modal'>
                                                <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-bars'></i> Lihat Detail </button>
                                            </a>
                                        </td>

                                        <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='ikuti$d[id_du]' class='modal fade'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                        <h5>Konfirmasi</h5>
                                                    </div>
                                                    <div class='modal-body'>
                                                        Ikuti seleksi di DU/DI <b> $d[nama_du]</b> ini?
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                        <a href='proses_siswa.php?a=ikutiseleksi&id=$d[id_du]'>
                                                            <input type='submit' value='Ikuti' name='Ikuti'class='btn btn-success'>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='hapusikuti$d[id_du]' class='modal fade'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                        <h5>Konfirmasi</h5>
                                                    </div>
                                                    <div class='modal-body'>
                                                        Hapus Pendaftaran di DU/DI <b> $d[nama_du]</b> ini?
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                                        <a href='proses_siswa.php?a=hapusikutiseleksi&id=$d[id_du]'>
                                                            <input type='submit' value='Hapus' name='Ikuti'class='btn btn-danger'>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
