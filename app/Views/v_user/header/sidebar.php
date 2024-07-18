  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <?php
        $db = \Config\Database::connect();
        $sessions = session()->get('user_data');
        if (empty($sessions)) {
          session()->setFlashdata('error', 'Please login first!');
          return redirect()->to('/');
        }

        $role_id = $sessions['role_id'];
        $query = $db->query('SELECT * FROM user_menu where is_active = 1 AND id_role = ' . $role_id . ' AND posisi = "sidebar" ORDER BY urutan ASC');
        $menu = $query->getResultArray();

        // Create an associative array to group submenus by id_menu
        $groupedSubmenus = array();

        foreach ($menu as $m) {
          $id_menu = $m['menu_id'];
          $query_sub = $db->query('SELECT * FROM user_sub_menu WHERE menu_id = ' . $id_menu . ' AND is_active = 1 AND id_role = ' . $role_id . ' ORDER BY urutan, sub_menu_name ASC');

          if ($query_sub->getNumRows() > 0) {
            $menu_sub = $query_sub->getResultArray();

            foreach ($menu_sub as $submen) {
              $groupedSubmenus[$id_menu][] = $submen;
            }
          }
        }

        $currentUrl = current_url(true)->setPath(base_url(uri_string()));
        // (uri_string() == base_url($m['url_link'])) ? 'activate' : ''

        foreach ($menu as $m) :
        $id_menu = $m['menu_id'];
      ?>
        <?php if (array_key_exists($id_menu, $groupedSubmenus)) : ?>
          <li class="nav-heading"><?= $m['menu_name']?></li>
          <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav-<?= $m['menu_id'] ?>" data-bs-toggle="collapse"
              href="<?= base_url($m['url_link']) ?>">
              <i class="<?= $m['icons'] ?>"></i><span><?= $m['menu_name'] ?></span><i
                class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav-<?= $m['menu_id']?>" class="nav-content collapse" data-bs-parent="#sidebar-nav">
              <?php foreach ($groupedSubmenus[$id_menu] as $submen) : ?>
                <li class="nav-item">
                  <a href="<?= base_url($submen['url_link'])?>" class="nav-link">
                    <i class="<?= $submen['icons'] ?>" style="font-size:12pt;"></i><span><?= $submen['sub_menu_name'] ?></span>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url($m['url_link']) ?>">
            <i class="<?= $m['icons'] ?>"></i>
            <span><?= $m['menu_name'] ?></span>
            </a>
          </li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>

  </aside><!-- End Sidebar-->