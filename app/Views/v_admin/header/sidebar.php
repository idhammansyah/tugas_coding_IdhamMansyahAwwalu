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

      // Fetch categories first
      $categoryQuery = $db->query('SELECT * FROM user_menu_category WHERE id_role = ' . $role_id . ' AND is_active = 1 ORDER BY urutan ASC');
      $categories = $categoryQuery->getResultArray();

      // Initialize an array to store menu items grouped by category
      $groupedMenus = array();

      foreach ($categories as $category) {
        $category_id = $category['id_menu_category'];
        $query = $db->query('SELECT * FROM user_menu WHERE is_active = 1 AND id_role = ' . $role_id . ' AND posisi = "sidebar" AND id_menu_category = ' . $category_id . ' ORDER BY urutan ASC');
        $menu = $query->getResultArray();

        // Group submenus by id_menu within each category
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

        // Store the menus and their submenus grouped by category
        $groupedMenus[$category_id] = [
          'category_name' => $category['nama_menu_category'],
          'deskripsi'   => $category['deskripsi'],
          'menus' => $menu,
          'submenus' => $groupedSubmenus
        ];
      }

      $currentUrl = current_url(true);

      foreach ($groupedMenus as $group) :
    ?>
      <li class="nav-heading"><?= $group['category_name'] ?></li>
      <?php foreach ($group['menus'] as $m) :
        $id_menu = $m['menu_id'];

        // Check if the current URL matches the menu or any submenu URL
        $isMenuActive = $currentUrl == base_url($m['url_link']);
        $isSubMenuActive = false;

        if (array_key_exists($id_menu, $group['submenus'])) {
          foreach ($group['submenus'][$id_menu] as $submen) {
            if ($currentUrl == base_url($submen['url_link'])) {
              $isSubMenuActive = true;
              break;
            }
          }
        }
      ?>
        <?php if (array_key_exists($id_menu, $group['submenus'])) : ?>
          <li class="nav-item">
            <a class="nav-link <?= ($isSubMenuActive) ? '' : 'collapsed' ?>" data-bs-target="#components-nav-<?= $m['menu_id'] ?>" data-bs-toggle="collapse" href="#">
              <i class="<?= $m['icons'] ?>"></i><span><?= $m['menu_name'] ?></span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav-<?= $m['menu_id']?>" class="nav-content collapse <?= ($isSubMenuActive) ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
              <?php foreach ($group['submenus'][$id_menu] as $submen) : ?>
                <li class="nav-item">
                  <a href="<?= base_url($submen['url_link'])?>" class="nav-link <?= ($currentUrl == base_url($submen['url_link'])) ? 'active' : '' ?>">
                    <i class="<?= $submen['icons'] ?>" style="font-size:12pt;"></i><span><?= $submen['sub_menu_name'] ?></span>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link <?= ($isMenuActive) ? 'active' : '' ?>" href="<?= base_url($m['url_link']) ?>">
              <i class="<?= $m['icons'] ?>"></i>
              <span><?= $m['menu_name'] ?></span>
            </a>
          </li>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endforeach; ?>
  </ul>
</aside>
<!-- End Sidebar-->
