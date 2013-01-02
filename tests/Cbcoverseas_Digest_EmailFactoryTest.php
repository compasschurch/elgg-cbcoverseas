<?php

class Cbcoverseas_Digest_EmailFactoryTest extends PHPUnit_Framework_TestCase {

    function testCreateForUser() {
        $clock = new Evan_MockClock('2013-01-05');
        $site = $this->getMock('ElggSite');
        $views = $this->getMock('Evan_ViewService');
        $db = $this->getMock('Evan_Db');
        $i18n = $this->getMock('Evan_I18n');

        $factory = new Cbcoverseas_Digest_EmailFactory($clock, $site, $views, $db, $i18n);
        
        $user = $this->getMock('ElggUser');
        
        $db->expects($this->exactly(2))
            ->method('getEntities')
            ->will($this->returnCallback(function($options) {
                switch ($options['subtype']) {
                    case 'blog':
                        return 193587;
                    case 'image':
                        return 897893;
                    default:
                        throw new Exception("Unexpected subtype");
                }
            }));
        
        // Check to make sure we're tweaking permissions correctly
        $db->expects($this->exactly(2))
            ->method('setUser');
        
        $views->expects($this->once())
            ->method('view')
            ->with(
                $this->equalTo('cbcoverseas/digest.en'),
                $this->equalTo(array(
                    'blogs' => 193587,
                    'photos' => 897893,
                    'site' => $site,
                    'user' => $user,
                )),
                $this->equalTo('email'))
            ->will($this->returnValue('activity summary'));
        
        $i18n->expects($this->once())
            ->method('translate')
            ->with(
                $this->anything(),
                array('Jan 5, 2013'),
                $this->anything());
        
        $this->assertNotNull($factory->createForUser($user));
        
    }

}