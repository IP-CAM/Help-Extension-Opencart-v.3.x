<?php
class ModelExtensionModuleHelpNik extends Model {
    public function getHelpSupports() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "help_support hs LEFT JOIN " . DB_PREFIX . "help_support_description hsd ON (hs.help_support_id = hsd.help_support_id) WHERE hsd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND hs.status = 1 ORDER BY hs.sort_order ASC");

        return $query->rows;
    }
}