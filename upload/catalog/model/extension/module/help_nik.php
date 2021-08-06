<?php
class ModelExtensionModuleHelpNik extends Model {
    public function getHelpSupports() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "help_support hs LEFT JOIN " . DB_PREFIX . "help_support_description hsd ON (hs.help_support_id = hsd.help_support_id) WHERE hsd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND hs.status = 1 ORDER BY hs.sort_order ASC");

        return $query->rows;
    }

    public function getHelpCategory($help_category_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "help_category hc LEFT JOIN " . DB_PREFIX . "help_category_description hcd ON (hc.help_category_id = hcd.help_category_id) LEFT JOIN " . DB_PREFIX . "help_category_to_store hc2s ON (hc.help_category_id = hc2s.help_category_id) WHERE hc.help_category_id = '" . (int)$help_category_id . "' AND hcd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND hc2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND hc.status = '1'");

        return $query->row;
    }

    public function getHelpSettings() {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "help_settings`");

        return $query->row;
    }

    public function getHelpCategories() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "help_category hc LEFT JOIN " . DB_PREFIX . "help_category_description hcd ON (hc.help_category_id = hcd.help_category_id) LEFT JOIN " . DB_PREFIX . "help_category_to_store hc2s ON (hc.help_category_id = hc2s.help_category_id) WHERE hcd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND hc2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND hc.status = '1' ORDER BY hc.sort_order, LCASE(hcd.title)");

        return $query->rows;
    }

    public function getHelpArticles($parent_id = 0) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "help_article ha LEFT JOIN " . DB_PREFIX . "help_article_description had ON (ha.help_article_id = had.help_article_id) LEFT JOIN " . DB_PREFIX . "help_article_to_store ha2s ON (ha.help_article_id = ha2s.help_article_id) WHERE ha.help_category_id = '" . (int)$parent_id . "' AND had.language_id = '" . (int)$this->config->get('config_language_id') . "' AND ha2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND ha.status = '1' ORDER BY ha.sort_order, LCASE(had.title)");

        return $query->rows;
    }
}