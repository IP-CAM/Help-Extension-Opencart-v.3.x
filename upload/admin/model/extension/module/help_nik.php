<?php
class ModelExtensionModuleHelpNik extends Model {
    public function install() {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "help_support` (
			`help_support_id` INT(11) NOT NULL AUTO_INCREMENT,
            `image` VARCHAR(255) NOT NULL,
            `sort_order` INT(11) NOT NULL,
			`status` TINYINT(1) NOT NULL DEFAULT 1,
			PRIMARY KEY (`help_support_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci");
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "help_support_description` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `help_support_id` INT(11) NOT NULL,
            `language_id` INT(11) NOT NULL,
            `title` VARCHAR(64) NOT NULL,
            `description` mediumtext NOT NULL,
            `link` VARCHAR(255) NOT NULL,
            PRIMARY KEY (`id`, `language_id`)
		) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "help_category` (
			`help_category_id` INT(11) NOT NULL AUTO_INCREMENT,
			`parent_id` INT(11) NOT NULL DEFAULT 0,
			`sort_order` INT(3) NOT NULL DEFAULT 0,
			`status` TINYINT(1) NOT NULL DEFAULT 1,
			PRIMARY KEY (`help_category_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci");
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "help_category_description` (
            `help_category_id` INT(11) NOT NULL,
            `language_id` INT(11) NOT NULL,
            `title` VARCHAR(64) NOT NULL,
            `description` mediumtext NOT NULL,
            `meta_title` VARCHAR(255) NOT NULL,
            `meta_description` VARCHAR(255) NOT NULL,
            `meta_keyword` VARCHAR(255) NOT NULL,
            PRIMARY KEY (`help_category_id`, `language_id`)
		) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;");
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "help_category_path` (
            `help_category_id` INT(11) NOT NULL AUTO_INCREMENT,
            `path_id` INT(11) NOT NULL,
            `level` INT(11) NOT NULL,
            PRIMARY KEY (`help_category_id`, `path_id`)
		) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;");
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "help_category_to_layout` (
            `help_category_id` INT(11) NOT NULL AUTO_INCREMENT,
            `store_id` INT(11) NOT NULL,
            `layout_id` INT(11) NOT NULL,
            PRIMARY KEY (`help_category_id`, `store_id`)
		) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;");
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "help_category_to_store` (
            `help_category_id` INT(11) NOT NULL AUTO_INCREMENT,
            `store_id` INT(11) NOT NULL,
            PRIMARY KEY (`help_category_id`, `store_id`)
		) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "help_article` (
			`help_article_id` INT(11) NOT NULL AUTO_INCREMENT,
			`help_category_id` INT(11) NOT NULL,
			`sort_order` INT(3) NOT NULL DEFAULT 0,
			`status` TINYINT(1) NOT NULL DEFAULT 1,
			PRIMARY KEY (`help_article_id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci");
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "help_article_description` (
            `help_article_id` INT(11) NOT NULL,
            `language_id` INT(11) NOT NULL,
            `title` VARCHAR(64) NOT NULL,
            `description` mediumtext NOT NULL,
            `meta_title` VARCHAR(255) NOT NULL,
            `meta_description` VARCHAR(255) NOT NULL,
            `meta_keyword` VARCHAR(255) NOT NULL,
            PRIMARY KEY (`help_article_id`, `language_id`)
		) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;");
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "help_article_to_layout` (
            `help_article_id` INT(11) NOT NULL AUTO_INCREMENT,
            `store_id` INT(11) NOT NULL,
            `layout_id` INT(11) NOT NULL,
            PRIMARY KEY (`help_article_id`, `store_id`)
		) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;");
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "help_article_to_store` (
            `help_article_id` INT(11) NOT NULL AUTO_INCREMENT,
            `store_id` INT(11) NOT NULL,
            PRIMARY KEY (`help_article_id`, `store_id`)
		) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;");

        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "help_settings` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `search_help_categories` TEXT NOT NULL,
            `display_help_categories` TEXT NOT NULL,
            PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;");
    }

    public function uninstall() {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "help_category`");
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "help_category_description`");
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "help_category_path`");
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "help_category_to_layout`");
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "help_category_to_store`");

        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "help_article`");
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "help_article_description`");
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "help_article_to_layout`");
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "help_article_to_store`");

        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "help_support`");
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "help_support_description`");

        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "help_settings`");
    }

    public function addHelpSupport($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "help_support SET `image` = '" . $this->db->escape($data['image']) . "', `sort_order` = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "'");

        $help_support_id = $this->db->getLastId();

        foreach ($data['help_support_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "help_support_description SET help_support_id = '" . (int)$help_support_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', `link` = '" . $this->db->escape($value['link']) . "'");
        }

        $this->cache->delete('help_support');

        return $help_support_id;
    }

    public function editHelpSupport($help_support_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "help_support SET `image` = '" . $this->db->escape($data['image']) . "', `sort_order` = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "' WHERE help_support_id = '" . $help_support_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "help_support_description WHERE help_support_id = '" . (int)$help_support_id . "'");

        foreach ($data['help_support_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "help_support_description SET help_support_id = '" . (int)$help_support_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', `link` = '" . $this->db->escape($value['link']) . "'");
        }

        $this->cache->delete('help_support');
    }

    public function deleteHelpSupport($help_support_id) {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "help_support` WHERE help_support_id = '" . (int)$help_support_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "help_support_description` WHERE help_support_id = '" . (int)$help_support_id . "'");

        $this->cache->delete('help_support');
    }

    public function getHelpSupport($help_support_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "help_support WHERE help_support_id = '" . (int)$help_support_id . "'");

        return $query->row;
    }

    public function getHelpSupportDescription($help_support_id) {
        $help_support_description_data = array();
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "help_support_description WHERE help_support_id = '" . (int)$help_support_id . "'");

        foreach ($query->rows as $result) {
            $help_support_description_data[$result['language_id']] = array(
                'title'            => $result['title'],
                'description'      => $result['description'],
                'link'       => $result['link']
            );
        }

        return $help_support_description_data;
    }

    public function getHelpSupports($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "help_support hs LEFT JOIN " . DB_PREFIX . "help_support_description hsd ON (hs.help_support_id = hsd.help_support_id) WHERE hsd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

        $sort_data = array(
            'hsd.title',
            'hs.sort_order'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY hsd.title";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function addHelpCategory($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "help_category SET parent_id = '" . (int)$data['parent_id'] . "', `sort_order` = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "'");

        $help_category_id = $this->db->getLastId();

        foreach ($data['help_category_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "help_category_description SET help_category_id = '" . (int)$help_category_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
        }

        // MySQL Hierarchical Data Closure Table Pattern
        $level = 0;

        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "help_category_path` WHERE help_category_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

        foreach ($query->rows as $result) {
            $this->db->query("INSERT INTO `" . DB_PREFIX . "help_category_path` SET `help_category_id` = '" . (int)$help_category_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");

            $level++;
        }

        $this->db->query("INSERT INTO `" . DB_PREFIX . "help_category_path` SET `help_category_id` = '" . (int)$help_category_id . "', `path_id` = '" . (int)$help_category_id . "', `level` = '" . (int)$level . "'");

        if (isset($data['help_category_store'])) {
            foreach ($data['help_category_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "help_category_to_store SET help_category_id = '" . (int)$help_category_id . "', store_id = '" . (int)$store_id . "'");
            }
        }

        // SEO URL
        if (isset($data['help_category_seo_url'])) {
            foreach ($data['help_category_seo_url'] as $store_id => $language) {
                foreach ($language as $language_id => $keyword) {
                    if (!empty($keyword)) {
                        $this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'help_category_id=" . (int)$help_category_id . "', keyword = '" . $this->db->escape($keyword) . "'");
                    }
                }
            }
        }

        if (isset($data['help_category_layout'])) {
            foreach ($data['help_category_layout'] as $store_id => $layout_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "help_category_to_layout SET help_category_id = '" . (int)$help_category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
            }
        }

        $this->cache->delete('help_category');

        return $help_category_id;
    }

    public function editHelpCategory($help_category_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "help_category SET parent_id = '" . (int)$data['parent_id'] . "', `sort_order` = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "' WHERE help_category_id = '" . (int)$help_category_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "help_category_description WHERE help_category_id = '" . (int)$help_category_id . "'");

        foreach ($data['help_category_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "help_category_description SET help_category_id = '" . (int)$help_category_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
        }

        // MySQL Hierarchical Data Closure Table Pattern
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "help_category_path` WHERE path_id = '" . (int)$help_category_id . "' ORDER BY `level` ASC");

        if ($query->rows) {
            foreach ($query->rows as $help_category_path) {
                // Delete the path below the current one
                $this->db->query("DELETE FROM `" . DB_PREFIX . "help_category_path` WHERE help_category_id = '" . (int)$help_category_path['help_category_id'] . "' AND `level` < '" . (int)$help_category_path['level'] . "'");

                $path = array();

                // Get the nodes new parents
                $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "help_category_path` WHERE help_category_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

                foreach ($query->rows as $result) {
                    $path[] = $result['path_id'];
                }

                // Get whats left of the nodes current path
                $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "help_category_path` WHERE help_category_id = '" . (int)$help_category_path['help_category_id'] . "' ORDER BY `level` ASC");

                foreach ($query->rows as $result) {
                    $path[] = $result['path_id'];
                }

                // Combine the paths with a new level
                $level = 0;

                foreach ($path as $path_id) {
                    $this->db->query("REPLACE INTO `" . DB_PREFIX . "help_category_path` SET help_category_id = '" . (int)$help_category_path['help_category_id'] . "', `path_id` = '" . (int)$path_id . "', `level` = '" . (int)$level . "'");

                    $level++;
                }
            }
        } else {
            // Delete the path below the current one
            $this->db->query("DELETE FROM `" . DB_PREFIX . "help_category_path` WHERE help_category_id = '" . (int)$help_category_id . "'");

            // Fix for records with no paths
            $level = 0;

            $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "help_category_path` WHERE help_category_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

            foreach ($query->rows as $result) {
                $this->db->query("INSERT INTO `" . DB_PREFIX . "category_path` SET help_category_id = '" . (int)$help_category_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");

                $level++;
            }

            $this->db->query("REPLACE INTO `" . DB_PREFIX . "category_path` SET help_category_id = '" . (int)$help_category_id . "', `path_id` = '" . (int)$help_category_id . "', `level` = '" . (int)$level . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "help_category_to_store WHERE help_category_id = '" . (int)$help_category_id . "'");

        if (isset($data['help_category_store'])) {
            foreach ($data['help_category_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "help_category_to_store SET help_category_id = '" . (int)$help_category_id . "', store_id = '" . (int)$store_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'help_category_id=" . (int)$help_category_id . "'");

        if (isset($data['help_category_seo_url'])) {
            foreach ($data['help_category_seo_url'] as $store_id => $language) {
                foreach ($language as $language_id => $keyword) {
                    if (trim($keyword)) {
                        $this->db->query("INSERT INTO `" . DB_PREFIX . "seo_url` SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'help_category_id=" . (int)$help_category_id . "', keyword = '" . $this->db->escape($keyword) . "'");
                    }
                }
            }
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "help_category_to_layout` WHERE help_category_id = '" . (int)$help_category_id . "'");

        if (isset($data['help_category_layout'])) {
            foreach ($data['help_category_layout'] as $store_id => $layout_id) {
                $this->db->query("INSERT INTO `" . DB_PREFIX . "help_category_to_layout` SET help_category_id = '" . (int)$help_category_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
            }
        }

        $this->cache->delete('help_category');
    }

    public function deleteHelpCategory($help_category_id) {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "help_category` WHERE help_category_id = '" . (int)$help_category_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "help_category_description` WHERE help_category_id = '" . (int)$help_category_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "help_category_to_store` WHERE help_category_id = '" . (int)$help_category_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "help_category_to_layout` WHERE help_category_id = '" . (int)$help_category_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "seo_url` WHERE query = 'help_category_id=" . (int)$help_category_id . "'");

        $this->cache->delete('help_category');
    }

    public function getHelpCategory($help_category_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "help_category WHERE help_category_id = '" . (int)$help_category_id . "'");

        return $query->row;
    }

    public function getHelpCategories($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "help_category hc LEFT JOIN " . DB_PREFIX . "help_category_description hcd ON (hc.help_category_id = hcd.help_category_id) WHERE hcd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

            if (!empty($data['filter_name'])) {
                $sql .= " AND hcd.title LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
            }

            $sort_data = array(
                'hcd.title',
                'hc.sort_order'
            );

            if (isset($data['help_category_id'])) {
                $sql .= " AND hc.help_category_id = '" . (int)$data['help_category_id'] . "'";
            }

            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
                $sql .= " ORDER BY hcd.title";
            }

            if (isset($data['order']) && ($data['order'] == 'DESC')) {
                $sql .= " DESC";
            } else {
                $sql .= " ASC";
            }


            if (isset($data['start']) || isset($data['limit'])) {
                if ($data['start'] < 0) {
                    $data['start'] = 0;
                }

                if ($data['limit'] < 1) {
                    $data['limit'] = 20;
                }

                $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
            }

            $query = $this->db->query($sql);

            return $query->rows;
        } else {
            $help_category_data = $this->cache->get('help_category.' . (int)$this->config->get('config_language_id'));

            if (!$help_category_data) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "help_category hc LEFT JOIN " . DB_PREFIX . "help_category_description hcd ON (hc.help_category_id = hcd.help_category_id) WHERE hcd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY hcd.title");

                $help_category_data = $query->rows;

                $this->cache->set('help_category.' . (int)$this->config->get('config_language_id'), $help_category_data);
            }

            return $help_category_data;
        }
    }

    public function getHelpCategoryDescription($help_category_id) {
        $help_category_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "help_category_description WHERE help_category_id = '" . (int)$help_category_id . "'");

        foreach ($query->rows as $result) {
            $help_category_description_data[$result['language_id']] = array(
                'title'            => $result['title'],
                'description'      => $result['description'],
                'meta_title'       => $result['meta_title'],
                'meta_description' => $result['meta_description'],
                'meta_keyword'     => $result['meta_keyword']
            );
        }

        return $help_category_description_data;
    }

    public function getHelpCategoryParent($help_category_id) {
        $query = $this->db->query("SELECT `title` FROM " . DB_PREFIX . "help_category_description WHERE help_category_id = '" . (int)$help_category_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

        return isset($query->row['title']) ? $query->row['title'] : '';
    }

    public function getHelpCategoryPath($help_category_id) {
        $query = $this->db->query("SELECT help_category_id, path_id, `level` FROM " . DB_PREFIX . "help_category_path WHERE help_category_id = '" . (int)$help_category_id . "'");

        return $query->rows;
    }

    public function getHelpCategoryStores($help_category_id) {
        $help_category_store_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "help_category_to_store WHERE help_category_id = '" . (int)$help_category_id . "'");

        foreach ($query->rows as $result) {
            $help_category_store_data[] = $result['store_id'];
        }

        return $help_category_store_data;
    }

    public function getHelpCategorySeoUrls($help_category_id) {
        $help_category_seo_url_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE query = 'help_category_id=" . (int)$help_category_id . "'");

        foreach ($query->rows as $result) {
            $help_category_seo_url_data[$result['store_id']][$result['language_id']] = $result['keyword'];
        }

        return $help_category_seo_url_data;
    }

    public function getHelpCategoryLayouts($help_category_id) {
        $help_category_layout_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "help_category_to_layout WHERE help_category_id = '" . (int)$help_category_id . "'");

        foreach ($query->rows as $result) {
            $help_category_layout_data[$result['store_id']] = $result['layout_id'];
        }

        return $help_category_layout_data;
    }

    public function getTotalHelpCategories() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "help_category");

        return $query->row['total'];
    }

    public function getTotalMaterialsCategoriesByLayoutId($layout_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "help_category_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

        return $query->row['total'];
    }

    public function saveHelpSettings($data) {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "help_settings`");

        $this->db->query("INSERT INTO " . DB_PREFIX . "help_settings SET `search_help_categories` = '" . $this->db->escape(json_encode($data['search_help_categories'])). "', `display_help_categories` = '" . $this->db->escape(json_encode($data['display_help_categories'])) . "'");
    }

    public function getHelpSettings() {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "help_settings`");

        return $query->row;
    }

    // Help Articles Functions

    public function addHelpArticle($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "help_article SET help_category_id = '" . (int)$data['help_category_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "'");

        $help_article_id = $this->db->getLastId();

        foreach ($data['help_article_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "help_article_description SET help_article_id = '" . (int)$help_article_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
        }

        if (isset($data['help_article_store'])) {
            foreach ($data['help_article_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "help_article_to_store SET help_article_id = '" . (int)$help_article_id . "', store_id = '" . (int)$store_id . "'");
            }
        }

        // SEO URL
        if (isset($data['help_article_seo_url'])) {
            foreach ($data['help_article_seo_url'] as $store_id => $language) {
                foreach ($language as $language_id => $keyword) {
                    if (!empty($keyword)) {
                        $this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'help_article_id=" . (int)$help_article_id . "', keyword = '" . $this->db->escape($keyword) . "'");
                    }
                }
            }
        }

        if (isset($data['help_article_layout'])) {
            foreach ($data['help_article_layout'] as $store_id => $layout_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "help_article_to_layout SET help_article_id = '" . (int)$help_article_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
            }
        }

        $this->cache->delete('help_article');

        return $help_article_id;
    }

    public function editHelpArticle($help_article_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "materials SET help_category_id = '" . (int)$data['help_category_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "' WHERE help_article_id = '" . (int)$help_article_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "help_article_description WHERE help_article_id = '" . (int)$help_article_id . "'");

        foreach ($data['help_article_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "help_article_description SET help_article_id = '" . (int)$help_article_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "help_article_to_store WHERE help_article_id = '" . (int)$help_article_id . "'");

        if (isset($data['help_article_store'])) {
            foreach ($data['materials_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "help_article_to_store SET help_article_id = '" . (int)$help_article_id . "', store_id = '" . (int)$store_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'help_article_id=" . (int)$help_article_id . "'");

        if (isset($data['help_article_seo_url'])) {
            foreach ($data['help_article_seo_url'] as $store_id => $language) {
                foreach ($language as $language_id => $keyword) {
                    if (trim($keyword)) {
                        $this->db->query("INSERT INTO `" . DB_PREFIX . "seo_url` SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'help_article_id=" . (int)$help_article_id . "', keyword = '" . $this->db->escape($keyword) . "'");
                    }
                }
            }
        }

        $this->db->query("DELETE FROM `" . DB_PREFIX . "help_article_to_layout` WHERE help_article_id = '" . (int)$help_article_id . "'");

        if (isset($data['help_article_layout'])) {
            foreach ($data['help_article_layout'] as $store_id => $layout_id) {
                $this->db->query("INSERT INTO `" . DB_PREFIX . "help_article_to_layout` SET help_article_id = '" . (int)$help_article_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
            }
        }

        $this->cache->delete('help_article');
    }

    public function deleteHelpArticle($help_article_id) {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "help_article` WHERE help_article_id = '" . (int)$help_article_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "help_article_description` WHERE help_article_id = '" . (int)$help_article_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "help_article_to_store` WHERE help_article_id = '" . (int)$help_article_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "help_article_to_layout` WHERE help_article_id = '" . (int)$help_article_id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "seo_url` WHERE query = 'help_article_id=" . (int)$help_article_id . "'");

        $this->cache->delete('help_article');
    }

    public function getHelpArticle($help_article_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "help_article WHERE help_article_id = '" . (int)$help_article_id . "'");

        return $query->row;
    }

    public function getHelpArticles($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "help_article ha LEFT JOIN " . DB_PREFIX . "help_article_description had ON (ha.help_article_id = had.help_article_id) WHERE had.language_id = '" . (int)$this->config->get('config_language_id') . "'";

            $sort_data = array(
                'had.title',
                'ha.sort_order'
            );

            if (isset($data['help_category_id'])) {
                $sql .= " AND ha.help_category_id = '" . (int)$data['help_category_id'] . "'";
            }

            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql .= " ORDER BY " . $data['sort'];
            } else {
                $sql .= " ORDER BY had.title";
            }

            if (isset($data['order']) && ($data['order'] == 'DESC')) {
                $sql .= " DESC";
            } else {
                $sql .= " ASC";
            }


            if (isset($data['start']) || isset($data['limit'])) {
                if ($data['start'] < 0) {
                    $data['start'] = 0;
                }

                if ($data['limit'] < 1) {
                    $data['limit'] = 20;
                }

                $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
            }

            $query = $this->db->query($sql);

            return $query->rows;
        } else {
            $help_articles_data = $this->cache->get('help_article.' . (int)$this->config->get('config_language_id'));

            if (!$help_articles_data) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "help_article ha LEFT JOIN " . DB_PREFIX . "help_article_description had ON (ha.help_article_id = had.help_article_id) WHERE had.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY had.title");

                $help_articles_data = $query->rows;

                $this->cache->set('help_article.' . (int)$this->config->get('config_language_id'), $help_articles_data);
            }

            return $help_articles_data;
        }
    }

    public function getHelpArticleDescriptions($help_article_id) {
        $help_article_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "help_article_description WHERE help_article_id = '" . (int)$help_article_id . "'");

        foreach ($query->rows as $result) {
            $help_article_description_data[$result['language_id']] = array(
                'title'            => $result['title'],
                'description'      => $result['description'],
                'meta_title'       => $result['meta_title'],
                'meta_description' => $result['meta_description'],
                'meta_keyword'     => $result['meta_keyword']
            );
        }

        return $help_article_description_data;
    }

    public function getHelpArticleStores($help_article_id) {
        $help_article_store_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "help_article_to_store WHERE help_article_id = '" . (int)$help_article_id . "'");

        foreach ($query->rows as $result) {
            $help_article_store_data[] = $result['store_id'];
        }

        return $help_article_store_data;
    }

    public function getHelpArticleSeoUrls($help_article_id) {
        $help_article_seo_url_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE query = 'help_article_id=" . (int)$help_article_id . "'");

        foreach ($query->rows as $result) {
            $help_article_seo_url_data[$result['store_id']][$result['language_id']] = $result['keyword'];
        }

        return $help_article_seo_url_data;
    }

    public function getHelpArticleLayouts($help_article_id) {
        $help_article_layout_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "help_article_to_layout WHERE help_article_id = '" . (int)$help_article_id . "'");

        foreach ($query->rows as $result) {
            $help_article_layout_data[$result['store_id']] = $result['layout_id'];
        }

        return $help_article_layout_data;
    }

    public function getTotalHelpArticles() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "help_article");

        return $query->row['total'];
    }

    public function getTotalHelpArticlesByLayoutId($layout_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "help_article_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

        return $query->row['total'];
    }
}