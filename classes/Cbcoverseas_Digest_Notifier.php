<?php

class Cbcoverseas_Digest_Notifier {

    // We only notify this many users per hour to respect hosting rate limits.
    const USERS_PER_HOUR = 50;
    
    const LAST_NOTIFIED_METADATA = 'cbc_last_digest_time';

    public function __construct(Evan_Email_Sender $mailer, Evan_Clock $clock, Evan_Db_Mysql $db, Evan_Email_MessageFactory $emailFactory) {
        $this->mailer = $mailer;
        $this->clock = $clock;
        $this->db = $db;
        $this->emailFactory = $emailFactory;
    }
    
    /**
     * This is the main entry-point function
     * 
     * @param int $limit The maximum number of users to notify.
     */
    public function sendDigests($limit) {
        foreach ($this->getUsers($limit) as $user) {
            $this->notify($user);
        }
    }
    
    /**
     * @param int $limit The maximum number of users to return.
     * 
     * @return ElggUser[] A list of users to send the digest to.
     */
    private function getUsers($limit) {
        $users = $this->getNeverNotifiedUsers($limit);
        
        // If we have leftover quota, use it on the least recently notified users.
        $limit -= count($users);
        if ($limit > 0) {
            $users = array_merge($users, $this->getLeastRecentlyNotifiedUsers($limit));
        }
        
        return $users;
    }
    
    /**
     * @param int $limit The maximum number of users to return.
     * 
     * @return ElggUser[] A list of users that have never been sent this digest.
     */
    private function getNeverNotifiedUsers($limit) {
        $dbprefix = $this->db->getPrefix();
        $name_metastring_id = $this->db->addMetastring('cbc_last_digest_time');

        return $this->db->getEntities(array(
            'type' => 'user',
            'wheres' => array("NOT EXISTS (
                SELECT 1 FROM {$dbprefix}metadata md
                WHERE md.entity_guid = e.guid
                    AND md.name_id = $name_metastring_id)"),
            'limit' => $limit,
        ));
    }
    
    /**
     * @param int $limit The maximum number of users to return.
     * 
     * @return ElggUser[] A list of users that have least-recently received the digest.
     */
    private function getLeastRecentlyNotifiedUsers($limit) {
        $this->db->getEntities(array(
            'type' => 'user',
            'order_by_metadata' => array(
                'name' => 'cbc_last_digest_time',
                'direction' => 'asc',
                'as' => 'integer',
            ),
            'limit' => $limit,
        ));
    }
        
    public function notify(ElggUser $user) {
        $email = $this->emailFactory->createForUser($user);
        
        if ($email && $this->mailer->send($email)) {
            // Records the last time a digest was sent to the user.
            $user->cbc_last_digest_time = $this->clock->getTimestamp();
        }
    }
}