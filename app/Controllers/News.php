<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NewsModel;

/**
 * @property IncomingRequest $request 
 */

class News extends BaseController
{
    public function index()
    {
        $model = model(NewsModel::class);
        //get news with its default value (slug = false)
        $data = ['news' => $model->getNews(), 'title' => 'News archive'];
        
        return view('templates/header', $data) . view('news/overview') . view('templates/footer');
    }
    
    public function view($slug = null){
        $model = model(NewsModel:: class);
        //get news with slug input
        $data['news'] = $model->getNews($slug);
        
        if(empty($data['news'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'] . ' Title';
        return view('templates/header', $data) . view('news/view') . view('templates/footer');
    }

    public function create(){
        $model = model(NewsModel::class);

        if($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body' => 'required'
        ])) {
            $model->save([
                'title' => $this->request->getPost('title'),
                'slug' => url_title($this->request->getPost('title'), '=', true),
                'body' => $this->request->getPost('body')
            ]);

            return view('news/success');
        }

        return view('templates/header', ['title' => 'Create a news item']) . view('news/create') . view('templates/footer');
    } 
}
