<?php

namespace Drupal\Tests\phpunit_example\Unit;

use Drupal\hide_preview\Form\HidePreviewConfigForm;
use Drupal\Tests\UnitTestCase;

/**
 * Tests some functions of the Hide Preview module.
 *
 * @group   hide_preview
 *
 * @package Drupal\Tests\phpunit_example\Unit
 */
class HidePreviewTest extends UnitTestCase {

  private $configForm;

  /**
   * Initializes the test class with a mock of the base class.
   *
   * @inheritdoc
   */
  public function __construct($name = NULL, array $data = [], $dataName = '') {
    parent::__construct($name, $data, $dataName);

    // Gets the available methods.
    $methods = get_class_methods(HidePreviewConfigForm::class);

    // Unsets the methods we want to test.
    unset($methods[array_search('multiline2Array', $methods)]);

    // Gets the mock class.
    $this->configForm = $this->getMockBuilder(HidePreviewConfigForm::class)
      ->disableOriginalConstructor()
      ->setMethods($methods)
      ->getMock();
  }

  /**
   * Tests that the multiline2Array method returns the right amount of values.
   */
  public function testMultiline2Array() {
    $multiline = "value1\r\nvalue2\r\nvalue3";
    $array = $this->configForm->multiline2Array($multiline);

    $this->assertEquals(3, count($array));
  }

  /**
   * Tests that the multiline2Array method returns the right amount of values.
   */
  public function testEmptyMultiline2Array() {
    $multiline = "0";
    $array = $this->configForm->multiline2Array($multiline);

    $this->assertEquals(1, count($array));
  }
}
