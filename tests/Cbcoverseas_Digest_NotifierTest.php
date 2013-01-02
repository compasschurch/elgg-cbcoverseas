<?php

class Cbcoverseas_Digest_NotifierTest extends PHPUnit_Framework_TestCase {

    function testUpdatesLastDigestTimeOnSuccess() {
        $mailer = new Evan_Email_NullSender(); 
        $clock = new Evan_MockClock();
        $db = $this->getMock('Evan_Db');
        $emailFactory = new Evan_Email_BlankMessageFactory();

        $notifier = new Cbcoverseas_Digest_Notifier($mailer, $clock, $db, $emailFactory);
        
        $user = $this->getMock('ElggUser');

        $db->expects($this->once())
            ->method('getEntities')
            ->will($this->returnValue(array($user)));
        
        // This is the primary expectation -- to update the user's metadata
        $user->expects($this->once())
            ->method('__set')
            ->with('cbc_last_digest_time', $clock->getTimestamp());

        $notifier->hourly();
    }

}