<?php

include "../koneksidb.php";

if($_SESSION['level']=='guru'){ 
    if ($_SESSION['tahun_ajaran']!='') {
        $title="Daftar Siswa yang Dimonitoring";
        $active ="";
        $active13 = "active";
        $navactive7 ="nav-active";

        $data = mysql_query( "SELECT * FROM hb_du_permintaan INNER JOIN hb_du_jumlah_permintaan_du ON hb_du_permintaan.id_du = hb_du_jumlah_permintaan_du.id_du INNER JOIN hb_du_umum ON hb_du_umum.id_du = hb_du_permintaan.id_du INNER JOIN hb_monitoring ON hb_monitoring.id_du = hb_du_permintaan.id_du WHERE nip_guru = '$_SESSION[username]' AND hb_du_permintaan.tahun_ajaran='$_SESSION[tahun_ajaran]'")or die(mysql_error());
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
                        <big>Daftar Siswa yang Dimonitoring</big>
                         
                    </header>
                   
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama DU/DI</th>
                        <th>Alamat dan Email</th>
                        <th>Penanggung Jawab</th>
                        <th>Info Permintaan</th>
                        
                        <th>Tanggal</th>
                        <th>Ubah Tanggal</th>
                    </tr>
                    </thead><tbody>
                        <?php
                            $no =0;
                            while ($d = mysql_fetch_array($data)) {
                                $no = $no+1;
                                $kel = mysql_fetch_array(mysql_query("SELECT nama FROM kelurahan WHERE id_kel='$d[id_kel]'"));
                                $kec = mysql_fetch_array(mysql_query("SELECT nama FROM kecamatan WHERE id_kec='$d[id_kec]'"));
                                $kab = mysql_fetch_array(mysql_query("SELECT nama FROM kabupaten WHERE id_kab='$d[id_kab]'"));
                                $prov = mysql_fetch_array(mysql_query("SELECT nama FROM provinsi WHERE id_prov='$d[id_prov]'"));
                                echo "
                                    <tr class='gradeA'>
                                        <td> $no </td>
                                        <td> $d[nama_du] </td>
                                        <td> $d[alamat]
                                        </td>
                                        <td> $d[nama_penanggung_jawab] <br> $d[contact_person]</td>
                                        <td>";

                                                $query  = mysql_query("SELECT * FROM hb_du_jumlah_permintaan_du WHERE id_du='$d[id_du]' ");
                                                while ($x = mysql_fetch_array($query)) {
                                                    $j = mysql_fetch_array(mysql_query("SELECT * FROM jurusan WHERE id_jurusan='$x[id_jurusan]'"));
                                                    echo " $j[nama_jurusan] - $x[jumlah_penerimaan] orang <br>";
                                                }

                                            echo "
                                            </div>
                                        </td>
                                        <td class='center'>
                                            ";
                                            if($d['tgl_monitoring']=='0000-00-00'){
                                                echo "<h5>Belum Ditentukan</h5>";
                                            }else{
                                                echo "$d[tgl_monitoring]";
                                            }
                                            echo "
                                        </td>
                                        <td class='center'>
                                            
                                            <a href='#' data-toggle='modal' data-target='#tgl$d[id_du]' data-du='$d[id_du]'>
                                                            <button class='btn btn-sm btn-primary' type='button'><i class='fa fa-edit'></i> Ubah Tanggal </button>
                                                        </a>
                                        </td>
                                    </tr>
                                    ";?>

                                            <div class='modal fade' id='tgl<?php echo $d['id_du']?>' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    <h4 class='modal-title' id='myModalLabel'>Tanggal Monitoring</h4> </div>
                <div class='modal-body'>
                    <form class='form-horizontal form-label-left' method='POST' action='proses_guru.php?a=tanggalmonitoring' enctype='multipart/form-data'>
                        
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Tanggal : <span class='required'></span> </label>
                        <div class="col-lg-8"><?php
                                    $name = "";
                                    echo "<input type='text' id='id_du' name='iddu' value='$d[id_du]'>";
                                    echo "<input type='text' class='form-control dpd1' data-date-format='yyyy/mm/dd' name='tgl_monitoring' placeholder='Tanggal Monitoring' required";?>
                                </div>
                </div>
                <div class='modal-footer'>
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
    </div><?php
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