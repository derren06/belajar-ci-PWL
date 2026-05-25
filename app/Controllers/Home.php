<?php

namespace App\Controllers;

use App\Models\ProductModel; 

class Home extends BaseController
{
    protected $productModel;

    function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index(): string
    {
        return view('v_homepage', [
            'products' => $this->productModel->findAll()
        ]);
    }
}
