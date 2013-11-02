<?php

namespace Symfony\Cmf\Bundle\RoutingAutoBundle\Tests\Unit\AutoRoute\PathProvider;

use Symfony\Cmf\Bundle\RoutingAutoBundle\AutoRoute\PathExists\PathProvider;
use Symfony\Cmf\Bundle\RoutingAutoBundle\AutoRoute\PathProvider\ContentObjectProvider;
use Doctrine\ODM\PHPCR\ReferrersCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Cmf\Bundle\RoutingAutoBundle\AutoRoute\PathProvider\LocaleProvider;

class LocaleProviderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->builderContext = $this->getMock(
            'Symfony\Cmf\Bundle\RoutingAutoBundle\AutoRoute\BuilderContext'
        );
        $this->routeStack = $this->getMockBuilder(
            'Symfony\Cmf\Bundle\RoutingAutoBundle\AutoRoute\RouteStack'
        )->disableOriginalConstructor()->getMock();


        $this->provider = new LocaleProvider();
    }

    /**
     * @expectedException RuntimeException
     */
    public function testProvidePathNoLocale()
    {
        $this->routeStack->expects($this->once())
            ->method('getContext')
            ->will($this->returnValue($this->builderContext));
        $this->provider->providePath($this->routeStack);
    }

    public function testProvidePath()
    {
        $this->routeStack->expects($this->once())
            ->method('getContext')
            ->will($this->returnValue($this->builderContext));
        $this->builderContext->expects($this->once())
            ->method('getLocale')
            ->will($this->returnValue('fr'));

        $this->routeStack->expects($this->once())
            ->method('addPathElements')
            ->with(array('fr'));

        $res = $this->provider->providePath($this->routeStack);
    }
}

