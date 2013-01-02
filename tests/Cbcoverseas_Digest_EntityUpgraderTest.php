<?php

class Cbcoverseas_Digest_EntityUpgraderTest extends PHPUnit_Framework_TestCase {

    function testSetsLastDigestToLastLoginIfAvailable() {
        
        $user = $this->getMock('ElggUser');
        
        $timestamp = time();
        
        $user->expects($this->any())
            ->method('__get')
            ->will($this->returnValueMap(array(
                array('cbc_last_digest_time', NULL),
                array('last_login', $timestamp),
            )));
                
        $user->expects($this->once())
            ->method('__set')
            ->with($this->equalTo('cbc_last_digest_time'),
                   $this->equalTo($timestamp));
            
        $db = $this->getMock('Evan_Db_Mysql');
        
        $upgrader = new Cbcoverseas_Digest_EntityUpgrader($db);
        
        $upgrader->upgrade($user);
    }

    function testGetQueryOptionsChecksForMetastrings() {
        $db = $this->getMock('Evan_Db_Mysql');
        
        // These need to be somewhat unique so we can test for their presence
        $db_prefix = 'custom123_';
        $metastring_id = 18345;
        
        $db->expects($this->once())
            ->method('getPrefix')
            ->will($this->returnValue($db_prefix));
            
        $db->expects($this->once())
            ->method('addMetastring')
            ->will($this->returnValue($metastring_id));
        
        $upgrader = new Cbcoverseas_Digest_EntityUpgrader($db);
        
        // Better way to test this without just reimplementing the function?
        
        $options = $upgrader->getQueryOptions();
        $this->assertContains("$db_prefix", $options['wheres'][0]);
        $this->assertContains("$metastring_id", $options['wheres'][0]);
    }
    
}