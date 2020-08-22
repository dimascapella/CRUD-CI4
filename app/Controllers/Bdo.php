<?php

namespace App\Controllers;

use App\Models\BdoModel;
use Exception;

class Bdo extends BaseController
{
    protected $dataBdo;

    public function __construct()
    {
        $this->dataBdo = new BdoModel();
    }

    public function trigCreateButton()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('pages/createData', $data);
    }

    public function index()
    {
        $data = [
            'dataClass' => $this->dataBdo->getClass()
        ];
        return view('pages/detail', $data);
    }

    public function detailClass($slug)
    {
        $data = [
            'dataClass' => $this->dataBdo->getClass($slug)
        ];

        if (empty($data['dataClass'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Class' . $slug . 'Tidak Ditemukan!');
        }

        return view('pages/detailClasses', $data);
    }

    public function save()
    {

        if (!$this->validate([
            'name' => 'required|is_unique[bdodetails.name]'
        ])) {
            return redirect()->to('/Bdo/trigCreateButton')->withInput();
        }

        //get and move to folder
        $filePhoto = $this->request->getFile('photo');
        //if user doesn't upload photo
        if ($filePhoto->getError() == 4) {
            $namaFile = 'warrior.jpg';
        } else {
            //random name file if duplicate
            $namaFile = $filePhoto->getRandomName();
            $filePhoto->move('img', $namaFile);
        }

        // mengubah judul menjadi slug
        $slug = url_title($this->request->getVar('name'), '-', true);

        $this->dataBdo->save([
            'name' => $this->request->getVar('name'),
            'slug' => $slug,
            'photo' => $namaFile
        ]);

        return redirect()->to('/Bdo');
    }

    public function delete($id)
    {
        //delete image at memory
        $data = $this->dataBdo->find($id);
        if ($data['photo'] != 'warrior.jpg') {
            unlink('img/' . $data['photo']);
        }

        $this->dataBdo->delete($id);
        return redirect()->to('/Bdo');
    }

    public function edit($slug)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'Classes' => $this->dataBdo->getClass($slug)
        ];
        return view('pages/edit', $data);
    }

    public function update($id)
    {
        $oldName = $this->dataBdo->getClass($this->request->getVar('slug'));
        if ($oldName['name'] == $this->request->getVar('name')) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[bdodetails.name]';
        };

        if (!$this->validate([
            'name' => $rule
        ])) {
            return redirect()->to('/Bdo/edit/' . $this->request->getVar('slug'))->withInput();
        }

        //get and move to folder
        $filePhoto = $this->request->getFile('photo');
        //if user doesn't upload photo
        if ($filePhoto->getError() == 4) {
            $namaFile = $this->request->getVar('oldPhoto');
        } else {
            //random name file if duplicate
            $namaFile = $filePhoto->getRandomName();
            $filePhoto->move('img', $namaFile);
            unlink('img/' . $this->request->getVar('oldPhoto'));
        }

        $slug = url_title($this->request->getVar('name'), '-', true);

        $this->dataBdo->save([
            'id' => $id,
            'name' => $this->request->getVar('name'),
            'slug' => $slug,
            'photo' => $namaFile
        ]);

        return redirect()->to('/Bdo');
    }
}
