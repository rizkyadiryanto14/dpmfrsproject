<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KandidatModel;
use Config\Services;

/**
 * Get the request method.
 *
 * @param boolean $upper Whether to return in upper or lower case.
 *
 * @return string
 *
 * @deprecated The $upper functionality will be removed and this will revert to its PSR-7 equivalent
 */

class Kandidat extends BaseController
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var HTTP\IncomingRequest
	 */
	protected $request;
	public function index()
	{
		$data['title'] = 'Kandidat';

		return view('admin/kandidat/kandidat', $data);
	}

	public function add()
	{
		helper(['form']);
		$kandidatModel = new KandidatModel();

		$data['title'] = 'Tambah Kanditat';

		if ($this->request->getMethod() == 'post') {

			$rules = [
				'nama' 		=> 'required|alpha_space|min_length[2]',
				'visi'		=> 'required',
				'misi'		=> 'required',
				'avatar'	=> [
					'uploaded[avatar]',
					'mime_in[avatar,image/jpg,image/jpeg,image/png]',
					'max_size[avatar,2096]'
				]
			];

			if ($this->validate($rules)) {

				// upload file
				$file = $this->request->getFile('avatar');

				$uploadFile = $this->upload_avatar($file);

				if ($uploadFile != false) {
					$params = [
						'nama' 			=> esc($this->request->getPost('nama')),
						'visi'			=> esc($this->request->getPost('visi')),
						'misi'			=> esc($this->request->getPost('misi')),
						'avatar'		=> $uploadFile
					];

					$insert = $kandidatModel->insert($params);

					if ($insert) {
						session()->setFlashdata('success', 'Berhasil menambah data');
						return redirect()->route('admin/kandidat');
					} else {
						session()->setFlashdata('danger', 'Gagal menambah data');
						return redirect()->route('admin/kandidat/add')->withInput();
					}
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}

		return view('admin/kandidat/tambah_kandidat', $data);
	}

	private function upload_avatar($file)
	{
		$newName = $file->getRandomName();
		$upload = $file->move(ROOTPATH . 'public/assets/avatar', $newName);
		if ($upload) {
			return $newName;
		} else {
			return false;
		}
	}

	public function delete()
	{
		$kandidatModel = new KandidatModel();
		$id = $kandidatModel->escapeString(esc($this->request->getPost('id')));
		$getKandidat = $kandidatModel->find($kandidatModel->escapeString($id));

		if ($getKandidat) {
			$deleteFile = unlink('./assets/avatar/' . $getKandidat['avatar']);
			if ($deleteFile) {
				$delete = $kandidatModel->delete($id);
				if ($delete) {
					session()->setFlashdata('success', 'Berhasil menghapus data');
					return redirect()->route('admin/kandidat');
				} else {
					session()->setFlashdata('danger', 'Gagal menghapus data');
					return redirect()->route('admin/kandidat');
				}
			} else {
				session()->setFlashdata('danger', 'Gagal menghapus data');
				return redirect()->route('admin/kandidat');
			}
		} else {
			session()->setFlashdata('danger', 'Gagal menghapus data');
			return redirect()->route('admin/kandidat');
		}
	}

	public function edit()
	{
		helper(['form']);
		$kandidatModel = new KandidatModel();

		$id = $kandidatModel->escapeString(esc($this->request->uri->getSegment(4)));

		if ($this->request->getMethod() == 'post') {
			if ($_FILES['avatar']['name'] == "") {
				$rules = [
					'nama' 		=> 'required|alpha_space|min_length[2]',
					'visi'		=> 'required',
					'misi'		=> 'required'
				];
			} else {
				$rules = [
					'nama' 		=> 'required|alpha_space|min_length[2]',
					'visi'		=> 'required',
					'misi'		=> 'required',
					'avatar'	=> [
						'uploaded[avatar]',
						'mime_in[avatar,image/jpg,image/jpeg,image/png]',
						'max_size[avatar,4096]'
					]
				];
			}

			if ($this->validate($rules)) {
				if ($_FILES['avatar']['name'] == "") {
					$params = [
						'nama' 			=> $kandidatModel->escapeString(esc($this->request->getPost('nama'))),
						'visi'			=> $kandidatModel->escapeString(esc($this->request->getPost('visi'))),
						'misi'			=> $kandidatModel->escapeString(esc($this->request->getPost('misi'))),
					];
				} else {
					$getKandidat = $kandidatModel->find($id);

					if ($getKandidat) {
						$deleteFile = unlink('./assets/avatar/' . $getKandidat['avatar']);
						if ($deleteFile) {
							$file = $this->request->getFile('avatar');
							$uploadFile = $this->upload_avatar($file);
						}
					}

					$params = [
						'nama' 			=> $kandidatModel->escapeString(esc($this->request->getPost('nama'))),
						'visi'			=> $kandidatModel->escapeString(esc($this->request->getPost('visi'))),
						'misi'			=> $kandidatModel->escapeString(esc($this->request->getPost('misi'))),
						'avatar'		=> $uploadFile,
					];
				}

				$update = $kandidatModel->update($id, $params);

				if ($update) {
					session()->setFlashdata('success', 'Berhasil mengedit data');
					return redirect()->route('admin/kandidat');
				} else {
					session()->setFlashdata('danger', 'Gagal mengedit data');
					return redirect()->route('admin/kandidat/edit')->withInput();
				}
			} else {
				$data['validation'] = $this->validator;
			}
		}

		$data['kandidat'] = $kandidatModel->find($id);
		$data['title'] = 'Edit Kanditat';
		return view('admin/kandidat/edit_kandidat', $data);
	}

	public function get_kandidat_ajax()
	{
		$request = Services::request();
		$security = Services::security();
		$kandidat = new KandidatModel($request);

		if ($request->getMethod(true) == 'POST' && $request->isAJAX()) {
			$lists = $kandidat->get_datatables();
			$data = [];
			$no = (int) $request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];
				$row[] = $no;
				$row[] = esc($list->nama);
				$row[] = esc($list->visi);
				$row[] = esc($list->misi);
				$row[] = '<img alt="image" src="/assets/avatar/' . $list->avatar . '" width="200" data-toggle="tooltip" title="' . esc($list->nama) . '">';
				$row[] = $list->created_at;
				$row[] = '<a class="btn btn-warning" href="' . base_url('admin/kandidat/edit/' . $list->id_kandidat) . '">Edit</a> 
	                			<a class="btn btn-danger btn-delete" href="javascript:void(0)" data-id="' . $list->id_kandidat . '">Hapus</a>';
				$data[] = $row;
			}

			$output = [
				"draw" => (int) $request->getPost('draw'),
				"recordsTotal" => $kandidat->count_all(),
				"recordsFiltered" => $kandidat->count_filtered(),
				"data" => $data
			];
			$output['csrf'] = $security->getCSRFHash();

			echo json_encode($output);
		}
	}
}
