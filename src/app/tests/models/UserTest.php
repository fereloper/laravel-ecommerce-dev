<?php

/**
 * UserTest is testing for user management model
 *
 * @author Feroj Bepari <feroj21@gmail.com>
 */
class UserTest extends TestCase {

  public function testThatTrueIsTrue() {
    $this->assertTrue(true);
  }
  
  public function testResponseIsOk() {
    $this->call('GET','/');
    $this->assertResponseOk();
  }

}
