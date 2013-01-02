<?php

/**
 * This class is responsible for modifying user data such that
 * they can start receiving regular, personalized digest emails from
 * our system.
 */
class Cbcoverseas_Digest_EntityUpgrader {

    public function __construct(Evan_Db_Mysql $db) {
        $this->db = $db;
    }

    public function getQueryOptions() {
        $dbprefix = $this->db->getPrefix();
        
        $name_metastring_id = $this->db->addMetastring('cbc_last_digest_time');
        
        return array(
            'type' => 'user',
            'wheres' => array("NOT EXISTS (
                SELECT 1 FROM {$dbprefix}metadata md
                WHERE md.entity_guid = e.guid
                    AND md.name_id = $name_metastring_id)"),
        );
    }

    public function upgrade(ElggEntity $user) {
        if ($user->cbc_last_digest_time) {
            return;
        } else if ($user->last_login) {
            $user->cbc_last_digest_time = $user->last_login;
        } else {
            $two_weeks_ago = time() - 14 * 24 * 60 * 60;
            $user->cbc_last_digest_time = $two_weeks_ago;
        }
        
        // Not really necessary?
        $user->save();
    }
}