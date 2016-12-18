<?php
include"fpdf.php";
include"fpdf_custom.php";

$pdf = new FPDF_CUSTOM('L','mm','A4');

$pdf->AddPage();
$pdf->setAutoPageBreak(false);

//$pdf->Image("images/logo.jpg", 10, 11, 31.5, 19);
$pdf->SetFont('Arial','B','11');
$pdf->Cell(0,5,"FORMULIR PEMUTAKHIRAN DATA PROGRAM KELUARGA HARAPAN",0,1,'C');

//$pdf->RoundedRect(190,16,70.6,12.5,2,'D');
//$pdf->RoundedRect(268,11,18,18,2,'D');
//$pdf->RoundedRect(10,32,278,28,2,'D');

$pdf->SetFont('Arial','','8');
        $pdf->Cell(35,3,' ',0,'L');
        $pdf->Cell(115,3,'1.	Apakah rumah tangga ini hadir dalam pertemuan awal?',0,0,'L');
        $pdf->Cell(35,3,'1. Ya      2. Tidak',0,0,'L');

        $pdf->Ln();
        $pdf->Cell(35,3,' ',0,'L');
        $pdf->Cell(115,3,'2.	Apakah alamat rumah tangga ini ditemukan?',0,0,'L');
        $pdf->Cell(35,3,'1. Ya      2. Tidak',0,0,'L');

        $pdf->Ln();
        $pdf->Cell(35,3,' ',0,'L');
        $pdf->Cell(115,3,'3.	Apakah rumah tangga ini pindah alamat keluar wilayah?',0,0,'L');
        $pdf->Cell(35,3,'1. Ya      2. Tidak',0,0,'L');
        
        $pdf->SetFont('Arial','','15');
        
        $pdf->Cell(1,3,' ',0,0,'L');
        $pdf->Cell(59,3,'33142508890002',0,0,'C');
        $pdf->SetFont('Arial','','8');

        $pdf->Ln();
        $pdf->Cell(35,3,' ',0,'L');
        $pdf->Cell(115,3,'4.	Apakah rumah tangga ini double dengan rumah tangga lain?',0,0,'L');
        $pdf->Cell(35,3,'1. Ya      2. Tidak',0,0,'L');

        $pdf->Ln();
        $pdf->Cell(35,3,' ',0,'L');
        $pdf->Cell(115,3,'5.	Apakah rumah tangga ini merupakan Keluarga Sangat  Miskin?',0,0,'L');
        $pdf->Cell(35,3,'1. Ya      2. Tidak',0,0,'L');
        
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(100,5,'',0,'L');
        $pdf->Rect(125,33,5,5,'D');
        $pdf->Rect(130,33,5,5,'D');
        $pdf->Cell(15,5,'No. ART',0,'L');
        $pdf->Cell(5,5,'0',0,'L');
        $pdf->Cell(30,5,'0',0,'L');

        
        $pdf->Rect(175,33,14,5,'D');
        $pdf->Cell(17,5,'Tahun',0,'L');
        $pdf->Cell(19,5,'2016',0,'L');

        $pdf->Cell(4,5,'',0,'L');
        $pdf->Cell(10,5,' ',0,'L');

        $pdf->Cell(20,5,'',0,'L');
        $pdf->Cell(11,5,'KPS',0,'L');
        $pdf->Rect(242,33.5,4,4,'D');
        
        
        $pdf->Cell(7,5,'',0,'L');
        $pdf->Cell(11,5,'PSKS',0,'L');
        $pdf->Rect(260,33.5,4,4,'D');
        
        
        $pdf->Cell(7,5,'',0,'L');
        $pdf->Cell(11,5,'KSKS',0,'L');
        $pdf->Rect(279,33.5,4,4,'D');

        $pdf->Ln();
        $pdf->Cell(6,5,'',0,'L');
        $pdf->Cell(50,5,'Nama Pengurus Keluarga',0,'L');
        $pdf->Cell(2,5,':',0,'L');
        $pdf->Cell(50,5,'Nasrul Kurniawan','B','L');
        
        $pdf->Cell(10,5,'',0,'L');
        $pdf->Cell(30,5,'Nama Provinsi',0,'L');
        $pdf->Cell(2,5,':',0,'L');
        $pdf->Cell(38,5,'Jawa Tengah','B','L');

        $pdf->Cell(4,5,'',0,'L');
        $pdf->Cell(10,5,'Kode',0,'L');
        $pdf->Rect(214,38,15,5,'D');

        $pdf->Cell(18,5,'',0,'L');
        $pdf->Cell(11,5,'KUBE',0,'L');
        $pdf->Rect(242,38.5,4,4,'D');
        
        
        $pdf->Cell(7,5,'',0,'L');
        $pdf->Cell(11,5,'RLTH',0,'L');
        $pdf->Rect(260,38.5,4,4,'D');
        
        
        $pdf->Cell(7,5,'',0,'L');
        $pdf->Cell(11,5,'PBI',0,'L');
        $pdf->Rect(279,38.5,4,4,'D');

        $pdf->Ln();
        $pdf->Cell(6,5,'',0,'L');
        $pdf->Cell(50,5,'Tempat, tanggal lahir',0,'L');
        $pdf->Cell(2,5,':',0,'L');
        $pdf->Cell(50,5,'Sragen, 25 Agustus 1989','B','L');

        
        $pdf->Cell(10,5,'',0,'L');
        $pdf->Cell(30,5,'Nama Kabupaten',0,'L');
        $pdf->Cell(2,5,':',0,'L');
        $pdf->Cell(38,5,'Sragen','B','L');
        
        
        $pdf->Cell(4,5,'',0,'L');
        $pdf->Cell(10,5,'Kode',0,'L');
        $pdf->Rect(214,43,15,5,'D');

        $pdf->Cell(18,5,'',0,'L');
        $pdf->Cell(11,5,'Raskin',0,'L');
        $pdf->Rect(242,43.5,4,4,'D');
        
        
        $pdf->Cell(7,5,'',0,'L');
        $pdf->Cell(11,5,'PMKS',0,'L');
        $pdf->Rect(260,43.5,4,4,'D');
        
        
        $pdf->Cell(7,5,'',0,'L');
        $pdf->Cell(11,5,'Askesos',0,'L');
        $pdf->Rect(279,43.5,4,4,'D');

        $pdf->Ln();
        $pdf->Cell(6,5,'',0,'L');
        $pdf->Cell(50,5,'Nama Ibu Kandung',0,'L');
        $pdf->Cell(2,5,':',0,'L');
        $pdf->Cell(50,5,'Ummi Ibunda','B','L');
        
        
        $pdf->Cell(10,5,'',0,'L');
        $pdf->Cell(30,5,'Nama Kecamatan',0,'L');
        $pdf->Cell(2,5,':',0,'L');
        $pdf->Cell(38,5,'Sragen','B','L');

        
        $pdf->Cell(4,5,'',0,'L');
        $pdf->Cell(10,5,'Kode',0,'L');
        $pdf->Rect(214,48,15,5,'D');

        $pdf->Cell(18,5,'',0,'L');
        $pdf->Cell(11,5,'UEP',0,'L');
        $pdf->Rect(242,48.5,4,4,'D');
        
        
        $pdf->Cell(7,5,'',0,'L');
        $pdf->Cell(11,5,'PNPMM',0,'L');
        $pdf->Rect(260,48.5,4,4,'D');
        
        
        $pdf->Cell(7,5,'',0,'L');
        $pdf->Cell(11,5,' ',0,'L');
        $pdf->Rect(279,48.5,4,4,'D');

        $pdf->Ln();
        $pdf->Cell(6,5,'',0,'L');
        $pdf->Cell(50,5,'Alamat',0,'L');
        $pdf->Cell(2,5,':',0,'L');
        $pdf->Cell(50,5,'Sragen Rt 20/VII, Jateng, Indonesia','B','L');

        
        $pdf->Cell(10,5,'',0,'L');
        $pdf->Cell(30,5,'Desa/ Kelurahan',0,'L');
        $pdf->Cell(2,5,':',0,'L');
        $pdf->Cell(38,5,'Sragen','B','L');

        
        $pdf->Cell(4,5,'',0,'L');
        $pdf->Cell(10,5,'Kode',0,'L');
        $pdf->Rect(214,53,15,5,'D');

        $pdf->Cell(18,5,'',0,'L');
        $pdf->Cell(11,5,'KKS',0,'L');
        $pdf->Rect(242,53.5,4,4,'D');
        
        
        $pdf->Cell(7,5,'',0,'L');
        $pdf->Cell(11,5,'BLSM',0,'L');
        $pdf->Rect(260,53.5,4,4,'D');
        
        
        $pdf->Cell(7,5,'',0,'L');
        $pdf->Cell(11,5,' ',0,'L');
        $pdf->Rect(279,53.5,4,4,'D');

$pdf->SetFont('Arial','B','7');
        $pdf->Ln();
        $pdf->Cell(0,3,' ',0,'L');
        $pdf->Ln();
        $pdf->Cell(150,3,'Petunjuk Pengisian :',0,'L');

$pdf->SetFont('Arial','','7');
        $pdf->Ln();
        $pdf->Cell(180,3,'1.	Tanyakan setiap keterangan yang ada di formulir ini kepada KSM',0,'L');
$pdf->SetFont('Arial','','8');
        $pdf->Cell(35,3,'Nama  Pendamping: ',0,'L');
$pdf->SetFont('Arial','','11');
        $pdf->Cell(70,3,'Nasrul Kurniawan',0,'L');
        $pdf->Rect(222,63,66,5,'D');
$pdf->SetFont('Arial','','7');

        $pdf->Ln();
        $pdf->Cell(180,3,'2.	Jika ada keterangan yang berubah atau berbeda, maka tulis perubahannya di baris bawahnya yang bertanda**.',0,'L');

$pdf->SetFont('Arial','','7');
        $pdf->Ln();
        $pdf->Cell(230,3,'3.	Kode keterangan dapat dilihat pada bagian bawah formulir ini.',0,'L');

$pdf->SetFont('Arial','','8');
        $pdf->Cell(20,3,'Kode Pos ',0,'L');
        $pdf->Cell(30,3,'57277',0,'L');
        $pdf->Rect(258,69,20,5,'D');
$pdf->SetFont('Arial','','7');
        $pdf->Ln();
        $pdf->Cell(180,3,'4.	Jika ada ART (Anggota Rumah Tangga) baru maka ditulis dibaris yang masih kosong. ',0,'L');

//TABLE
        $pdf->Ln();
        $pdf->Cell(0,1,'',0,'C');
        $pdf->Ln();
$pdf->SetFont('Arial','',7);
        $pdf->Cell(9,3,' ','LRT',0,'C');
        $pdf->Cell(55,3,' ','RT',0,'C');
        $pdf->Cell(26,3,' ','RT',0,'C');
        $pdf->Cell(7,3,' ','RT',0,'C');
        $pdf->Cell(6,3,'Hub','RT',0,'C');
        $pdf->Cell(6,3,' ','RT',0,'C');
        $pdf->Cell(7,3,' ','RT',0,'C');
        $pdf->Cell(7,3,' ','RT',0,'C');
        $pdf->Cell(26,3,' ','RT',0,'C');
        $pdf->Cell(32,3,'Umur 6-18 Tahun','RT',0,'C');
        $pdf->Cell(14,3,'Ibu RT','RT',0,'C');
        $pdf->Cell(14,3,'Status Anak','RT',0,'C');
        $pdf->Cell(7,3,' ','RT',0,'C');
        $pdf->Cell(7,3,' ','RT',0,'C');
        $pdf->Cell(7,3,' ','RT',0,'C');
        $pdf->Cell(48,3,'Nama dan Alamat Sekolah/ Fasilitas','RT',0,'C');
//HEADER 2
        $pdf->Ln();
        $pdf->Cell(9,3,'No. AK','LR',0,'C');
        $pdf->Cell(55,3,'Nama AK','LR',0,'C');
        $pdf->Cell(26,3,'TGL Lahir','LR',0,'C');
        $pdf->Cell(7,3,'Kate','LR',0,'C');
        $pdf->Cell(6,3,'dgn','LR',0,'C');
        $pdf->Cell(6,3,'JK','LR',0,'C');
        $pdf->Cell(7,3,'Disab','LR',0,'C');
        $pdf->Cell(7,3,'Umur','LR',0,'C');
        $pdf->Cell(26,3,'TGL','LR',0,'C');
$pdf->SetFont('Arial','',6);
        $pdf->Cell(14,3,'Sdg Sekolah','BTLR',0,'C');
        $pdf->Cell(18,3,'Blm/Tdk Sekolah','BTLR',0,'C');
        $pdf->Cell(7,3,' ','TLR',0,'C');
        $pdf->Cell(7,3,' ','TLR',0,'C');
        $pdf->Cell(7,3,' ','TLR',0,'C');
        $pdf->Cell(7,3,' ','TLR',0,'C');
        $pdf->Cell(7,3,'KIP','LR',0,'C');
        $pdf->Cell(7,3,'KIS','LR',0,'C');
        $pdf->Cell(7,3,'JKS','LR',0,'C');
$pdf->SetFont('Arial','',7);
        $pdf->Cell(48,3,'Kesehatan','LR',0,'C');
// 3
        $pdf->Ln();
        $pdf->Cell(9,3,'(1)','LR',0,'C');
        $pdf->Cell(55,3,'(2)','LR',0,'C');
        $pdf->Cell(26,3,'TGL BLN THN','LR',0,'C');
        $pdf->Cell(7,3,'gori','LR',0,'C');
        $pdf->Cell(6,3,'KRT','LR',0,'C');
        $pdf->Cell(6,3,'(6)','LR',0,'C');
        $pdf->Cell(7,3,'ilitas','LR',0,'C');
        $pdf->Cell(7,3,'(8)','LR',0,'C');
        $pdf->Cell(26,3,'Meninggal','LR',0,'C');
$pdf->SetFont('Arial','',6);
        $pdf->Cell(7,3,'Jenjang','LR',0,'C');
        $pdf->Cell(7,3,'Kelas','LR',0,'C');
        $pdf->Cell(18,3,'Mau Mendaftar','LR',0,'C');
$pdf->SetFont('Arial','',6);
        $pdf->Cell(7,3,'Hamil','LR',0,'C');
        $pdf->Cell(7,3,'Usia','LR',0,'C');
        $pdf->Cell(7,3,'P.A','LR',0,'C');
        $pdf->Cell(7,3,'A.J','LR',0,'C');
        $pdf->Cell(7,3,'(17)','LR',0,'C');
        $pdf->Cell(7,3,'(18)','LR',0,'C');
        $pdf->Cell(7,3,'(19)','LR',0,'C');
$pdf->SetFont('Arial','',7);
        $pdf->Cell(48,3,'(Puskesmas/Pustu/Posyandu/ ','LR',0,'C');
// 4
        $pdf->Ln();
        $pdf->Cell(9,3,' ','LR',0,'C');
        $pdf->Cell(55,3,' ','LR',0,'C');
        $pdf->Cell(26,3,'(3)','LR',0,'C');
        $pdf->Cell(7,3,'(4)','LR',0,'C');
        $pdf->Cell(6,3,'(5)','LR',0,'C');
        $pdf->Cell(6,3,'','LR',0,'C');
        $pdf->Cell(7,3,'(7)','LR',0,'C');
        $pdf->Cell(7,3,'','LR',0,'C');
        $pdf->Cell(26,3,'(9)','LR',0,'C');
        
$pdf->SetFont('Arial','',6);
        $pdf->Cell(7,3,'(10)','LR',0,'C');
        $pdf->Cell(7,3,'(11)','LR',0,'C');
        $pdf->Cell(18,3,'Sekolah','LR',0,'C');
        $pdf->Cell(7,3,'(13)','LR',0,'C');
        $pdf->Cell(7,3,'(14)','LR',0,'C');
        $pdf->Cell(7,3,'(15)','LR',0,'C');
        $pdf->Cell(7,3,'(16)','LR',0,'C');
        $pdf->Cell(7,3,' ','LR',0,'C');
        $pdf->Cell(7,3,' ','LR',0,'C');
        $pdf->Cell(7,3,' ','LR',0,'C');
$pdf->SetFont('Arial','',7);
        $pdf->Cell(48,3,'Polindes)','LR',0,'C');
// 5
        $pdf->Ln();
        $pdf->Cell(9,3,' ','LBR',0,'C');
        $pdf->Cell(55,3,' ','RB',0,'C');

        $pdf->Cell(26,3,' ','RB',0,'C');
        $pdf->Cell(7,3,' ','RB',0,'C');
        $pdf->Cell(6,3,'','RB',0,'C');
        $pdf->Cell(6,3,' ','RB',0,'C');
        $pdf->Cell(7,3,' ','RB',0,'C');
        $pdf->Cell(7,3,'','RB',0,'C');
        $pdf->Cell(26,3,'','RB',0,'C');
        
$pdf->SetFont('Arial','',6);
        $pdf->Cell(7,3,' ','BLR',0,'C');
        $pdf->Cell(7,3,' ','BLR',0,'C');
        $pdf->Cell(18,3,'(12)','BLR',0,'C');
        $pdf->Cell(7,3,' ','BLR',0,'C');
        $pdf->Cell(7,3,' ','BLR',0,'C');
        $pdf->Cell(7,3,' ','BLR',0,'C');
        $pdf->Cell(7,3,' ','BLR',0,'C');
        $pdf->Cell(7,3,' ','BLR',0,'C');
        $pdf->Cell(7,3,' ','BLR',0,'C');
        $pdf->Cell(7,3,' ','BLR',0,'C');
$pdf->SetFont('Arial','',7);
        $pdf->Cell(48,3,'(20)','BLR',0,'C');
        $pdf->Ln();
//CONTENTS ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$cnt=93.5;
for($a=0;$a<12;$a++){
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(9,7,'1 *)','LBR',0,'C');
        $pdf->Cell(55,7,'Nama 1','RB',0,'L');
    $pdf->SetFont('Arial','',10);
        $pdf->Cell(26,7,' 9  9  9  9  9  9','RB',0,'L');
            $pdf->Rect(75,$cnt,4,4,'D');
            $pdf->Rect(79,$cnt,4,4,'D');
            $pdf->Rect(83,$cnt,4,4,'D');
            $pdf->Rect(87,$cnt,4,4,'D');
            $pdf->Rect(91,$cnt,4,4,'D');
            $pdf->Rect(95,$cnt,4,4,'D');
        $pdf->Cell(7,7,'10','RB',0,'C');
            $pdf->Rect(101,$cnt,5,4,'D');
        $pdf->Cell(6,7,'8','RB',0,'C');
            $pdf->Rect(108,$cnt,4,4,'D');
        $pdf->Cell(6,7,'2','RB',0,'C');
            $pdf->Rect(114,$cnt,4,4,'D');
        $pdf->Cell(7,7,'13','RB',0,'C');
            $pdf->Rect(120,$cnt,5,4,'D');
        $pdf->Cell(7,7,'88','RB',0,'C');
            $pdf->Rect(127,$cnt,5,4,'D');
        $pdf->Cell(26,7,' 9  9  9  9  9  9','RB',0,'C');
            $pdf->Rect(134,$cnt,4,4,'D');
            $pdf->Rect(138,$cnt,4,4,'D');
            $pdf->Rect(142,$cnt,4,4,'D');
            $pdf->Rect(146,$cnt,4,4,'D');
            $pdf->Rect(150,$cnt,4,4,'D');
            $pdf->Rect(154,$cnt,4,4,'D');
        $pdf->Cell(7,7,'88','BLR',0,'C');
            $pdf->Rect(160,$cnt,5,4,'D');
        $pdf->Cell(7,7,'88','BLR',0,'C');
            $pdf->Rect(167,$cnt,5,4,'D');
        $pdf->Cell(18,7,'1','BLR',0,'C');
            $pdf->Rect(175,$cnt,14,4,'D');
        $pdf->Cell(7,7,'2','BLR',0,'C');
            $pdf->Rect(192,$cnt,5,4,'D');
        $pdf->Cell(7,7,'2','BLR',0,'C');
            $pdf->Rect(199,$cnt,5,4,'D');
        $pdf->Cell(7,7,'2','BLR',0,'C');
            $pdf->Rect(206,$cnt,5,4,'D');
        $pdf->Cell(7,7,'3','BLR',0,'C');
            $pdf->Rect(213,$cnt,5,4,'D');
        $pdf->Cell(7,7,'2','BLR',0,'C');
            $pdf->Rect(220,$cnt,5,4,'D');
        $pdf->Cell(7,7,'2','BLR',0,'C');
            $pdf->Rect(227,$cnt,5,4,'D');
        $pdf->Cell(7,7,'2','BLR',0,'C');
            $pdf->Rect(234,$cnt,5,4,'D');
    $pdf->SetFont('Arial','',7);
        $pdf->Cell(48,7,'Contoh','BLR',0,'C');
        $pdf->Ln();
$cnt+=7;
}
$pdf->Ln();
$pdf->SetFont('Arial','B',6);
        $pdf->Cell(18,3,'Kategori (3)',0,'L');
        $pdf->Cell(18,3,'',0,'L');
        $pdf->Cell(18,3,'Hub. dg KRT (5)',0,'L');
        $pdf->Cell(18,3,' ',0,'L');
        $pdf->Cell(18,3,'Kode JK (6)',0,'L');
        $pdf->Cell(79,3,'Disabilitas (7)',0,'L');
        $pdf->Cell(26,3,'Jenjang Pendidikan (10)',0,'L');
        $pdf->Cell(18,3,'Kode Kelas (11)',0,'L');
        $pdf->Cell(24,3,'Blm/ Tdk Sekolah (12)',0,'L');
        $pdf->Cell(24,3,'Kode Status',0,'L');
        $pdf->Cell(18,3,'Kode Status',0,'L');

$pdf->SetFont('Arial','',6);
        $pdf->Ln();
        $pdf->Cell(18,3,'1= Bumi/Bufas',0,'L');
        $pdf->Cell(18,3,'6= Anak SMA',0,'L');
        $pdf->Cell(18,3,'1= Kepala ART',0,'L');
        $pdf->Cell(18,3,'5= Cucu',0,'L');
        $pdf->Cell(18,3,'1= Laki-laki',0,'L');
        $pdf->Cell(26,3,'1= Tidak cacat',0,'L');
        $pdf->Cell(18,3,'7= Tuna Rungu',0,'L');
        $pdf->Cell(35,3,'13= Tuna Netra & Rungu & Wicara',0,'L');
        $pdf->Cell(26,3,'1=SD/MI/SDLB',0,'L');
        $pdf->Cell(18,3,'SD= 1-6',0,'L');
        $pdf->Cell(24,3,'1=Mau mendaftar ',0,'L');
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(24,3,'hamil  (13) ',0,'L');
        $pdf->Cell(18,3,'(15 - 16) ',0,'L');
        $pdf->SetFont('Arial','',6);
        $pdf->Ln();
        $pdf->Cell(18,3,'2= Balita',0,'L');
        $pdf->Cell(18,3,'7= Mahasiswa PT',0,'L');
        $pdf->Cell(18,3,'2= Istri/Suami',0,'L');
        $pdf->Cell(18,3,'6= Ortu/ mertua',0,'L');
        $pdf->Cell(18,3,'2= Perempuan',0,'L');
        $pdf->Cell(26,3,'2= Tuna Daksa/Cacat Tbh',0,'L');
        $pdf->Cell(53,3,'8= Cct Fisik & Mental',0,'L');
        $pdf->Cell(26,3,'2=SLTP/MTs/SMPLB',0,'L');
        $pdf->Cell(18,3,'SLTP= 7-9',0,'L');
        $pdf->Cell(24,3,'  sekolah',0,'L');
        
        $pdf->Cell(24,3,'1= Hamil',0,'L');
        $pdf->Cell(18,3,'1= Ya',0,'L');
        $pdf->Ln();
        $pdf->Cell(18,3,'3= Apras',0,'L');
        $pdf->Cell(18,3,'8=Lansia',0,'L');
        $pdf->Cell(18,3,'3= Anak',0,'L');
        $pdf->Cell(18,3,'7= Famili lain',0,'L');
        $pdf->Cell(18,3,'',0,'L');
        $pdf->Cell(26,3,'3= Tuna Netra/ Buta',0,'L');
        $pdf->Cell(53,3,'9= Tuna Rungu & Wicara',0,'L');
        $pdf->Cell(26,3,'3= SMU sederajat',0,'L');
        $pdf->Cell(18,3,'SLTA= 10-12',0,'L');
        $pdf->Cell(24,3,'2= Tdk mau mendaftar',0,'L');
        $pdf->Cell(24,3,'2= Tidak Hamil',0,'L');
        $pdf->Cell(18,3,'2= Tidak',0,'L');
        $pdf->Ln();
        $pdf->Cell(18,3,'4= Anak SD',0,'L');
        $pdf->Cell(18,3,'9= Non Kategori',0,'L');
        $pdf->Cell(18,3,'4= Menantu',0,'L');
        $pdf->Cell(18,3,'8= Lainnya',0,'L');
        $pdf->Cell(18,3,'',0,'L');
        $pdf->Cell(26,3,'4= Cct Mental Retardasi',0,'L');
        $pdf->Cell(53,3,'10= Tuna Tungu & Wicara & Cct Tubuh',0,'L');
        $pdf->Cell(26,3,'88= Tidak berlaku',0,'L');
        $pdf->Cell(18,3,'88= Tidak berlaku',0,'L');
        $pdf->Cell(24,3,'  sekolah',0,'L');
        $pdf->SetFont('Arial','B',6);
        $pdf->Cell(24,3,'KIP (17)',0,'L');
        $pdf->Cell(18,3,'KIS (18)',0,'L');
        $pdf->SetFont('Arial','',6);
        $pdf->Ln();
        $pdf->Cell(18,3,'5= Anak SMP',0,'L');
        $pdf->Cell(18,3,'10= Meninggal Dunia',0,'L');
        $pdf->Cell(18,3,'',0,'L');
        $pdf->Cell(18,3,'',0,'L');
        $pdf->Cell(18,3,'',0,'L');
        $pdf->Cell(26,3,'5= Tuna Wicara',0,'L');
        $pdf->Cell(53,3,'11= Tuna Tungu & Wicara & Netra & Cct Tubuh',0,'L');
        $pdf->Cell(26,3,' ',0,'L');
        $pdf->Cell(18,3,' ',0,'L');

    $pdf->SetFont('Arial','B',6);
        $pdf->Cell(24,3,'JKS (19)= Jamkesmas',0,'L');
    $pdf->SetFont('Arial','',6);
        $pdf->Cell(24,3,'1=Ya',0,'L');
        $pdf->Cell(18,3,'1=Ya',0,'L');

    
        $pdf->Ln();
        $pdf->Cell(18,3,' ',0,'L');
        $pdf->Cell(18,3,' ',0,'L');
        $pdf->Cell(18,3,'',0,'L');
        $pdf->Cell(18,3,'',0,'L');
        $pdf->Cell(18,3,'',0,'L');
        $pdf->Cell(26,3,'6= Mantan Pend. Gg. Jiwa',0,'L');
        $pdf->Cell(97,3,'12= Tuna Netra & Cct Tubuh',0,'L');
        $pdf->Cell(24,3,'1=Ya    2=Tidak',0,'L');
        $pdf->Cell(24,3,'2=Tidak',0,'L');
        $pdf->Cell(18,3,'2=Tidak',0,'L');

$pdf->Output('FORMULIR REGISTRASI PESERTA DIDIK BARU.pdf','I');
//$pdf->Output('FORMULIR REGISTRASI PESERTA DIDIK BARU.pdf');

?>