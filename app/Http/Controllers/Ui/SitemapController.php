<?php

namespace App\Http\Controllers\Ui;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;

class SitemapController extends Controller
{
  public function index()
  {
    return response()->view('ui.sitemap.index')->header('Content-Type', 'text/xml');
  }
}
