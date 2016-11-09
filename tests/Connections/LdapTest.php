<?php

namespace Adldap\Tests\Connections;

use Adldap\Tests\TestCase;
use Adldap\Connections\Ldap;

class LdapTest extends TestCase
{
    public function test_construct_defaults()
    {
        $ldap = new Ldap();

        $this->assertFalse($ldap->isUsingTLS());
        $this->assertFalse($ldap->isUsingSSL());
        $this->assertFalse($ldap->isBound());
        $this->assertTrue($ldap->isSupported());
        $this->assertNull($ldap->getConnection());
    }

    public function test_connection_string()
    {
        $ldap = $this->mock(Ldap::class)
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        $connections = $ldap->getConnectionString([
            'dc01',
            'dc02',
        ], 'ldap://', '389');

        $this->assertEquals('ldap://dc01:389 ldap://dc02:389', $connections);
    }
}
