<?php
include"fpdf.php";
include"fpdf_custom.php";

include "../koneksidb.php";
    //if($_SESSION['level']=='Peserta'){
    $ta = $_SESSION['tahun_ajaran'];
    $iddu = $_POST['id_du'];
    $s1 = $_POST['surat1'];
    $s2 = $_POST['surat2'];
    $s3 = $_POST['surat3'];
    $yth = strtoupper($_POST['yth']);

    $data = mysql_fetch_array(mysql_query("SELECT * FROM hb_du_umum INNER JOIN hb_du_permintaan ON hb_du_umum.id_du = hb_du_permintaan.id_du WHERE tahun_ajaran='$ta' AND hb_du_umum.id_du=$iddu"));

switch (date("m")) {
    case "1" : $bulan="Januari";break;
    case "2" : $bulan="Februari";break;
    case "3" : $bulan="Maret";break;
    case "4" : $bulan="April";break;
    case "5" : $bulan="Mei";break;
    case "6" : $bulan="Juni";break;
    case "7" : $bulan="Juli";break;
    case "8" : $bulan="Agustus";break;
    case "9" : $bulan="September";break;
    case "10" : $bulan="Oktober";break;
    case "11" : $bulan="November";break;
    case "12" : $bulan="Desember";break;
}

$pdf = new FPDF_CUSTOM('P','mm','A4');

$pdf->AddPage();
$pdf->SetMargins(20,10,10);

$pdf->Image("../images/logo_kotacimahi.jpg", 20, 10, 20, 20);
$pdf->Image("../images/logo_smkn1cimahi.jpg", 170, 10, 20, 20);

$pdf->SetFont('Times','','12');
$pdf->Cell(0,5,"PEMERINTAH KOTA CIMAHI",0,1,'C');
$pdf->Cell(0,5,"DINAS PENDIDIKAN PEMUDA DAN OLAHRAGA",0,1,'C');
$pdf->SetFont('Times','','12');
//$pdf->Cell(0,5,"SEKOLAH MENENGAH KEJURUAN NEGERI 1 CIMAHI",0,1,'C');
$pdf->SetFont('Times','','8');
$pdf->Cell(0,4,"Bidang Studi Keahlian : 1. Teknologi & Rekayasa; 2. Teknologi Informasi & Komunikasi",0,1,'C');
$pdf->Cell(0,4,"Jl. Mahar Martanegara No.48 Telp/Fax. (022) 6629683 Kota Cimahi 40533",0,1,'C');
$pdf->Cell(0,4,"E-mail :smkn1cmi@bdg.centrin.net.id - hubin_smkn1cmi@ymail.com ",0,1,'C');

$pdf->SetLineWidth(1);
$pdf->Line(20,34,190,34);

$pdf->SetFont('Times','','12');
//$pdf->SetWidths(array(20,100));
//$pdf->SetAligns(array('L','L'));
$pdf->Cell(0,6,'',0,1);

$pdf->Cell(20,5,"Nomor",0,0,'L');
$pdf->Cell(3,5,":",0,0,'L');
$pdf->Cell(165,5,"422/$s1/SMKN.I-HUB/$s2/$s3",0,1,'L');
$pdf->Cell(20,5,"Lamp",'',0,'L');
$pdf->Cell(3,5,":",0,0,'L');
$pdf->Cell(170,5,"-",'',1,'L');

$pdf->Cell(20,5,"Perihal",'',0,'L');
$pdf->Cell(3,5,":",0,0,'L');
$pdf->SetFont('Times','BI','12');
$pdf->Cell(170,5,"Pengantar Prakerin",'',1,'L');
$pdf->Cell(20,5,"",'',0,'L');
$pdf->Cell(3,5,"",0,0,'L');
$pdf->Cell(170,5,"(Praktik Kerja Industri)",'',1,'L');

$pdf->Cell(0,10,'',0,1);

$pdf->SetFont('Times','B','12');
$pdf->Cell(20,5,"Yth",'',0,'L');
$pdf->Cell(3,5,":",0,0,'L');
$data['nama_du'] = strtoupper($data['nama_du']);
$pdf->Cell(170,5,"$yth $data[nama_du]",'',1,'L');
$pdf->SetFont('Times','','12');
$pdf->Cell(20,5,"",'',0,'L');
$pdf->Cell(3,5,"",0,0,'L');
$data['alamat'] = strtoupper($data['alamat']);
$pdf->Cell(170,5,"$data[alamat]",'',1,'L');
$pdf->Cell(0,10,'',0,1);
$pdf->SetFont('Times','BU','12');
$pdf->Cell(20,5,"",'',0,'L');
$pdf->Cell(3,5,"",0,0,'L');

$dk = mysql_fetch_array(mysql_query("SELECT nama FROM kabupaten WHERE id_kab='$data[id_kab]'"));
$pdf->Cell(170,5,"$dk[nama]",'',1,'L');
$pdf->Cell(0,10,'',0,1);

$pdf->SetFont('Times','','12');
$pdf->Cell(20,5,"",'',0,'L');
$pdf->Cell(3,5,"",0,0,'L');
$dorang = mysql_fetch_array(mysql_query("SELECT SUM(jumlah_penerimaan) AS jp FROM hb_du_jumlah_permintaan_du WHERE id_du='$iddu' AND tahun_ajaran='$ta' GROUP BY id_du"));

$date1 = date_create($data['mulai_pelaksanaan']);
$mulai = date_format($date1,'d F Y');
$date2 = date_create($data['berakhir_pelaksanaan']);
$akhir = date_format($date2,'d F Y');
$pdf->MultiCell(140,5,"Bersama ini kami hadapkan $dorang[jp] orang siswa SMKN 1 Cimahi untuk mengikuti Prakerin pada perusahaan yang Bapak/Ibu pimpin mulai $mulai s.d $akhir, yaitu :",0,'L');

$pdf->Cell(0,10,"",'',1,'L');
$pdf->Cell(25,5,"",'',0,'L');

$pdf->SetLineWidth(0.4);

$pdf->SetFont('Times','B','12');
$pdf->Cell(8,7,"NO",1,0,'C');
$pdf->Cell(23,7,"NIS",1,0,'C');
$pdf->Cell(65,7,"NAMA SISWA",1,0,'C');
$pdf->Cell(45,7,"PAKET KEAHLIAN",1,1,'C');

$pdf->SetFont('Times','','11');

$dsis = mysql_query("SELECT * FROM hb_prakerin INNER JOIN siswa ON siswa.nis = hb_prakerin.nis INNER JOIN jurusan ON jurusan.id_jurusan = siswa.id_jurusan WHERE id_du='$iddu' AND hb_prakerin.tahun_ajaran='$ta' ORDER BY siswa.id_jurusan") or die(mysql_error());
$no=1;
while($dd=mysql_fetch_array($dsis)){

$pdf->Cell(25,7,"",'',0,'L');
$pdf->Cell(8,7,"$no","LRB",0,'C');
$pdf->Cell(23,7,"$dd[nis]","LRB",0,'L');
$pdf->Cell(65,7,"$dd[nama_siswa]","LRB",0,'L');
$pdf->Cell(45,7,"$dd[nama_jurusan]","LRB",0,'C');
$pdf->Ln();
$no++;
}
$pdf->Ln();
$pdf->Cell(23,5,"",'',0,'L');
$pdf->MultiCell(140,5,"Pada akhir Prakerin siswa diwajibkan membuat laporan yang disetujui oleh perusahaan yang Bapak pimpin.",0,'L');
$pdf->Ln();
$pdf->Cell(23,5,"",'',0,'L');
$pdf->MultiCell(140,5,"Demikian  atas perhatian dan kerjasamanya kami ucapkan terima kasih.  ",0,'L');

$pdf->Ln();$pdf->Ln();
$pdf->Cell(290,5,'Cimahi, '.date("d-m-Y"),'',0,'C');

        $pdf->Ln();

        $pdf->Cell(290,5,'KEPALA SMKN 1 CIMAHI','',0,'C');

        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Cell(290,5,'Drs. H. E R M I Z U L, M.Pd','',0,'C');
        $pdf->Ln();
        $pdf->Cell(290,5,'NIP. 195701011982031024','',0,'C');
$pdf->Output('FORMULIR REGISTRASI PESERTA DIDIK BARU.pdf','I');
    //}else{

    //    header('location:../index');

    //}

?>