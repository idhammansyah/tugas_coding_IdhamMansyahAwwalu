<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
  /**
   * Instance of the main Request object.
   *
   * @var CLIRequest|IncomingRequest
   */
  protected $request;
	
	protected $users, $log_activity, $token, $session, $validation, $menu, $sub_menu, $role, $calendar_events, $materials, $company, $department, $level, $location, $position, $contract, $jobs, $views, $menu_category, $items_data, $items_type, $items_transaction;

  protected $breadcrumb = [];

  /**
   * An array of helpers to be loaded automatically upon
   * class instantiation. These helpers will be available
   * to all other controllers that extend BaseController.
   *
   * @var array
   */
  protected $helpers = ['auth', 'routes'];

  /**
   * Be sure to declare properties for any property fetch you initialized.
   * The creation of dynamic property is deprecated in PHP 8.2.
   */
  // protected $session;

  /**
   * @return void
   */
  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    // Do Not Edit This Line
    parent::initController($request, $response, $logger);

    // Preload any models, libraries, etc, here.
    session();
    $this->CheckSession();

    // Ambil URI
    // $uri = service('uri');
    // $segment = $uri->getSegment($uri->getTotalSegments());

    // // Query database untuk mencari ID menu berdasarkan URL
    // $menuModel = new \App\Models\Authentication\Menu_Model();
    // $menu = $menuModel->where('url_link', $segment)->first();

    // if ($menu) {
    //   $menuId = $menu['menu_id'];
    //   $this->breadcrumb = generateBreadcrumb($menuId);
    // }
  }

  protected function CheckSession()
  {
    $sessions = session();
    // $uri = service('uri');
    // $segment = $uri->getSegment($uri->getTotalSegments());
    if(is_null($sessions->get('user_data')))
    {
      if (!$sessions->get('alert_shown')) {
        // Jika belum, tampilkan alert dan atur session flag
        echo "<script>alert('Your session is time out. Please login again!'); document.location='".route_to('/')."'</script>";
        $sessions->set('alert_shown', true);
        return redirect()->to('/')->with('message', 'You already sign out.');
      }
    }
  }

  public function checkFile()
  {
    $filePath = WRITEPATH . 'uploads/sample.txt'; // Path to the file you want to check

    if (is_file_exists($filePath)) {
      return 'File exists';
    } else {
      return 'File does not exist';
    }
  }


}