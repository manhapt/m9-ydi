<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Define a Reference for available roles.
 *
 * Sample all roles:
 *
 * @Security("
        has_role('ROLE_WP_SUBSCRIBER')
     or has_role('ROLE_WP_ADMINISTRATOR')
     or has_role('ROLE_WP_CONTRIBUTOR')
   ")
 * Class AclRoles
 */
final class AclRoles
{
    const SECURITY_ROLE_WP_ADMINISTRATOR = 'ROLE_WP_ADMINISTRATOR';
    const SECURITY_ROLE_WP_CONTRIBUTOR = 'ROLE_WP_CONTRIBUTOR';
    const SECURITY_ROLE_WP_SUBSCRIBER = 'ROLE_WP_SUBSCRIBER';
}
