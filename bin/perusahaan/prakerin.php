<?php

include "../koneksidb.php";

if($_SESSION['level']=='perusahaan'){
        $title = "Permohonan Perizinan Prakerin";
        $active = "";
        $active3 = "active";

		include "leftside.php";


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


        $f = mysql_query("SELECT * FROM hb_du_umum WHERE username='$_SESSION[username]'");
        $dl=mysql_fetch_array($f);


?>
    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">

                <section class="panel">
                    <?php

                    $ada  = mysql_fetch_row(mysql_query("SELECT * FROM hb_du_jumlah_permintaan_du WHERE id_du='$_SESSION[id_du]'"));

                    if ($ada > 0) {

                            // Ini Informasi Kalo Perusahaan Udah Input 

                            $x = mysql_fetch_array(mysql_query("SELECT * FROM hb_du_permintaan WHERE id_du='$_SESSION[id_du]'"));

                            if ($x["status_permintaan"] == "Verifikasi Ditolak" ) {

                                // Ini Yang Ditolak

                                $di  = mysql_fetch_array(mysql_query("SELECT * FROM hb_du_permintaan WHERE id_du='$_SESSION[id_du]'"));?>

                                <header class="panel-heading"> <big> Permintaan Siswa Untuk Prakerin </big>

                               </header>
                                <form class="form-horizontal form-label-left" method="POST" action="prosesperusahaan.php?a=permintaan_prakerin" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Status :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            Mohon maaf, permintaan siswa untuk prakerin anda ditolak.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Dikarenakan :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[alasan_menolak]";?>
                                            <br><br><br><br><br>
                                        </div>
                                    </div>
                            <?php
                            }
                            else{

                                // Ini Yang Diterima 

                                $di  = mysql_fetch_array(mysql_query("SELECT * FROM hb_du_permintaan WHERE id_du='$_SESSION[id_du]'"));?>
                                <form method="POST" action="prosesperusahaan.php?a=hapus_permintaan" enctype="multipart/form-data">
                                <header class="panel-heading"> <big> Permintaan Siswa Untuk Prakerin </big>
                                  <span class="pull-right">
                                    <small>Status : <?php echo "$di[status_permintaan]";?></small> &nbsp; &nbsp; &nbsp;
                                    <?php 
                                        if ($di["status_permintaan"] != "Terverifikasi") {
                                           echo " <button  type='submit' name='HAPUSPERMINTAAN' value='HAPUSPERMINTAAN' class='pull-right btn btn-danger btn-xs'> HAPUS / EDIT PERMINTAAN </button>";
                                        }
                                    
                                    ?>
                                    </form>
                                 </span>
                               </header>
                                <form class="form-horizontal form-label-left" method="POST" action="prosesperusahaan.php?a=permintaan_prakerin" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <br><br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Jurusan : </label>
                                        <div class="col-lg-6 flat-green">
                                            <table style="margin-top: 7px">
                                                <?php

                                                $query  = mysql_query("SELECT * FROM hb_du_jumlah_permintaan_du WHERE id_du='$_SESSION[id_du]' ");

                                                if ($di["status_permintaan"] == "Terverifikasi") {
                                                    $query  = mysql_query("SELECT * FROM hb_du_penerima WHERE id_du='$_SESSION[id_du]' ");
                                                }

                                                while ($d = mysql_fetch_array($query)) {
                                                    $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE id_jurusan='$d[id_jurusan]'"));
                                                    echo " <tr>
                                                    <td> $j[nama_jurusan] </td>
                                                    <td> &nbsp;&nbsp; - &nbsp;&nbsp; </td>
                                                    <td> $d[jumlah_penerimaan] orang </td>
                                                    <td>  &nbsp;&nbsp; ($d[ket_skill])</td>
                                                    </tr> ";
                                                }

                                                ?>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Pelaksanaan Prakerin :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php 
                                                $mulai = tanggal($di["mulai_pelaksanaan"]);
                                                $berakhir = tanggal($di["berakhir_pelaksanaan"]);
                                                echo " $mulai - $berakhir";
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Nama Penanggung Jawab :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[nama_penanggung_jawab]";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Kontak Penanggung Jawab :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[contact_person]";?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Recruitment Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[seleksi_du]";?>
                                        </div>
                                    </div>
                                    <?php if($di['seleksi_du']=='Ya'){
                                        ?>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tempat Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[seleksi_tempat]";?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Seleksi :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php echo "$di[seleksi_tanggal]";?>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    }
                                    ?>
                                    <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12"> Fasilitas :</label>
                                        <div class=" flat-green">
                                            <div class="col-lg-1  flat-green">
                                                <input name="uangsaku" value="Ya" type="checkbox"  <?php if( $di["uang_saku"]=="Ya"){echo "checked";} ?> > </div>
                                                <label style="margin-left: -45px;"> Uang Saku</label>
                                            <!-- <select name='uangsaku2'>
                                                <option value='100.000-200.000' >100.000-200.000</option>
                                                <option value='200.000-300.000' >200.000-300.000</option>
                                            </select>-->
                                        </div>
                                        <div class=" col-lg-offset-4 flat-green">
                                            <div class="col-lg-1">
                                                <input name="asrama" value="Ya" type="checkbox"  <?php if( $di["asrama"]=="Ya"){echo "checked";} ?> > </div>
                                            <label style="margin-left: -28px;"> &nbsp; Asrama/Mess</label>
                                        </div>
                                        <div class=" col-lg-offset-4 flat-green">
                                            <div class="col-lg-1">
                                                <input name="uangmakan" value="Ya" type="checkbox"  <?php if( $di["uang_makan"]=="Ya"){echo "checked";} ?>> </div>
                                            <label style="margin-left: -28px;"> &nbsp; Uang Makan</label>
                                            <!--<select name='uangmakan2'>
                                                <option value='100.000-200.000'>100.000-200.000</option>
                                                <option value='200.000-300.000'>200.000-300.000</option>
                                            </select>-->
                                        </div>
                                        <div class=" col-lg-offset-4 flat-green">
                                            <div class="col-lg-1">
                                                <input name="uangtransport" value="Ya" type="checkbox" <?php if( $di["uang_transport"]=="Ya"){echo "checked";} ?>> </div>
                                                <label style="margin-left: -28px;"> &nbsp; Uang Transport</label>
                                                <!--<select name='uangtransport2'>
                                                    <option value='100.000-200.000'>100.000-200.000</option>
                                                    <option value='200.000-300.000' >200.000-300.000</option>
                                                </select> -->
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <br>
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Fasilitas Lain :</label>
                                        <div style="margin-top:7px" class="col-lg-6 flat-green">
                                            <?php if($di["fasilitas_lain"]==""){echo " - ";} else{ echo "$di[fasilitas_lain]";} ?>
                                            <br><br><br>
                                        </div>
                                    </div>
                    <?php
                            }
                    }
                    else{
                            // Form Untuk Menambahkan Prakerin

                    ?>
                    <header class="panel-heading"> <big>Permintaan Siswa Untuk Prakerin </big> <span class="pull-right">

                     </span> </header>
                    <form class="form-horizontal form-label-left" method="POST" action="prosesperusahaan.php?a=permintaan_prakerin" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Permintaan Jurusan : </label>
                            <div class="input_fields_wrap col-lg-1" >
                                <button class="btn btn-danger add_field_button"><i class='fa fa-plus-square'></i></button>
                            </div>

                            <div style="margin-left: -50px;"  class="col-lg-4">
                                <?php
                                $name = "";
                                 echo "<select class='form-control m-bot15' name='jurusan[]' required>
                                          <option value=''> * Pilih Jurusan * </option>";
                                            $jurusan = mysql_query("SELECT * FROM jurusan");
                                            while($j = mysql_fetch_array($jurusan)){
                                 echo " <option value='$j[id_jurusan]'> $j[nama_jurusan] </option>";
                                            }
                                         echo "
                                      </select>";
                                ?>

                            </div>
                            <div style="margin-left: -25px;width: 11.666667%;"  class="col-lg-2" >
                                <input type="text" class="form-control" name="jumlah[]" placeholder="Jumlah" required>
                            </div>
                            <div class='col-md-5 col-md-offset-3' style="width: 47.666667%;">
                                <div class='col-md-12' style='padding:0 10px 0 0'>
                                    <input type="text" name="skill[]" placeholder="Spesifikasi Keterampilan/Skill " class="form-control" required>
                                </div>
                                <div class='col-md-12' style='padding:0'>
                                    <small style='color: #D9534F'> Contoh : Web, Microcontroller, Video Editing, C++, Jaringan </small>
                                </div>
                            </div>
                            <div class="input_fields col-md-6 col-md-offset-3">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <br>
                            <label class="control-label col-md-3">Tanggal Pelaksanaan Prakerin : </label>
                            <div class="col-md-6">
                                <div class="input-group input-large custom-date-range" data-date="2016/10/10" data-date-format="yyyy/mm/dd">
                                    <input type="text" class="form-control dpd1" data-date-format="yyyy/mm/dd" name="mulai" placeholder="Mulai Pelaksanaan Prakerin" required>
                                    <span class="input-group-addon"> - </span>
                                    <input type="text" class="form-control dpd2" data-date-format="yyyy/mm/dd" name="berakhir"  placeholder="Berakhir Pelaksanaan Prakerin" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <br><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Penanggung Jawab :</label>
                            <div class="col-lg-6 flat-green">
                                <input type="text" class="form-control" name="nama_pj" placeholder="Nama Penanggung Jawab" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <br><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kontak Penanggung Jawab :</label>
                            <div class="col-lg-6 flat-green">
                                <input type="text" class="form-control" name="contact" placeholder="Kontak Penanggung Jawab" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <br><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Recruitment melalui :</label>
                            <div class="col-lg-6 flat-green">
                                <?php

                                                             echo "<select class='form-control m-bot15' name='seleksi' id='sel'>
                                                                      <option value='Tidak'> Tanpa Seleksi </option>
                                                                      <option value='Ya'> Seleksi </option>
                                                                  </select>";
                                                            ?>
                            </div>
                        </div>
                        <div id='selek' style='display: none'>
                        <div class="form-group">
                            <br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Seleksi :</label>
                            <div class="col-lg-6 flat-green">
                                <input type="text" class="form-control" name="seleksi_tempat" placeholder="Tempat Seleksi">
                            </div>
                        </div>

                        <div class="form-group">
                            <br><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Seleksi :</label>
                            <div class="col-lg-6 flat-green">
                                <input type="text" class="form-control dpd1"  data-date-format='yyyy/mm/dd' name="seleksi_tanggal" placeholder="Tanggal Seleksi">
                            <br>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <br><br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ketentuan :</label>
                            <div class="col-lg-6 flat-green">
                                <span class='btn btn-info'>Baca Ketentuan</span>
                            </div>
                        </div> -->
                        </div>
                        <div class="form-group">
                        <br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"> Fasilitas :</label>
                            <div class=" flat-green">
                                <div class="col-lg-1  flat-green">
                                    <input name="uangsaku" value="Ya" type="checkbox" > </div>
                                <label style="margin-left: -45px;"> Uang Saku</label>
                                <!-- <select name='uangsaku2'>
                                    <option value='100.000-200.000' >100.000-200.000</option>
                                    <option value='200.000-300.000' >200.000-300.000</option>
                                </select>-->
                            </div>
                            <div class=" col-lg-offset-3 flat-green">
                                <div class="col-lg-1">
                                    <input name="asrama" value="Ya" type="checkbox"  > </div>
                                <label style="margin-left: -28px;"> &nbsp; Asrama/Mess</label>
                            </div>
                            <div class=" col-lg-offset-3 flat-green">
                                <div class="col-lg-1">
                                    <input name="uangmakan" value="Ya" type="checkbox"> </div>
                                <label style="margin-left: -28px;"> &nbsp; Uang Makan</label>
                                <!--<select name='uangmakan2'>
                                    <option value='100.000-200.000'>100.000-200.000</option>
                                    <option value='200.000-300.000'>200.000-300.000</option>
                                </select>-->
                            </div>
                            <div class=" col-lg-offset-3 flat-green">
                                <div class="col-lg-1">
                                    <input name="uangtransport" value="Ya" type="checkbox"> </div>
                                    <label style="margin-left: -28px;"> &nbsp; Uang Transport</label>
                                    <!--<select name='uangtransport2'>
                                        <option value='100.000-200.000'>100.000-200.000</option>
                                        <option value='200.000-300.000' >200.000-300.000</option>
                                    </select> -->
                            </div>
                        </div>
                         <div class="form-group">
                            <br>
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fasilitas Lain :</label>
                            <div class="col-lg-6 flat-green">
                                <input type="text" class="form-control" name="fasilitas_lain" placeholder="Fasilitas Lain (Opsional)">
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="col-lg-offset-8 col-lg-10">
                            <br><br>
                                <button value='Tambahkan' name='Tambahkan' type='submit' name='submit' class="btn btn-primary"> Submit </button>
                            <br><br><br>
                        </div>
                    </div>
            <?php } ?>
                </section>
            </div>
        </div>
    </div>
    <!--body wrapper end-->
    <?php		include "footer.php";

}else{
	header('location:../login.php');
}

?>

