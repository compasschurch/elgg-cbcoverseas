<?php

class Cbcoverseas_Digest_Notifier {

    // We only notify this many users per hour to respect hosting rate limits.
    const USERS_PER_HOUR = 50;

    public function __construct(Evan_Email_Sender $mailer, Evan_Clock $clock, Evan_Db $db, Evan_Email_MessageFactory $emailFactory) {
        $this->mailer = $mailer;
        $this->clock = $clock;
        $this->db = $db;
        $this->emailFactory = $emailFactory;
    }
    
    public function hourly() {
        foreach ($this->getUsers() as $user) {
            $this->notify($user);
        }
    }
    
    /**
     * This returns a list of valid, least-recently-notified users.
     * 
     * "Valid" means:
     *  * Registered
     *  * Confirmed by an admin to not be spam.
     */
    private function getUsers() {
        return $this->db->getEntities(array(
            'type' => 'user',
            'order_by_metadata' => array(
                'name' => 'cbc_last_digest_time',
                'direction' => 'asc',
                'as' => 'integer',
            ),
            'limit' => self::USERS_PER_HOUR,
        ));
    }
        
    public function notify(ElggUser $user) {
        $email = $this->emailFactory->createForUser($user);
        
        if ($this->mailer->send($email)) {
            // Records the last time a digest was sent to the user.
            $user->cbc_last_digest_time = $this->clock->getTimestamp();
        }
    }
}