<?php

include "../koneksidb.php";

if($_SESSION['level']=='admin'){
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Yang Menerima Prakerin";
        $active = "";
        $active13 = "active";
        $navactive6 ="nav-active";


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


        function judultabel(){
            echo "  <th>No</th>
                    <th>Nama Dunia Usaha</th>
                    <th> Jumlah Penerimaan</th>
                    <th>Sisa Kuota Penerimaan</th>
                    <th>Sistem Seleksi</th>
                    <th>Aksi</th>";
        }
        function isinya($query){
                $no =0;
                while ($d = mysql_fetch_array($query)) {
                    $mulai = tanggal($d["mulai_pelaksanaan"]);
                    $berakhir = tanggal($d["berakhir_pelaksanaan"]);
                    $no = $no+1;
                    echo "
                    <tr class='gradeA'>
                        <td> $no </td>
                        <td> $d[nama_du] </td>
                        <td> $d[jumlah_penerimaan] orang</td>
                        <td> ";
                            if ($d["sisa_kuota_penerimaan"] == 0) {
                                echo "Telah Terpenuhi";
                            }else{
                                echo "$d[sisa_kuota_penerimaan] orang";
                            }
                  echo "</td>
                        <td> $d[seleksi_du]</td>
                        <td class='center'>
                            <a href='#jedit$d[id_du]-$d[id_jurusan]' data-toggle='modal'>
                                <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-trash-o'></i> Edit </button>
                            </a>
                            <a href='#jhapus$d[id_du]-$d[id_jurusan]' data-toggle='modal'>
                                <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-trash-o'></i> Hapus </button>
                            </a>
                        </td>
                            <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='jhapus$d[id_du]-$d[id_jurusan]' class='modal fade'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                            <h5>Konfirmasi</h5>
                                        </div>
                                        <div class='modal-body'>
                                            Hapus Penerimaan '$d[nama_du]' untuk jurusan ";
                                            $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE id_jurusan = $d[id_jurusan]"));
                                            echo "$j[singkatan]? <br>

                                            Jika Anda Menghapusnya, Siswa yang telah mendaftar di DU ini akan terhapus!
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
                                            <a href='proses_admin.php?a=hapuspenerimajurusan&id=$d[id_du]&id_jurusan=$d[id_jurusan]'>
                                                <input type='submit' value='Hapus' name='Ganti'class='btn btn-success'>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </tr>";
                 }
        }

        function isinyajur($query4){

                             while ($t = mysql_fetch_array($query4)) {
                                ?>
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="<?php echo "jedit$t[id_du]-$t[id_jurusan]";
                                    $e = mysql_fetch_array(mysql_query("SELECT * FROM hb_du_penerima WHERE id_du = '$t[id_du]' AND id_jurusan = $t[id_jurusan]"))?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Jumlah Penerimaan</big></h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="proses_admin.php?a=editjpenerima<?php echo "&id=$t[id_du]&id_jurusan=$t[id_jurusan]";?>"  enctype='multipart/form-data' class="form-horizontal" role="form">

                                                    <div class="form-group">

                                                        <div class="col-lg-offset-2 col-lg-8">
                                                            <input type="text" class="form-control" name="jpen" value="<?php echo "$e[jumlah_penerimaan]"; ?>" placeholder="Nama Dunia Usaha">
                                                        </div>
                                                    </div>
                                            </div>
                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                <input type='submit' value='Perbaharui' name='Perbaharui'class='btn btn-success'>  </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }

        }

        include "leftside.php"; ?>

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                    <header class="panel-heading">
                        <label><big>DU/DI Penerima Prakerin Siswa</big></label>
                    </header>

                   <section class="panel">
                        <header class="panel-heading custom-tab turquoise-tab">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#home">
                                        <i class="fa fa-home"></i>
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#rpl">
                                        <i class="fa fa-location-arrow"></i>
                                        RPL
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#toi">
                                        <i class="fa fa-location-arrow"></i>
                                        TOI
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#km">
                                        <i class="fa fa-location-arrow"></i>
                                        KM
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#kp">
                                        <i class="fa fa-location-arrow"></i>
                                        KP
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tek">
                                        <i class="fa fa-location-arrow"></i>
                                        TEK
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tei">
                                        <i class="fa fa-location-arrow"></i>
                                        TEI
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tkj">
                                        <i class="fa fa-location-arrow"></i>
                                        TKJ
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tp4">
                                        <i class="fa fa-location-arrow"></i>
                                        TP4
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#tptu">
                                        <i class="fa fa-location-arrow"></i>
                                        TPTU
                                    </a>
                                </li>
                            </ul>
                        </header>
                        <!-- modal -->
                        
                        <?php
                             $data5 = mysql_query( "SELECT * FROM hb_du_umum, hb_du_permintaan WHERE status_penerimaan='Menerima' AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_permintaan.id_du");
                             while ($o = mysql_fetch_array($data5)) {
                                ?>
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="<?php echo "editprakerin$o[id_du]";
                                    $e = mysql_fetch_array(mysql_query("SELECT * FROM hb_du_umum WHERE id_du = '$o[id_du]'"))?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambah Baru</big></h5>
                                            </div>
                                            <div class="modal-body">

                                                    <form method="POST" action="<?php echo "proses_admin.php?a=editprakerin&id=$o[id_du]"; ?>" enctype='multipart/form-data' class="form-horizontal" role="form">

                                                    <div class="form-group">
                                                         <label class="control-label col-md-4 col-sm-4 col-xs-12">Pelaksanaan Prakerin (Mulai - Berakhir ):</label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group input-large custom-date-range" data-date="2016/10/10" data-date-format="yyyy/mm/dd">
                                                                <input type="text" class="form-control dpd1" data-date-format="yyyy/mm/dd" name="mulai" placeholder="Mulai Pelaksanaan" value="<?php echo "$o[mulai_pelaksanaan]"; ?>" required>
                                                                <span class="input-group-addon"> - </span>
                                                                <input type="text" class="form-control dpd2" data-date-format="yyyy/mm/dd" name="berakhir" value="<?php echo "$o[berakhir_pelaksanaan]"; ?>" placeholder="Berakhir Pelaksanaan " required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <br>
                                                        <label class="col-lg-4 col-sm-4 control-label">Penanggung Jawab :</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" value="<?php echo "$o[nama_penanggung_jawab]"; ?>" class="form-control" name="nama_pj" placeholder="Nama Penanggung Jawab">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <br>
                                                        <label class="col-lg-4 col-sm-4 control-label">Kontak Penanggung Jawab :</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" value="<?php echo "$o[contact_person]"; ?>" class="form-control" name="contact" placeholder="Contact Person">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                    <br>
                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Jenis Seleksi :</label>
                                                        <div class="col-lg-8 flat-green">
                                                            <?php
                                                                echo "<select class='form-control m-bot15' name='seleksi'>
                                                                            <option value='Ya' "; if($o["seleksi_du"]=="Ya"){echo "selected";} echo "> Ya </option>
                                                                            <option value='Tidak'"; if($o["seleksi_du"]=="Tidak"){echo "selected";} echo "> Tidak </option>
                                                                      </select>";
                                                            ?>
                                                        </div>
                                                    </div>
                                            </div>
                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                <input type='submit' value='Perbaharui' name='Perbaharui'class='btn btn-success'>  </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                        <!-- modal -->

                        <!-- modal -->
                        <?php
                             $data9 = mysql_query( "SELECT * FROM hb_du_umum, hb_du_permintaan WHERE status_penerimaan='Menerima' AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_permintaan.id_du");
                             while ($r = mysql_fetch_array($data9)) {
                                ?>
                                <div  style="text-transform:none" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="baru<?php echo "$r[id_du]";?>" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h5><big>Tambah Jurusan Penerima</big></h5>
                                            </div>
                                            <div class="modal-body">

                                                    <form method="POST" action="proses_admin.php?a=tambahpenerimajur&id=<?php echo "$r[id_du]";?>" enctype='multipart/form-data' class="form-horizontal" role="form">
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Jurusan :</label>
                                                        <div class="col-lg-8">
                                                            <?php
                                                            $name = "";
                                                            echo "<select required class='form-control m-bot15' name='jurusan'>
                                                                    <option value=''> * Pilih Jurusan * </option>";
                                                                        $jurusan = mysql_query("SELECT * FROM jurusan");
                                                                        while($j = mysql_fetch_array($jurusan)){
                                                             echo " <option value='$j[id_jurusan]' > $j[nama_jurusan] </option>";
                                                                        }
                                                            echo "</select>";?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-sm-4 control-label">Jumlah Penerimaan :</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah Penerimaan">
                                                        </div>
                                                    </div>
                                                    
                                            </div>
                                           <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                <input type='submit' value='Tambah' name='Tambah'class='btn btn-success'>  </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                        ?>

                        <!-- modal -->

                        <div class="panel-body">
                            <div class="tab-content">

                                <div id="home" class="tab-pane active">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dunia Usaha</th>
                                            <th>Pelaksanaan Prakerin</th>
                                            <th>Jenis Seleksi</th>
                                            <th>Penanggung Jawab</th>
                                            <th>Jurusan</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $query9 = mysql_query( "SELECT * FROM hb_du_umum, hb_du_permintaan WHERE status_penerimaan='Menerima' AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_permintaan.id_du");
                                            $no =0;
                                            while ($d = mysql_fetch_array($query9)) {
                                                $mulai = tanggal($d["mulai_pelaksanaan"]);
                                                $berakhir = tanggal($d["berakhir_pelaksanaan"]);
                                                $kel = mysql_fetch_array(mysql_query("SELECT nama FROM kelurahan WHERE id_kel='$d[id_kel]'"));
                                                $kec = mysql_fetch_array(mysql_query("SELECT nama FROM kecamatan WHERE id_kec='$d[id_kec]'"));
                                                $kab = mysql_fetch_array(mysql_query("SELECT nama FROM kabupaten WHERE id_kab='$d[id_kab]'"));
                                                $prov = mysql_fetch_array(mysql_query("SELECT nama FROM provinsi WHERE id_prov='$d[id_prov]'"));
                                                $no = $no+1;
                                                echo "
                                                <tr class='gradeA'>
                                                    <td> $no </td>
                                                    <td> $d[nama_du] </td>
                                                    <td> $mulai s/d $berakhir </td>
                                                    <td> $d[seleksi_du] </td>
                                                    <td> $d[nama_penanggung_jawab] <br> $d[contact_person]</td>
                                                    <td> ";
                                                        $juru = mysql_query("SELECT DISTINCT jurusan.singkatan FROM jurusan, hb_du_penerima WHERE jurusan.id_jurusan = hb_du_penerima.id_jurusan AND id_du = $d[id_du]");
                                                        $no2=0;
                                                        while ($jur=mysql_fetch_array($juru)) {
                                                            $no2++;
                                                           echo "$jur[singkatan]; ";
                                                        }

                                                        if ($no2 == 0 ) {
                                                            echo "<span class='label label-primary'>Tidak Ada Jurusan</span>";
                                                        }
                                            echo "  </td>
                                                    <td class='center'>
                                                        
                                                        <a href='#baru$d[id_du]' data-toggle='modal'>
                                                            <button class='btn btn-sm btn-info' type='button'><i class='fa fa-plus'></i> Tambah Penerima Jurusan </button>
                                                        </a> <br> <br>
                                                        <a href='#editprakerin$d[id_du]' data-toggle='modal'>
                                                            <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-pencil'></i> Edit Informasi Prakerin </button>
                                                        </a> <br> <br>
                                                        <a href='#tolak$d[id_du]' data-toggle='modal'>
                                                            <button class='btn btn-sm btn-danger' type='button'><i class='fa fa-trash-o'></i> Batalkan Verifikasi </button>
                                                        </a>
                                                    </td>
                                                        <div  style='text-transform:none' aria-hidden='true' aria-labelledby='myModalLabel' role='dialog' tabindex='-1' id='tolak$d[id_du]' class='modal fade'>
                                                            <div class='modal-dialog'>
                                                                <div class='modal-content'>
                                                                    <div class='modal-header'>
                                                                        <button aria-hidden='true' data-dismiss='modal' class='close' type='button'>×</button>
                                                                        <h5>Berikan Alasan! (Pesan akan disampaikan ke Perusahaan)</h5>
                                                                    </div>
                                                                    <div class='modal-body'>
                                                                        <div class='form-group'>
                                                                            <form method='POST' action='proses_admin.php?a=tolak_permintaan_perusahaan2&id=$d[id_du]'>
                                                                            <div class='col-lg-12'>
                                                                                <input type='text' class='form-control' name='alasan' placeholder='Berikan Alasan ....' required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                   <div class='modal-footer'>
                                                                        <button type='button' class='btn btn-info' data-dismiss='modal'>Kembali</button>
                                                                        <input type='submit' value='Batalkan Verifikasi dan Kirim Pesan' name='Ganti'class='btn btn-danger'>
                                                                    </div>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                </tr>";
                                             }
                                        ?>
                                        </tbody>
                                        </table>
                                        </div>

                                <label> <br>
                                    &nbsp; &nbsp; ** Hati - hati jika anda <i><b>Membatalkan Verifikasi ! </b></i><br><br>
                                </label>
                                    </div>
                                </div>

                                <div id="rpl" class="tab-pane ">
                                    <div class="panel-body">
                                        <br>

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = mysql_query( "SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du  AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 1 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                $query4 = mysql_query( "SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du AND permintaan_du = 'Ya'  AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 1 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="toi" class="tab-pane "> <!-- id= 7 -->
                                    <div class="panel-body">
                                        <br>

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = mysql_query("SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du  AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 7 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                $query4 = mysql_query("SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du  AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 7 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="km" class="tab-pane "> <!-- id= 2 -->
                                    <div class="panel-body">
                                        <br>

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = mysql_query("SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du  AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 2 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                $query4 = mysql_query("SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du  AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 2 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="kp" class="tab-pane "> <!-- id= 3 -->
                                    <div class="panel-body">
                                        <br>

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = mysql_query("SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du  AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 3 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                $query4 = mysql_query("SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du  AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 3 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="tek" class="tab-pane "> <!-- id= 5 -->
                                    <div class="panel-body">
                                        <br>

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = mysql_query( "SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du  AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 5 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                $query4 = mysql_query("SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du  AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 5 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="tei" class="tab-pane "> <!-- id= 4 -->
                                    <div class="panel-body">
                                        <br>

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = mysql_query("SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du AND permintaan_du = 'Ya'  AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 4 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                $query4 = mysql_query( "SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du  AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 4 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="tkj" class="tab-pane "> <!-- id= 6 -->
                                    <div class="panel-body">
                                        <br>

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = mysql_query( "SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du  AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 6 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                $query4 = mysql_query("SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du  AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 6 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="tp4" class="tab-pane "> <!-- id= 8 -->
                                    <div class="panel-body">
                                        <br>

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = mysql_query( "SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du  AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 8 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                $query4 = mysql_query( "SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du  AND permintaan_du = 'Ya' AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 8 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="tptu" class="tab-pane "> <!-- id= 9 -->
                                    <div class="panel-body">
                                        <br>

                                        <div class="adv-table">
                                            <!--<a href='' class='btn btn-warning'> Cetak </a> <br><br> -->
                                        <table  class="display table table-bordered table-striped" id="dynamic-table">
                                        <thead>
                                        <tr>
                                            <?php judultabel() ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                                $query = mysql_query( "SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du AND permintaan_du = 'Ya'  AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 9 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                $query4 = mysql_query("SELECT * from hb_du_umum, hb_du_permintaan,hb_du_penerima WHERE hb_du_umum.id_du = hb_du_permintaan.id_du AND permintaan_du = 'Ya'  AND hb_du_umum.id_du = hb_du_penerima.id_du AND hb_du_penerima.id_jurusan = 9 AND hb_du_permintaan.status_penerimaan='Menerima'");
                                                isinya($query);
                                                isinyajur($query4);
                                            ?>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


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
