<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use App\Controllers;

class CheckSession implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    // Periksa apakah pengguna sudah login
    // if (session()->get('user_data')) 
    // {
    //   if(session()->get('role_id') == 1)
    //   {
    //     header(route_to('superadmin_dashboard'));
    //     // return redirect()->route('superadmin_dashboard')->with('message', '<i class="bi bi-exclamation-circle"></i>&nbsp; Please login first.');
    //   }
    // } else {
    //   header(route_to('/'));
    // }
    //else if(empty(session()->has('user_data'))){

    //   return redirect()->to(site_url('/'))->with('error', '<i class="bi bi-exclamation-circle"></i>&nbsp; Please login first.');
    // }

    // Pengguna sudah login, lanjutkan eksekusi
    return $request;
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    
  }
}