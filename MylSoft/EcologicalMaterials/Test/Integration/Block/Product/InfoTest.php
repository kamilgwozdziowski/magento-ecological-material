<?php

namespace MylSoft\EcologicalMaterials\Test\Integration\Block\Product;

use Magento\TestFramework\Helper\Bootstrap;
use MylSoft\EcologicalMaterials\Block\Product\Info;
use PHPUnit\Framework\TestCase;

/**
 * @magentoAppArea frontend
 */
class InfoTest extends TestCase {

  /**
   * @var Info
   */
  private $object;

  protected function setUp(): void {
    $objectManager = Bootstrap::getObjectManager();
    $this->object = $objectManager->get(Info::class);
  }

  public function testToHtml(): void {
    $this->assertTrue(true);
  }

}