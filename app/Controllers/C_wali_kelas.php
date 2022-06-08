<?php

namespace App\Controllers;

class C_wali_kelas extends BaseController
{

	public function dataSiswa()
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();

		$ID_Kelas = session()->get('ID_KLS');
		$IdSubKls = session()->get('ID_SUB_KLS');
		$NilaiMapel = $NilaiMapelModel->query("SELECT NISN, NIS, NAMA_LENGKAP, ID_SUB_KLS, JENIS_KELAMIN, AGAMA
		FROM SISWA
		WHERE ID_SUB_KLS = '$IdSubKls'");

		$Mapel = $NilaiMapelModel->query("SELECT * 
		FROM DETAIL_MAPEL");

		$i = $this->SetNamaSubKls();
		// foreach ($namaSubKls->getResultArray() as $O) {
		// };

		$data = [
			'title' => 'Data Siswa | SDN Sidoketo',
			'NilaiMapel1' => $NilaiMapel,
			'Mapel' => $Mapel,
			'ID_Kelas' => $ID_Kelas,
			'IdSubKls' => $IdSubKls,
			'namaSubKls' => $i['NAMA_SUB_KELAS']
		];
		return view('Wali_Kelas/v_data_siswa', $data);
	}

	public function dataSiswa_insNaik()
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$TGL_NAIK = $this->request->getVar('tgl_naik');
		$KET_NAIK = $this->request->getVar('ket_naik');
		$NISN = $this->request->getVar('NISN');
		$ID_KELAS = $this->request->getVar('ID_KELAS');

		$cekInsert = $NilaiMapelModel->query("select count(nisn)'tes' from detail_kenaikan where nisn = '$NISN' and id_kelas = '$ID_KELAS'");

		foreach ($cekInsert->getResultArray() as $i) {
			if ($i['tes'] > 0) {
			} else {
				$NilaiMapelModel->query("INSERT INTO detail_kenaikan (NISN, ID_KELAS, TANGGAL_KENAIKAN, KETERANGAN_KENAIKAN) VALUES ('$NISN', '$ID_KELAS', '$TGL_NAIK', '$KET_NAIK'); ");
				session()->setFlashdata('pesan_insert', 'Siswa sudah lulus.');
			}
		}

		return redirect()->to("/wk/data_siswa");
	}

	public function dataSiswa_mbaru($nisn)
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$NilaiMapel = $NilaiMapelModel->query("SELECT *
		FROM SISWA
		WHERE NISN = '$nisn'");

		$dataMbaru = $NilaiMapelModel->query("SELECT *
		FROM MURID_BARU
		WHERE NISN = '$nisn'");

		$ID_SubKelas =  session()->get('ID_SUB_KLS');
		$NamaSubKls = $NilaiMapelModel->query("SELECT * From SUB_KELAS where ID_SUB_KLS =  '$ID_SubKelas' ");
		foreach ($NamaSubKls->getResultArray() as $O) {
		};

		$Mapel = $NilaiMapelModel->query("SELECT * 
		FROM DETAIL_MAPEL");

		$data = [
			'title' => 'Data Siswa | SDN Sidoketo',
			'NilaiMapel1' => $NilaiMapel,
			'Mapel' => $Mapel,
			'nisn' => $nisn,
			'dataMbaru' => $dataMbaru,
			'subKls' => $O['NAMA_SUB_KELAS']
		];
		return view('Wali_Kelas/v_detail_siswa_mbaru', $data);
	}

	public function dataSiswa_mpindahan($nisn)
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$NilaiMapel = $NilaiMapelModel->query("SELECT *
		FROM SISWA
		WHERE NISN = '$nisn'");

		$dataMpindahan = $NilaiMapelModel->query("SELECT *
		FROM MURID_PINDAHAN
		WHERE NISN = '$nisn'");

		$ID_SubKelas =  session()->get('ID_SUB_KLS');
		$NamaSubKls = $NilaiMapelModel->query("SELECT * From SUB_KELAS where ID_SUB_KLS =  '$ID_SubKelas' ");
		foreach ($NamaSubKls->getResultArray() as $O) {
		};

		$Mapel = $NilaiMapelModel->query("SELECT * 
		FROM DETAIL_MAPEL");

		$data = [
			'title' => 'Data Siswa | SDN Sidoketo',
			'NilaiMapel1' => $NilaiMapel,
			'Mapel' => $Mapel,
			'nisn' => $nisn,
			'dataMpindahan' => $dataMpindahan,
			'subKls' => $O['NAMA_SUB_KELAS']
		];
		return view('Wali_Kelas/v_detail_siswa_mpindahan', $data);
	}

	public function dataSiswa_tamat($nisn)
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$NilaiMapel = $NilaiMapelModel->query("SELECT *
		FROM SISWA
		WHERE NISN = '$nisn'");

		$dataTamat = $NilaiMapelModel->query("SELECT *
		FROM TAMAT_BELAJAR
		WHERE NISN = '$nisn'");

		$ID_SubKelas =  session()->get('ID_SUB_KLS');
		$NamaSubKls = $NilaiMapelModel->query("SELECT * From SUB_KELAS where ID_SUB_KLS =  '$ID_SubKelas' ");
		foreach ($NamaSubKls->getResultArray() as $O) {
		};

		$Mapel = $NilaiMapelModel->query("SELECT * 
		FROM DETAIL_MAPEL");

		$data = [
			'title' => 'Data Siswa | SDN Sidoketo',
			'NilaiMapel1' => $NilaiMapel,
			'Mapel' => $Mapel,
			'nisn' => $nisn,
			'dataTamat' => $dataTamat,
			'subKls' => $O['NAMA_SUB_KELAS']
		];
		return view('Wali_Kelas/v_detail_siswa_tamat', $data);
	}

	public function dataSiswa_ortu($nisn)
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$NilaiMapel = $NilaiMapelModel->query("SELECT *
		FROM SISWA
		WHERE NISN = '$nisn'");

		$dataOrtu = $NilaiMapelModel->query("SELECT *
		FROM ORTU_MURID
		WHERE NISN = '$nisn'");

		$ID_SubKelas =  session()->get('ID_SUB_KLS');
		$NamaSubKls = $NilaiMapelModel->query("SELECT * From SUB_KELAS where ID_SUB_KLS =  '$ID_SubKelas' ");
		foreach ($NamaSubKls->getResultArray() as $O) {
		};

		$Mapel = $NilaiMapelModel->query("SELECT * 
		FROM DETAIL_MAPEL");

		$data = [
			'title' => 'Data Siswa | SDN Sidoketo',
			'NilaiMapel1' => $NilaiMapel,
			'Mapel' => $Mapel,
			'nisn' => $nisn,
			'dataOrtu' => $dataOrtu,
			'subKls' => $O['NAMA_SUB_KELAS']
		];
		return view('Wali_Kelas/v_detail_siswa_ortu', $data);
	}

	public function dataSiswa_param($nisn)
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$NilaiMapel = $NilaiMapelModel->query("SELECT *
		FROM SISWA
		WHERE NISN = '$nisn'");

		$ID_SubKelas =  session()->get('ID_SUB_KLS');
		$NamaSubKls = $NilaiMapelModel->query("SELECT * From SUB_KELAS where ID_SUB_KLS =  '$ID_SubKelas' ");
		foreach ($NamaSubKls->getResultArray() as $O) {
		};

		$Mapel = $NilaiMapelModel->query("SELECT * 
		FROM DETAIL_MAPEL");

		// $foto = $NilaiMapelModel->query("SELECT gambar 
		// FROM uploads");


		// foreach ($foto->getResultArray() as $i) {
		// };

		$data = [
			'title' => 'Data Siswa | SDN Sidoketo',
			'NilaiMapel1' => $NilaiMapel,
			'Mapel' => $Mapel,
			'nisn' => $nisn,
			'subKls' => $O['NAMA_SUB_KELAS']
			// 'foto' => $i['gambar']
		];
		return view('Wali_Kelas/v_detail_siswa', $data);
	}

	public function nilaiMapel($idMapel, $idSmt)
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$Mapel = $NilaiMapelModel->query("SELECT * 
		FROM DETAIL_MAPEL");

		$namaSubKls = $this->SetNamaSubKls();
		$IdSubKls = session()->get('ID_SUB_KLS');
		$ID_Kelas =  session()->get('ID_KLS');
		$DataSemester = $NilaiMapelModel->query("SELECT ID_SEMESTER From Semester where ID_KELAS =  '$ID_Kelas' ");

		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$namaMapel = $NilaiMapelModel->query("SELECT NAMA_MAPEL 
		FROM DETAIL_MAPEL
		WHERE ID_DETAIL_MAPEL = '$idMapel';");

		$listSiswa = $NilaiMapelModel->query("SELECT NISN, NAMA_LENGKAP, NIS, ID_SUB_KLS FROM SISWA	WHERE ID_SUB_KLS = '$IdSubKls'");

		if (($idSmt == 1) || ($idSmt == 3) || ($idSmt == 5) || ($idSmt == 7) || ($idSmt == 9) || ($idSmt == 11)) {

			$StatusUjian = $NilaiMapelModel->Query(" SELECT 
			(case when ((DATE_FORMAT(SYSDATE(), '%m') = 9) OR (DATE_FORMAT(SYSDATE(), '%m') = 10)) THEN 1 ELSE 0 END) as CekUTS,
			(case when ((DATE_FORMAT(SYSDATE(), '%m') = 10) OR (DATE_FORMAT(SYSDATE(), '%m') = 1)) THEN 1 ELSE 0 END) as CekUAS
			
			;");
		} else {

			$StatusUjian = $NilaiMapelModel->Query(" SELECT  
			(case when ((DATE_FORMAT(SYSDATE(), '%m') = 2) OR (DATE_FORMAT(SYSDATE(), '%m') = 3)) THEN 1 ELSE 0 END) as CekUTS,
			(case when ((DATE_FORMAT(SYSDATE(), '%m') = 6) OR (DATE_FORMAT(SYSDATE(), '%m') = 7)) THEN 1 ELSE 0 END) as CekUAS;");
		}

		foreach ($StatusUjian->getResultArray() as $StatusUjian) {
		}

		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$NilaiMapel = $NilaiMapelModel->query("SELECT S.NIS, N.NISN, S.NAMA_LENGKAP, S.ID_SUB_KLS, N.TUGAS, N.UTS, N.UAS 
		FROM NILAI N 
		JOIN SISWA S  
		ON N.NISN = S.NISN 
		WHERE ID_SEMESTER = '$idSmt' and N.ID_DETAIL_MAPEL = '$idMapel' and S.ID_SUB_KLS = '$IdSubKls'");

		// $namaMapel = $idMapel;

		foreach ($namaMapel->getResultArray() as $O) {
		};

		$i = $this->SetNamaSubKls();

		$data = [
			'title' => 'Data Siswa | SDN Sidoketo',
			// 'Mapel' => $Mapel,
			'Mapel' => $this->SetMenu(session()->get('ID_SUB_KLS')),
			'namaMapel' => $O['NAMA_MAPEL'],
			'listSiswa' => $listSiswa,
			'NilaiMapel' => $NilaiMapel,
			'KlikId' => $idSmt,
			'idmapel' => $idMapel,
			'DataSemester' => $DataSemester,
			'StatusUTS' => $StatusUjian['CekUTS'],
			'StatusUAS' => $StatusUjian['CekUAS'],
			// 'namaSubKls' => $i['NAMA_SUB_KELAS']
			'namaSubKls' => $i['NAMA_SUB_KELAS']
		];
		// echo $idMapel;
		return view('Wali_Kelas/v_nilai_mapel', $data);
	}

	public function nilaiMapelUpdate()
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$NISN = $this->request->getVar('NISN');
		$TUGAS = $this->request->getVar('TUGAS');
		$TUGAS_ASLI = $this->request->getVar('TUGAS_ASLI');

		$UTS = $this->request->getVar('UTS');
		$UAS = $this->request->getVar('UAS');
		$Semester = $this->request->getVar('Semester');
		$idMapel = $this->request->getVar('ID_DETAIL_MAPEL');

		$tgs1 = $this->request->getVar('tgs1');
		$tgs2 = $this->request->getVar('tgs2');
		$tgs3 = $this->request->getVar('tgs3');

		$tgs4 = $this->request->getVar('tgs4');
		$tgs5 = $this->request->getVar('tgs5');
		$tgs6 = $this->request->getVar('tgs6');

		$tgs7 = $this->request->getVar('tgs7');
		$tgs8 = $this->request->getVar('tgs8');
		$tgs9 = $this->request->getVar('tgs9');

		if ($TUGAS_ASLI == $TUGAS) {

			$TUGAS = ($tgs1 + $tgs2 + $tgs3 + $tgs4 + $tgs5 + $tgs6 + $tgs7 + $tgs8 + $tgs9) / 9;

			if (($TUGAS < 0) || ($UTS < 0) || ($UAS < 0) || ($UAS > 100) || ($UTS > 100) || ($TUGAS > 100)) {
				session()->setFlashdata('pesan_hapus', 'Input nilai tidak sesuai.');
			} else {

				$NilaiMapelModel->query("UPDATE NILAI 
				set TUGAS = '$TUGAS', UTS = '$UTS', UAS = '$UAS'
				WHERE NISN = '$NISN' AND ID_DETAIL_MAPEL = '$idMapel' AND ID_SEMESTER = '$Semester';");
			}
		} else {
			if (($TUGAS < 0) || ($UTS < 0) || ($UAS < 0) || ($UAS > 100) || ($UTS > 100) || ($TUGAS > 100)) {
				session()->setFlashdata('pesan_hapus', 'Input nilai tidak sesuai.');
			} else {

				$NilaiMapelModel->query("UPDATE NILAI 
				set TUGAS = '$TUGAS', UTS = '$UTS', UAS = '$UAS'
				WHERE NISN = '$NISN' AND ID_DETAIL_MAPEL = '$idMapel' AND ID_SEMESTER = '$Semester';");
			}
		}

		// if ($TUGAS == null || $TUGAS == 0 || $TUGAS == 0 || $TUGAS == 0 || $TUGAS == 0 || $TUGAS == 0) {

		// 	$TUGAS = ($tgs1 + $tgs2 + $tgs3 + $tgs4 + $tgs5 + $tgs6 + $tgs7 + $tgs8 + $tgs9) / 9;

		// 	if (($TUGAS < 0) || ($UTS < 0) || ($UAS < 0) || ($UAS > 100) || ($UTS > 100) || ($TUGAS > 100)) {
		// 		session()->setFlashdata('pesan_hapus', 'Input nilai tidak sesuai.');
		// 	} else {

		// 		$NilaiMapelModel->query("UPDATE NILAI 
		// 		set TUGAS = '$TUGAS', UTS = '$UTS', UAS = '$UAS'
		// 		WHERE NISN = '$NISN' AND ID_DETAIL_MAPEL = '$idMapel' AND ID_SEMESTER = '$Semester';");
		// 	}
		// } elseif ($TUGAS != null) {

		// 	if (($TUGAS < 0) || ($UTS < 0) || ($UAS < 0) || ($UAS > 100) || ($UTS > 100) || ($TUGAS > 100)) {
		// 		session()->setFlashdata('pesan_hapus', 'Input nilai tidak sesuai.');
		// 	} else {

		// 		$NilaiMapelModel->query("UPDATE NILAI 
		// 		set TUGAS = '$TUGAS', UTS = '$UTS', UAS = '$UAS'
		// 		WHERE NISN = '$NISN' AND ID_DETAIL_MAPEL = '$idMapel' AND ID_SEMESTER = '$Semester';");
		// 	}
		// }

		// if (($TUGAS < 0) || ($UTS < 0) || ($UAS < 0) || ($UAS > 100) || ($UTS > 100) || ($TUGAS > 100)) {
		// 	session()->setFlashdata('pesan_hapus', 'Input nilai tidak sesuai.');
		// } else {
		// 	$NilaiMapelModel->query("UPDATE NILAI 
		// 	set TUGAS = '$TUGAS', UTS = '$UTS', UAS = '$UAS'
		// 	WHERE NISN = '$NISN' AND ID_DETAIL_MAPEL = '$idMapel' AND ID_SEMESTER = '$Semester';");
		// }

		return redirect()->to("/wk/nilai_mapel/$idMapel/$Semester");
	}

	public function nilaiKesehatanUpdate()
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$NISN = $this->request->getVar('NISN');
		$BERAT_BADAN = $this->request->getVar('BERAT_BADAN');
		$TINGGI_BADAN = $this->request->getVar('TINGGI_BADAN');
		$PENDENGARAN = $this->request->getVar('PENDENGARAN');
		$PENGLIHATAN = $this->request->getVar('PENGELIHATAN');
		$GIGI = $this->request->getVar('GIGI');
		$Semester = $this->request->getVar('Semester');

		// 		dd("UPDATE KESEHATAN 
		// set BERAT_BADAN = '$BERAT_BADAN', TINGGI_BADAN = '$TINGGI_BADAN', PENDENGARAN = '$PENDENGARAN', PENGELIHATAN = '$PENGLIHATAN', GIGI = '$GIGI'
		// WHERE NISN = '$NISN' AND ID_SEMESTER = $Semester;");

		$NilaiMapelModel->query("UPDATE KESEHATAN 
		set BERAT_BADAN = '$BERAT_BADAN', TINGGI_BADAN = '$TINGGI_BADAN', PENDENGARAN = '$PENDENGARAN', PENGELIHATAN = '$PENGLIHATAN', GIGI = '$GIGI'
		WHERE NISN = '$NISN' AND ID_SEMESTER = $Semester;");

		// $NilaiMapelModel = new \App\Models\NilaiMapelModel();
		// $Mapel = $NilaiMapelModel->query("SELECT * 
		// FROM DETAIL_MAPEL");

		return redirect()->to("/wk/nilai_kesehatan/$Semester");
		// return view("/wk/nilai_kesehatan/1");
	}

	public function nilaiEkskulUpdate()
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$NISN = $this->request->getVar('NISN');
		$NE_EKSUL = $this->request->getVar('NILAI_EKSUL');
		$KET_EKSUL = $this->request->getVar('KETERANGAN_EKSUL');
		$Semester = $this->request->getVar('ID_SEMESTER');

		// dd("UPDATE NILAI_EKUL 
		// set NILAI_EKSUL = '$NE_EKSUL', KETERANGAN_EKSUL = '$KET_EKSUL'
		// WHERE NISN = '$NISN' AND ID_SEMESTER = '$Semester';");

		$NilaiMapelModel->query("UPDATE NILAI_EKUL 
		set NILAI_EKSUL = '$NE_EKSUL', KETERANGAN_EKSUL = '$KET_EKSUL'
		WHERE NISN = '$NISN' AND ID_SEMESTER = '$Semester';");

		// $NilaiMapelModel = new \App\Models\NilaiMapelModel();
		// $Mapel = $NilaiMapelModel->query("SELECT * 
		// FROM DETAIL_MAPEL");

		return redirect()->to("/wk/nilai_ekskul/$Semester");
	}

	public function D_nilaiEkskulUpdate()
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		// update ekskul smt 1
		$NISN = $this->request->getVar('nisn1');
		$ID_EKSUL1 = $this->request->getVar('idEkskulS1');
		$NM_EKSUL1 = $this->request->getVar('nmIdEkskulS1');
		$KET_EKSUL1 = $this->request->getVar('ketEkskulS1');
		$NI_EKSUL1 = $this->request->getVar('niEkskulS1');
		$Semester1 = $this->request->getVar('smt1');

		// update ekskul smt 2
		$NISN1 = $this->request->getVar('nisn2');
		$ID_EKSUL2 = $this->request->getVar('idEkskulS2');
		$NM_EKSUL2 = $this->request->getVar('nmIdEkskulS2');
		$KET_EKSUL2 = $this->request->getVar('ketEkskulS2');
		$NI_EKSUL2 = $this->request->getVar('niEkskulS2');
		$Semester2 = $this->request->getVar('smt2');

		if ($ID_EKSUL1 != null) {
			// echo "masuk if";
			$NilaiMapelModel->query("UPDATE NILAI_EKUL 
			set ID_EKSUL = '$NM_EKSUL1', NILAI_EKSUL = '$NI_EKSUL1', KETERANGAN_EKSUL = '$KET_EKSUL1'
			WHERE NISN = '$NISN' AND ID_SEMESTER = '$Semester1' AND ID_EKSUL = '$ID_EKSUL1';");
			return redirect()->to("/wk/nilai_ekskul/detail/$NISN");
		} else {
			// echo "masuk else";
			$NilaiMapelModel->query("UPDATE NILAI_EKUL 
			set ID_EKSUL = '$NM_EKSUL2', NILAI_EKSUL = '$NI_EKSUL2', KETERANGAN_EKSUL = '$KET_EKSUL2'
			WHERE NISN = '$NISN1' AND ID_SEMESTER = '$Semester2' AND ID_EKSUL = '$ID_EKSUL2';");
			return redirect()->to("/wk/nilai_ekskul/detail/$NISN1");
		}
	}

	public function D_nilaiEkskulInsert()
	{
		$NilaiMapelModel1 = new \App\Models\NilaiMapelModel();
		$smt1 = session()->get('SMT_1');
		$smt2 = session()->get('SMT_2');

		$NISN1 = $this->request->getVar('nisn1');

		// sems 1
		$ID_EKSKULS1 = $this->request->getVar('idEksulS1');
		$NM_EKSUL1 = $this->request->getVar('EksulS1');
		$NI_EKSUL1 = $this->request->getVar('niEksulS1');
		$ketEksulS1 = $this->request->getVar('ketEksulS1');

		// sems 2
		$ID_EKSKULS2 = $this->request->getVar('idEksulS2');
		$NM_EKSUL2 = $this->request->getVar('EksulS2');
		$NI_EKSUL2 = $this->request->getVar('niEksulS2');
		$ketEksulS2 = $this->request->getVar('ketEksulS2');

		$cekInsert = $NilaiMapelModel1->query("SELECT count(ID_EKSUL)'tes' from NILAI_EKUL where nisn = '$NISN1' and id_eksul = '$ID_EKSKULS1' and id_semester = '$smt1'");

		$cekInsert2 = $NilaiMapelModel1->query("SELECT count(ID_EKSUL)'tes' from NILAI_EKUL where nisn = '$NISN1' and id_eksul = '$ID_EKSKULS2' and id_semester = '$smt2'");

		if ($ID_EKSKULS1 != null) {

			foreach ($cekInsert->getResultArray() as $i) {
				if ($i['tes'] <= 0) {

					// echo "masuk if";
					$NilaiMapelModel1->query(
						"INSERT INTO NILAI_EKUL (ID_EKSUL, ID_SEMESTER, NISN, NILAI_EKSUL, KETERANGAN_EKSUL) 
					VALUES ('$ID_EKSKULS1', '$smt1', '$NISN1', '$NI_EKSUL1', '$ketEksulS1');"
					);

					session()->setFlashdata('pesan_insert', 'nilai ekskul ditambahkan.');
				} elseif ($i['tes'] > 0) {
				}
			}
			return redirect()->to("/wk/nilai_ekskul/detail/$NISN1");
		} else if ($ID_EKSKULS2 != null) {

			foreach ($cekInsert2->getResultArray() as $i) {
				if ($i['tes'] <= 0) {

					// echo "masuk if";
					$NilaiMapelModel1->query(
						"INSERT INTO NILAI_EKUL (ID_EKSUL, ID_SEMESTER, NISN, NILAI_EKSUL, KETERANGAN_EKSUL) 
					VALUES ('$ID_EKSKULS2', '$smt2', '$NISN1', '$NI_EKSUL2', '$ketEksulS2');"
					);

					session()->setFlashdata('pesan_insert', 'nilai ekskul ditambahkan.');
				} elseif ($i['tes'] > 0) {
					// echo "masuk else";
				}
			}
			return redirect()->to("/wk/nilai_ekskul/detail/$NISN1");
		}
	}

	public function D_nilaiEkskulDelete()
	{
		$NilaiMapelModel1 = new \App\Models\NilaiMapelModel();
		$smt1 = session()->get('SMT_1');
		$smt2 = session()->get('SMT_2');

		$NISN1 = $this->request->getVar('nisn1');

		// sems 1
		$ID_EKSKULS1 = $this->request->getVar('idEkskulS1');
		$NM_EKSUL1 = $this->request->getVar('EksulS1');
		$NI_EKSUL1 = $this->request->getVar('niEksulS1');
		$ketEksulS1 = $this->request->getVar('ketEksulS1');

		// sems 2
		$ID_EKSKULS2 = $this->request->getVar('idEkskulS2');
		$NM_EKSUL2 = $this->request->getVar('EksulS2');
		$NI_EKSUL2 = $this->request->getVar('niEksulS2');
		$ketEksulS2 = $this->request->getVar('ketEksulS2');

		// $cekInsert = $NilaiMapelModel1->query("SELECT count(ID_EKSUL)'tes' from NILAI_EKUL where nisn = '$NISN1' and id_eksul = '$ID_EKSKULS1' and id_semester = '$smt1'");

		// $cekInsert2 = $NilaiMapelModel1->query("SELECT count(ID_EKSUL)'tes' from NILAI_EKUL where nisn = '$NISN1' and id_eksul = '$ID_EKSKULS2' and id_semester = '$smt2'");

		// echo "masuk if";
		// $Sub_KelasModel->query("DELETE FROM Jabatan WHERE ID_JABATAN = '$id';");
		$NilaiMapelModel1->query("DELETE FROM NILAI_EKUL WHERE ID_EKSUL = '$ID_EKSKULS1' AND ID_SEMESTER = '$smt1' AND NISN = '$NISN1';");
		$NilaiMapelModel1->query("DELETE FROM NILAI_EKUL WHERE ID_EKSUL = '$ID_EKSKULS2' AND ID_SEMESTER = '$smt2' AND NISN = '$NISN1';");

		// session()->setFlashdata('pesan_insert', 'nilai ekskul ditambahkan.');


		return redirect()->to("/wk/nilai_ekskul/detail/$NISN1");
		// if ($ID_EKSKULS2 != null) {


		// 	return redirect()->to("/wk/nilai_ekskul/detail/$NISN1");
		// }
	}


	public function nilaiEkskul_detail($nisn)
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$ID_Kelas =  session()->get('SMT_1');
		$ID_Kelas =  session()->get('SMT_2');
		$smt1 = session()->get('SMT_1');
		$smt2 = session()->get('SMT_2');

		$listEkskul = $NilaiMapelModel->query("SELECT * FROM EKSUL");

		$NilaiEkskul1 = $NilaiMapelModel->query("SELECT S.NIS, S.NISN, S.NAMA_LENGKAP, S.ID_SUB_KLS, E.NAMA_EKSUL, NE.NILAI_EKSUL, NE.KETERANGAN_EKSUL, NE.ID_EKSUL
		FROM SISWA S
		JOIN NILAI_EKUL NE 
		ON NE.NISN = S.NISN
		JOIN EKSUL E
		ON NE.ID_EKSUL = E.ID_EKSUL
		WHERE S.NISN = '$nisn' and NE.ID_SEMESTER = '$smt1'");

		$NilaiEkskul2 = $NilaiMapelModel->query("SELECT S.NIS, S.NISN, S.NAMA_LENGKAP, S.ID_SUB_KLS, E.NAMA_EKSUL, NE.NILAI_EKSUL, NE.KETERANGAN_EKSUL, NE.ID_EKSUL
		FROM SISWA S
		JOIN NILAI_EKUL NE 
		ON NE.NISN = S.NISN
		JOIN EKSUL E
		ON NE.ID_EKSUL = E.ID_EKSUL
		WHERE S.NISN = '$nisn' and NE.ID_SEMESTER = '$smt2'");

		$Mapel = $NilaiMapelModel->query("SELECT * 
		FROM DETAIL_MAPEL");

		$data = [
			'title' => 'Data Siswa | SDN Sidoketo',
			'NilaiEkskul1' => $NilaiEkskul1,
			'NilaiEkskul2' => $NilaiEkskul2,
			'listEkskul1' => $listEkskul,
			'smt1' => $smt1,
			'smt2' => $smt2,
			'Mapel' => $Mapel,
			'nisn' => $nisn
		];
		return view('Wali_Kelas/v_nilai_ekskul_detail', $data);
	}

	public function nilaiEkskul_param($idSmt)
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();

		$subKls = $this->SetSubKls();

		$siswa = $NilaiMapelModel->query("SELECT *
		FROM SISWA S
		WHERE ID_SUB_KLS = '$subKls'");

		foreach ($siswa->getResultArray() as $b) {
		}

		$NilaiEkskul = $NilaiMapelModel->query("SELECT S.NIS, S.NISN, S.NAMA_LENGKAP, S.ID_SUB_KLS, E.NAMA_EKSUL, NE.NILAI_EKSUL, NE.KETERANGAN_EKSUL
		FROM SISWA S
		JOIN NILAI_EKUL NE 
		ON NE.NISN = S.NISN
		JOIN EKSUL E
		ON NE.ID_EKSUL = E.ID_EKSUL
		WHERE ID_SEMESTER = '$idSmt' and S.ID_SUB_KLS = '$subKls'");

		foreach ($NilaiEkskul->getResultArray() as $u) {
		}

		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$Mapel = $NilaiMapelModel->query("SELECT * 
		FROM DETAIL_MAPEL");

		$i = $this->SetNamaSubKls();

		$data = [
			'title' => 'Data Siswa | SDN Sidoketo',
			'NilaiEkskul' => $NilaiEkskul,
			'siswa' => $siswa,
			// 'i99' => $u['NAMA_EKSUL'],
			// 'ab' => $b['NISN'],
			// 'i1' => $u['NILAI_EKSUL'],
			'Mapel' => $Mapel,
			'KlikId' => $idSmt,
			'DataSemester' => $this->SetSmt(),
			'namaSubKls' => $i['NAMA_SUB_KELAS']

		];

		return view('Wali_Kelas/v_nilai_ekskul', $data);
	}

	public function nilaiKepribadianUpdate()
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$NISN = $this->request->getVar('NISN');
		$ASPEK_PENILAIAN = $this->request->getVar('ASPEK_PENILAIAN');
		$NILAI_KEPRIBADIAN = $this->request->getVar('NILAI_KEPRIBADIAN');
		$DESKRIPSI = $this->request->getVar('DESKRIPSI');
		$Semester = $this->request->getVar('semester');

		if ($NILAI_KEPRIBADIAN > 100 || $NILAI_KEPRIBADIAN < 0) {

			session()->setFlashdata('pesan_hapus', 'Input nilai tidak sesuai.');
		} else {
			$NilaiMapelModel->query("UPDATE NILAI_KEPRIBADIAN 

			set ASPEK_PENILAIAN = '$ASPEK_PENILAIAN', NILAI_KEPRIBADIAN = '$NILAI_KEPRIBADIAN', DESKRIPSI = '$DESKRIPSI'
			WHERE NISN = '$NISN' AND ID_SEMESTER = '$Semester';");
		}



		return redirect()->to("/wk/nilai_kepribadian/$Semester");
	}

	public function nilaiAbsensiUpdate()
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$NISN = $this->request->getVar('NISN');
		$SAKIT = $this->request->getVar('SAKIT');
		$IZIN = $this->request->getVar('IZIN');
		$ALPA = $this->request->getVar('ALPA');
		$Semester = $this->request->getVar('semester');

		// dd("UPDATE NILAI_KEPRIBADIAN 
		// set ASPEK_PENILAIAN = '$ASPEK_PENILAIAN', NILAI_KEPRIBADIAN = '$NILAI_KEPRIBADIAN', DESKRIPSI = '$DESKRIPSI'
		// WHERE NISN = '$NISN' AND semester = '$Semester';");

		$NilaiMapelModel->query("UPDATE ABSENSI 
		set SAKIT = '$SAKIT', IZIN = '$IZIN', ALPA = '$ALPA'
		WHERE NISN = '$NISN' AND ID_SEMESTER = '$Semester';");

		// $NilaiMapelModel = new \App\Models\NilaiMapelModel();
		// $Mapel = $NilaiMapelModel->query("SELECT * 
		// FROM DETAIL_MAPEL");

		return redirect()->to("/wk/absensi/$Semester");
	}

	public function absensi_param($idSmt)
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();

		$subKls = $this->SetSubKls();
		$Absensi = $NilaiMapelModel->query("SELECT S.NISN, S.NIS, S.NAMA_LENGKAP, S.ID_SUB_KLS, A.SAKIT, A.IZIN, A.ALPA
		FROM SISWA S
		JOIN ABSENSI A 
		ON S.NISN = A.NISN
		WHERE ID_SEMESTER = $idSmt and S.ID_SUB_KLS = '$subKls'");

		$listSiswa = $NilaiMapelModel->query("SELECT NISN, NAMA_LENGKAP, NIS, ID_SUB_KLS FROM SISWA	WHERE ID_SUB_KLS = '$subKls'");

		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$Mapel = $NilaiMapelModel->query("SELECT * 
		FROM DETAIL_MAPEL");

		$i = $this->SetNamaSubKls();

		$data = [
			'title' => 'Data Siswa | SDN Sidoketo',
			'Absensi' => $Absensi,
			'Mapel' => $Mapel,
			'listSiswa' => $listSiswa,
			'KlikId' => $idSmt,
			'DataSemester' => $this->SetSmt(),
			'namaSubKls' => $i['NAMA_SUB_KELAS']
		];
		return view('Wali_Kelas/v_absensi', $data);
	}

	public function nilaiKepribadian_param($idSmt)
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$ID_SubKelas =  session()->get('ID_SUB_KLS');
		$IdSubKls = $this->SetSubKls();

		$listSiswa = $NilaiMapelModel->query("SELECT NISN, NAMA_LENGKAP, NIS, ID_SUB_KLS FROM SISWA	WHERE ID_SUB_KLS = '$ID_SubKelas'");
		$dataSiswa = $NilaiMapelModel->query("SELECT NISN, NAMA_LENGKAP, NIS, ID_SUB_KLS FROM SISWA	WHERE ID_SUB_KLS = '$ID_SubKelas'");

		$subKls = $this->SetSubKls();
		$NilaiKepribadian = $NilaiMapelModel->query("SELECT S.NIS, S.NISN, S.NAMA_LENGKAP, S.ID_SUB_KLS, NK.ASPEK_PENILAIAN, NK.NILAI_KEPRIBADIAN, NK.DESKRIPSI
		FROM SISWA S
		JOIN NILAI_KEPRIBADIAN NK
		ON NK.NISN = S.NISN
		WHERE ID_SEMESTER = $idSmt and S.ID_SUB_KLS = '$IdSubKls'");

		$i = $this->SetNamaSubKls();

		$data = [
			'title' => 'Nilai kepribadian | SDN Sidoketo',
			'NilaiKepribadian' => $NilaiKepribadian,
			'listSiswa' => $listSiswa,
			'dataSiswa' => $dataSiswa,
			// 'Mapel' => $this->SetMenu(),
			'KlikId' => $idSmt,
			'DataSemester' => $this->SetSmt(),
			'namaSubKls' => $i['NAMA_SUB_KELAS']

		];
		return view('Wali_Kelas/v_nilai_kepribadian', $data);
	}

	public function nilaiIns($insert)
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();

		if ($insert == "insKepribadian") {

			$NISN = $this->request->getVar('nisn1');
			$aspek = $this->request->getVar('aspek');

			$nilai = $this->request->getVar('nilai');
			$deskripsi = $this->request->getVar('deskripsi');
			$Semester = $this->request->getVar('smt');

			$cekInsert = $NilaiMapelModel->query("SELECT count(NISN)'tes' from NILAI_KEPRIBADIAN where NISN = '$NISN' and ID_SEMESTER = '$Semester'");

			foreach ($cekInsert->getResultArray() as $i) {
				if ($i['tes'] <= 0) {

					// dd("INSERT INTO NILAI_KEPRIBADIAN 
					// VALUES ('$NISN', '$Semester', '$aspek' , '$nilai', '$deskripsi');");

					$NilaiMapelModel->query("INSERT INTO NILAI_KEPRIBADIAN 
					VALUES ('$NISN', '$Semester', '$aspek' , '$nilai', '$deskripsi');");
				} else {
					session()->setFlashdata('pesan_insert2', 'nilai kepribadian sudah ada.');
				}
			}

			return redirect()->to("/wk/nilai_kepribadian/$Semester");
		} elseif ($insert == "insKesehatan") {

			$NISN = $this->request->getVar('nisn1');
			$berat = $this->request->getVar('berat');

			$tinggi = $this->request->getVar('tinggi');
			$pendengaran = $this->request->getVar('pendengaran');
			$penglihatan = $this->request->getVar('penglihatan');

			$gigi = $this->request->getVar('gigi');
			$Semester = $this->request->getVar('smt');

			$cekInsert = $NilaiMapelModel->query("SELECT count(NISN)'tes' from KESEHATAN where NISN = '$NISN' and ID_SEMESTER = '$Semester'");

			foreach ($cekInsert->getResultArray() as $i) {
				if ($i['tes'] <= 0) {

					if ($berat == null) {
						$berat = 'Data Kosong';
					}
					if ($tinggi == null) {
						$tinggi = 'Data Kosong';
					}
					if ($pendengaran == null) {
						$pendengaran = 'Data Kosong';
					}
					if ($penglihatan == null) {
						$penglihatan = 'Data Kosong';
					}
					if ($gigi == null) {
						$gigi = 'Data Kosong';
					}

					$NilaiMapelModel->query("INSERT INTO KESEHATAN 
					VALUES ('$NISN', '$Semester', '$berat' , '$tinggi', '$pendengaran', '$penglihatan', '$gigi');");
				} else {
					session()->setFlashdata('pesan_insert2', 'data nilai kesehatan siswa sudah ada.');
				}
			}

			return redirect()->to("/wk/nilai_kesehatan/$Semester");
		} elseif ($insert == "insAbsensi") {

			$NISN = $this->request->getVar('nisn1');
			$sakit = $this->request->getVar('sakit');

			$izin = $this->request->getVar('izin');
			$alpha = $this->request->getVar('alpha');
			$Semester = $this->request->getVar('smt');

			$cekInsert = $NilaiMapelModel->query("SELECT count(NISN)'tes' from ABSENSI where NISN = '$NISN' and ID_SEMESTER = '$Semester'");

			foreach ($cekInsert->getResultArray() as $i) {
				if ($i['tes'] <= 0) {

					if ($sakit == null) {
						$sakit = 0;
					}
					if ($izin == null) {
						$izin = 0;
					}
					if ($alpha == null) {
						$alpha = 0;
					}

					$NilaiMapelModel->query("INSERT INTO ABSENSI 
					VALUES ('$Semester', '$NISN', '$izin' , '$alpha', '$sakit');");
				} else {
					session()->setFlashdata('pesan_insert2', 'data absensi siswa sudah ada.');
				}
			}
			return redirect()->to("/wk/absensi/$Semester");
		} elseif ($insert == "insKesehatan") {

			$NISN = $this->request->getVar('nisn1');
			$berat = $this->request->getVar('berat');

			$tinggi = $this->request->getVar('tinggi');
			$pendengaran = $this->request->getVar('pendengaran');
			$penglihatan = $this->request->getVar('penglihatan');

			$gigi = $this->request->getVar('gigi');
			$Semester = $this->request->getVar('smt');

			$cekInsert = $NilaiMapelModel->query("SELECT count(NISN)'tes' from KESEHATAN where NISN = '$NISN' and ID_SEMESTER = '$Semester'");

			foreach ($cekInsert->getResultArray() as $i) {
				if ($i['tes'] <= 0) {

					if ($berat == null) {
						$berat = 'Data Kosong';
					}
					if ($tinggi == null) {
						$tinggi = 'Data Kosong';
					}
					if ($pendengaran == null) {
						$pendengaran = 'Data Kosong';
					}
					if ($penglihatan == null) {
						$penglihatan = 'Data Kosong';
					}
					if ($gigi == null) {
						$gigi = 'Data Kosong';
					}

					$NilaiMapelModel->query("INSERT INTO KESEHATAN 
					VALUES ('$NISN', '$Semester', '$berat' , '$tinggi', '$pendengaran', '$penglihatan', '$gigi');");
				} else {
					session()->setFlashdata('pesan_insert2', 'data nilai kesehatan siswa sudah ada.');
				}
			}

			return redirect()->to("/wk/nilai_kesehatan/$Semester");
		} elseif ($insert == "insMapel") {

			$NISN = $this->request->getVar('nisn1');
			$tugas = $this->request->getVar('tugas');
			$idmapel = $this->request->getVar('idmapel');

			$uts = $this->request->getVar('uts');
			$uas = $this->request->getVar('uas');
			$desc = $this->request->getVar('desc');
			$Semester = $this->request->getVar('smt');

			$cekInsert = $NilaiMapelModel->query("SELECT count(NISN)'tes' from NILAI where NISN = '$NISN' and ID_SEMESTER = '$Semester' and ID_DETAIL_MAPEL = '$idmapel'");

			foreach ($cekInsert->getResultArray() as $i) {
				if ($i['tes'] <= 0) {

					if ($tugas == null) {
						$tugas = 0;
					}
					if ($uts == null) {
						$uts = 0;
					}
					if ($uas == null) {
						$uas = 0;
					}
					if ($desc == null) {
						$desc = "";
					}

					//dd("$Semester', '$NISN', '$idmapel' , '$tugas', '$uts', '$uas', '$desc'");

					$NilaiMapelModel->query("INSERT INTO NILAI VALUES ('$Semester', '$NISN', '$idmapel' , '$tugas', '$uts', '$uas', '$desc');");
				} else {
					session()->setFlashdata('pesan_insert2', 'data nilai siswa sudah ada.');
				}
			}

			return redirect()->to("/wk/nilai_mapel/$idmapel/$Semester");
		}
	}

	public function nilaiKesehatan($Id_Smt)
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();

		$subKls = $this->SetSubKls();
		$ID_Kelas =  session()->get('ID_KLS');
		$DataSemester = $NilaiMapelModel->query("SELECT ID_SEMESTER From Semester where ID_KELAS =  '$ID_Kelas' ");

		$listSiswa = $NilaiMapelModel->query("SELECT NISN, NAMA_LENGKAP, NIS, ID_SUB_KLS FROM SISWA	WHERE ID_SUB_KLS = '$subKls'");

		$NilaiKesehatan = $NilaiMapelModel->query("SELECT S.NIS, S.NISN, S.NAMA_LENGKAP, S.ID_SUB_KLS, K.BERAT_BADAN, K.TINGGI_BADAN, K.PENDENGARAN, K.PENGELIHATAN, K.GIGI, K.ID_SEMESTER
		FROM SISWA S
		JOIN KESEHATAN K 
		ON K.NISN = S.NISN
		WHERE K.ID_SEMESTER =  $Id_Smt and S.ID_SUB_KLS = '$subKls'");

		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$Mapel = $NilaiMapelModel->query("SELECT * 
		FROM DETAIL_MAPEL");

		$i = $this->SetNamaSubKls();

		$data = [
			'title' => 'Data Siswa | SDN Sidoketo',
			'NilaiKesehatan' => $NilaiKesehatan,
			'listSiswa' => $listSiswa,
			'Mapel' => $Mapel,
			'KlikId' => $Id_Smt,
			'DataSemester' => $DataSemester,
			'namaSubKls' => $i['NAMA_SUB_KELAS']

		];
		return view('Wali_Kelas/v_nilai_kesehatan', $data);
	}

	public function laporan()
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();

		$namaSubKls = $this->SetNamaSubKls();
		$IdSubKls = session()->get('ID_SUB_KLS');
		$ID_Kelas =  session()->get('ID_KLS');

		$Mapel = $NilaiMapelModel->query("SELECT * 
		FROM DETAIL_MAPEL");

		$siswa = $NilaiMapelModel->query("SELECT *
		FROM SISWA
		WHERE ID_SUB_KLS = '$IdSubKls'");

		$DataSemester = $NilaiMapelModel->query("SELECT ID_SEMESTER From Semester where ID_KELAS =  '$ID_Kelas' ");

		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$namaMapel = $NilaiMapelModel->query("SELECT NAMA_MAPEL 
		FROM DETAIL_MAPEL");

		foreach ($namaMapel->getResultArray() as $O) {
		};

		$i = $this->SetNamaSubKls();

		$data = [
			'title' => 'Data Siswa | SDN Sidoketo',
			'Mapel' => $Mapel,
			'namaMapel' => $O['NAMA_MAPEL'],
			'siswa' => $siswa,
			'DataSemester' => $DataSemester,
			// 'namaSubKls' => $i['NAMA_SUB_KELAS']
			'namaSubKls' => $i['NAMA_SUB_KELAS']
		];
		return view('Wali_Kelas/v_laporan', $data);
	}

	public function laporan_param($idSmt, $idMapel)
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();

		$subKls = $this->SetSubKls();
		$ID_Kelas =  session()->get('ID_KLS');
		$DataSemester = $NilaiMapelModel->query("SELECT S.ID_SEMESTER
		From Semester S 
		where S.ID_KELAS =  '$ID_Kelas' ");

		$siswa = $NilaiMapelModel->query("SELECT *
		FROM SISWA
		WHERE ID_SUB_KLS = '$subKls'");

		foreach ($siswa as $key => $nisn) {
			# code...
		}

		$namaMapel = $NilaiMapelModel->query("SELECT NAMA_MAPEL 
		FROM DETAIL_MAPEL
		WHERE ID_DETAIL_MAPEL = '$idMapel';");

		foreach ($namaMapel->getResultArray() as $O) {
		};

		$NilaiMapel = $NilaiMapelModel->query("SELECT S.NIS, N.NISN, S.NAMA_LENGKAP, S.ID_SUB_KLS, N.TUGAS, N.UTS, N.UAS 
		FROM NILAI N
		JOIN SISWA S  
		ON N.NISN = S.NISN 
		WHERE S.ID_SUB_KLS = '$subKls' and ID_SEMESTER = '$idSmt' and ID_DETAIL_MAPEL = '$idMapel'");

		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$Mapel = $NilaiMapelModel->query("SELECT * 
		FROM DETAIL_MAPEL");

		$i = $this->SetNamaSubKls();

		$data = [
			'title' => 'Data Siswa | SDN Sidoketo',
			// 'NilaiKesehatan' => $NilaiKesehatan
			'Mapel' => $Mapel,
			'Mapel1' => $idMapel,
			'NilaiMapel' => $NilaiMapel,
			'KlikId' => $idSmt,
			'siswa' => $siswa,
			'namaMapel' => $O['NAMA_MAPEL'],
			'DataSemester' => $DataSemester,
			'namaSubKls' => $i['NAMA_SUB_KELAS']

		];

		return view('Wali_Kelas/v_laporan', $data);
	}

	public function SetSubKls()
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$ID_SubKelas =  session()->get('ID_SUB_KLS');
		return $ID_SubKelas;
	}

	public function SetNamaSubKls()
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$ID_SubKelas =  session()->get('ID_SUB_KLS');
		$NamaSubKls = $NilaiMapelModel->query("SELECT * From SUB_KELAS where ID_SUB_KLS =  '$ID_SubKelas' ");
		foreach ($NamaSubKls->getResultArray() as $i) {
		};
		return $i;
	}

	public function dashboard()
	{
		// dd(session()->get('ID_SUB_KLS'));
		$data = [
			'title' => 'Dahboa Siswa | SDN Sidoketo',
			// 'NilaiEkskul' => $NilaiEkskul,
			'Mapel' => $this->SetMenu(session()->get('ID_SUB_KLS'))
		];
		return view('Wali_Kelas/v_dashboard', $data);
	}

	public function SetMenu($idkelas)
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$Mapel = $NilaiMapelModel->query("SELECT pa.ID_DETAIL_MAPEL,NAMA_MAPEL
		FROM detail_mapel dm
		join paket_ajar pa
		on dm.ID_DETAIL_MAPEL = pa.ID_DETAIL_MAPEL
		WHERE pa.ID_KELAS = 'KLS_001'");
		return $Mapel;
	}

	public function SetSmt()
	{
		$NilaiMapelModel = new \App\Models\NilaiMapelModel();
		$ID_Kelas =  session()->get('ID_KLS');
		$DataSemester = $NilaiMapelModel->query("SELECT ID_SEMESTER From Semester where ID_KELAS =  '$ID_Kelas' ");
		return $DataSemester;
	}
	//--------------------------------------------------------------------

}
