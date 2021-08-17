<?php

namespace MylSoft\EcologicalMaterials\Test\Unit\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use PHPUnit\Framework\TestCase;
use MylSoft\EcologicalMaterials\Helper\Config;

class ConfigTest extends TestCase {

  private Config $object;

  protected function setUp(): void {
    $contextMock = $this->getMockBuilder(Context::class)
      ->disableOriginalConstructor()
      ->getMock();

    $this->object = new Config($contextMock);
  }

  public function testConfigInstance() {
    $this->assertInstanceOf(Config::class, $this->object);
  }

  public function testExtendsAbstractHelper() {
    $this->assertInstanceOf(AbstractHelper::class, $this->object);
  }

  public function testShowEcologicFalse() {

    $config = $this->getMockBuilder(Config::class)
      ->disableOriginalConstructor()
      ->onlyMethods(['isEnabled', 'isEcologic'])
      ->getMock();

    $config->expects($this->any())->method('isEnabled')->willReturn(1);
    $config->expects($this->any())->method('isEcologic')->willReturn(0);

    $this->assertFalse($config->showEcologic());
  }

  public function testShowEcologicFalse2() {

    $config = $this->getMockBuilder(Config::class)
      ->disableOriginalConstructor()
      ->onlyMethods(['isEnabled', 'isEcologic'])
      ->getMock();

    $config->expects($this->any())->method('isEnabled')->willReturn(0);
    $config->expects($this->any())->method('isEcologic')->willReturn(0);

    $this->assertFalse($config->showEcologic());
  }

  public function testShowEcologicTrue() {

    $config = $this->getMockBuilder(Config::class)
      ->disableOriginalConstructor()
      ->onlyMethods(['isEnabled', 'isEcologic'])
      ->getMock();

    $config->expects($this->any())->method('isEnabled')->willReturn(1);
    $config->expects($this->any())->method('isEcologic')->willReturn(1);

    $this->assertTrue($config->showEcologic());
  }

}