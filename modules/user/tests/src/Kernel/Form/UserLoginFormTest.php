<?php

namespace Drupal\Tests\user\Kernel\Form;

use Drupal\Core\Flood\FloodInterface;
use Drupal\Core\Render\RendererInterface;
use Drupal\KernelTests\KernelTestBase;
use Drupal\user\Form\UserLoginForm;
use Drupal\user\UserAuthInterface;
use Drupal\user\UserStorageInterface;

/**
 * @coversDefaultClass \Drupal\user\Form\UserLoginForm
 * @group user
 */
class UserLoginFormTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = ['user'];

  /**
   * @group legacy
   * @expectedDeprecation Passing the flood service to Drupal\user\Form\UserLoginForm::__construct is deprecated in drupal:9.1.0 and is replaced by user.flood_control in drupal:10.0.0. See https://www.drupal.org/node/3067148
   */
  public function testConstructorDeprecations() {
    $flood = $this->prophesize(FloodInterface::class);
    $user_storage = $this->prophesize(UserStorageInterface::class);
    $user_auth = $this->prophesize(UserAuthInterface::class);
    $renderer = $this->prophesize(RendererInterface::class);
    $form = new UserLoginForm(
      $flood->reveal(),
      $user_storage->reveal(),
      $user_auth->reveal(),
      $renderer->reveal()
    );
    $this->assertNotNull($form);
  }

}
