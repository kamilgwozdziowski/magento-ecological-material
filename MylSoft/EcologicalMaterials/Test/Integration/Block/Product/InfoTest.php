<?php

namespace MylSoft\EcologicalMaterials\Test\Integration\Block\Product;

use Magento\TestFramework\Helper\Bootstrap;
use MylSoft\EcologicalMaterials\Block\Product\Info;
use PHPUnit\Framework\TestCase;
use Magento\TestFramework\ObjectManager;

/**
 * @magentoAppIsolation enabled
 */
class InfoTest extends TestCase {

  /**
   * @var Info
   */
  private $object;

  /**
   * @var ObjectManager
   */
  private $objectManager;

  protected function setUp(): void {
    $this->objectManager = Bootstrap::getObjectManager();
    //$this->object = $this->objectManager->get(Info::class);
  }

  public static function loadFixture()
  {
    include __DIR__ . '../../../_files/products.php';
  }

  /**
   * @//TODO magentoDataFixture loadFixture
   * @magentoAppArea frontend
   */
  public function testToHtml(): void {
    $this->assertTrue(true);
  }

}