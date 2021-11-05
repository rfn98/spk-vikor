<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataalternatif extends CI_Controller {
    public function index() {
		$headerNormalize = new StdClass();
		$headerWeight = new StdClass();
		$list = $this->db->query("SELECT nama_kriteria, round(sqrt(sum(nilai_rating*nilai_rating)), 2) detail FROM `alternatif_detail` ad join m_subkriteria ms on ms.id_subkriteria = ad.id_sub_kriteria join m_alternatif ma on ma.id_alternatif = ad.id_alternatif join m_kriteria mk on mk.id_kriteria = ad.id_kriteria group by 1")->result();
		$listWeight = $this->db->get('m_kriteria')->result();
		foreach ($list as $k => $v) $headerNormalize->{$v->nama_kriteria} = $v->detail;
		foreach ($listWeight as $k => $v) $headerWeight->{$v->nama_kriteria} = $v->bobot_kriteria;
		$this->load->view('Headerv');
		$this->load->view('Footerv');
		$this->load->view('Dataalternatifv', [
			'header' => $this->db->query("SELECT * FROM m_kriteria WHERE id_kriteria IN (SELECT id_kriteria FROM alternatif_detail)")->result(),
			'listAlternatif' => $this->db->query("
				SELECT 
					ad.id_alternatif, nama_alternatif, kd_alternatif, CONCAT ('{', GROUP_CONCAT('\"', nama_kriteria, '\"', ':', '\"', 
					CASE WHEN is_range = 0 THEN nama_subkriteria eLse nilai_alternatif END, '\"'), '}') detail 
				FROM alternatif_detail ad 
				INNER JOIN m_subkriteria ms ON ms.id_subkriteria = ad.id_sub_kriteria 
				INNER JOIN m_alternatif ma ON ma.id_alternatif = ad.id_alternatif 
				INNER JOIN m_kriteria mk ON mk.id_kriteria = ad.id_kriteria 
				GROUP BY 1, 2, 3")->result(),
			'listSubKriteria' => $this->db->query("
				SELECT 
					ms.id_kriteria, mk.nama_kriteria, is_range, CONCAT(
					'[', GROUP_CONCAT('{', '\"value\":', id_subkriteria, ',', '\"name\":', '\"', nama_subkriteria, '\"', '}'), ']'
					) list
				FROM m_subkriteria ms 
				INNER JOIN m_kriteria mk ON mk.id_kriteria = ms.id_kriteria 
				GROUP BY 1, 2, 3")->result(),
			'listMatrixDecision' => $this->db->query("
				SELECT 
					ad.id_alternatif, nama_alternatif, CONCAT('{', GROUP_CONCAT('\"', nama_kriteria, '\"', ':', '\"', nilai_rating, '\"'), '}') detail 
				FROM alternatif_detail ad 
				INNER JOIN m_subkriteria ms ON ms.id_subkriteria = ad.id_sub_kriteria 
				INNER JOIN m_alternatif ma ON ma.id_alternatif = ad.id_alternatif 
				INNER JOIN m_kriteria mk ON mk.id_kriteria = ad.id_kriteria 
				GROUP BY 1,2")->result(),
			'headerNormalize' => $headerNormalize,
			'headerWeight' => $headerWeight
		]);
	}

	public function insert() {
		$id = null;
		$insert = null;
		$is_update = false;
		if ($_POST['id_alternatif']) {
			$this->db->where('id_alternatif', $_POST['id_alternatif'])
			->update('m_alternatif', [
				'kd_alternatif' => $_POST['kd_alternatif'], 
				'nama_alternatif' => $_POST['nama_alternatif']
			]);
			$id = $_POST['id_alternatif'];
			$is_update = true;
		} else {
			$insert = $this->db->insert('m_alternatif', ['kd_alternatif' => $_POST['kd_alternatif'], 'nama_alternatif' => $_POST['nama_alternatif']]);
			$id = $this->db->insert_id();
		}
		unset($_POST['id_alternatif']);
		unset($_POST['kd_alternatif']);
		unset($_POST['nama_alternatif']);
		foreach($_POST as $k => $v) {
			$exp = explode('-', $k);
			// var_dump(count($exp) > 0 ? $v : $k);
			$query = "SELECT id_subkriteria FROM m_subkriteria ms 
				INNER JOIN m_kriteria mk ON mk.id_kriteria = ms.id_kriteria 
				WHERE is_range = 1 AND ";
			$query .= count($exp) > 0 ? $v : $k;
			$query .= " BETWEEN SUBSTRING_INDEX(
				SUBSTR(REGEXP_REPLACE(REGEXP_REPLACE(nama_subkriteria, '[^0-9a-zA-Z ]', ''), '[^0-9]+', '-'), 2), '-', 1) 
				AND SUBSTRING_INDEX(substr(REGEXP_REPLACE(REGEXP_REPLACE(nama_subkriteria, '[^0-9a-zA-Z ]', ''), '[^0-9]+', '-'), 2), '-', -1)
			";
			$sub_kriteria = $this->db->query($query)->result();
			$insertDetail = $this->db->insert('alternatif_detail', [
				'id_alternatif' => $id, 
				'id_kriteria' => (int)str_replace('nilai_alternatif-', '', $k), 
				'id_sub_kriteria' => count($sub_kriteria) > 0 ? $sub_kriteria[0]->id_subkriteria : $v,
				'nilai_alternatif' => strpos($k, 'nilai') === false ? null : $v
			]);
			$updateDetail = $this->db->where(['id_alternatif' => $id, 'id_kriteria' => (int)str_replace('nilai_alternatif-', '', $k)])
				->update('alternatif_detail', [
				'id_sub_kriteria' => count($sub_kriteria) > 0 ? $sub_kriteria[0]->id_subkriteria : $v,
				'nilai_alternatif' => strpos($k, 'nilai') === false ? null : $v
			]);
			$checkAlternatifDetail = $this->db->get_where('alternatif_detail', ['id_alternatif' => $id, 'id_kriteria' => (int)str_replace('nilai_alternatif-', '', $k)])->result();
			if (!$is_update) $insert_detail; 
			else count($checkAlternatifDetail) ? $updateDetail : $insertDetail;
		}

		$this->showAlert('Alternatif', $is_update ? 'ubah' : 'simpan');

		// return redirect('Dataalternatif');
		// var_dump($_POST);
	}

	public function delete() {
		$this->db->where('id_alternatif', $_POST['id_alternatif'])->delete('alternatif_detail');
		$this->db->where('id_alternatif', $_POST['id_alternatif'])->delete('m_alternatif');
		$this->showAlert('Alternatif', 'hapus');
	}

	public function getAlternatifDetail($id_alternatif) {
		echo json_encode($this->db->get_where('alternatif_detail', ['id_alternatif' => $id_alternatif])->result());
	}

	public function showAlert($entity, $action) {
		echo "
		<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
		<script type='text/javascript'>
			setTimeout(() => Swal.fire({
				title: 'Data {$entity} Berhasil Di{$action}!',
				icon: 'success'
			}).then((result) => {
				if (result.isConfirmed) window.location = 'http://localhost/spk/Dataalternatif'
			}), 500)
		</script>";
	}
}
?>