<?php

namespace Cbcoverseas\Digest;

use Evan\Time\MockClock;
use PHPUnit_Framework_TestCase as TestCase;

class EmailFactoryTest extends TestCase {

    function setUp() {
        $this->clock = new MockClock('2013-01-05');
        $this->site = $this->getMockBuilder('ElggSite')->disableOriginalConstructor()->getMock();
        $this->views = $this->getMock('Evan\Viewer');
        $this->db = $this->getMock('Evan\Storage\Db');
        $this->i18n = $this->getMock('Evan\I18n\Translator');
        
        // The object under test
        $this->factory = new EmailFactory(
            $this->clock, $this->site, $this->views, $this->db, $this->i18n);

        
        $this->user = $this->getMockBuilder('ElggUser')->disableOriginalConstructor()->getMock();
    }

    function testCreateForUser() {

        $this->db->expects($this->exactly(2))
            ->method('getEntities')
            ->will($this->returnCallback(function($options) {
                switch ($options['subtype']) {
                    case 'blog':
                        return 193587;
                    case 'image':
                        return 897893;
                    default:
                        throw new \Exception("Unexpected subtype");
                }
            }));
        
        // Check to make sure we're tweaking permissions correctly
        $this->db->expects($this->exactly(2))
            ->method('setUser');
        
        $this->views->expects($this->once())
            ->method('view')
            ->with(
                $this->equalTo('cbcoverseas/digest.en'),
                $this->equalTo(array(
                    'blogs' => 193587,
                    'photos' => 897893,
                    'site' => $this->site,
                    'user' => $this->user,
                )),
                $this->equalTo('email'))
            ->will($this->returnValue('activity summary'));
        
        $this->i18n->expects($this->once())
            ->method('translate')
            ->with(
                $this->anything(),
                array('Jan 5, 2013'),
                $this->anything());
 
        // Ensure that last digest time is initialized to last login if available.
        $timestamp = $this->clock->getTimestamp();
        $last_login = $timestamp - 6000;
        $this->user->expects($this->atLeastOnce())
            ->method('__get')
            ->will($this->returnValueMap(array(
                array('cbc_last_digest_time', NULL),
                array('last_login', $last_login),
            )));
                
        $this->user->expects($this->exactly(2))
            ->method('__set')
            ->will($this->returnValueMap(array(
                array('cbc_last_digest_time', $last_login, NULL),
                array('cbc_last_digest_time', $timestamp, NULL),
            )));
        
        $this->assertNotNull($this->factory->createForUser($this->user));
        
    }
    
    /**
     * 1. user A last logged in a few hours ago.
     * 2. user B sends user A a private message.
     * 3. Run the digest
     * 4. Check that user A is sent a digest with exactly 1 unread message.
     */
    public function testDigestEmailIncludesUnreadPrivateMessages() {
        $this->markTestIncomplete('Requires manual testing for now');
    }
    
    /**
     * 1. user A last logged in a few hours ago.
     * 2. user B uploads a new photo.
     * 3. Run the digest.
     * 4. Check that user A is sent a digest email with exactly 1 new photo.
     */
    public function testDigestEmailIncludesUnseenPhotoUploads() {
        $this->markTestIncomplete('Requires manual testing for now');
    }
    
    /**
     * 1. user A last logged in a few hours ago.
     * 2. user B posts a blog.
     * 3. Run the digest
     * 4. Check that user A is sent a digest email with exactly 1 new blog.
     */
    public function testDigestEmailIncludesUnreadBlogPosts() {
        $this->markTestIncomplete('Requires manual testing for now');
    }

}