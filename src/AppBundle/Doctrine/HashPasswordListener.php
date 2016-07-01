<?php
/**
 * Created by PhpStorm.
 * User: dominikpakosz
 * Date: 01.07.16
 * Time: 14:05
 */

namespace AppBundle\Doctrine;


use AppBundle\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class HashPasswordListener implements EventSubscriber
{
    private $encoder;

    public function __construct(UserPasswordEncoder $encoder)
    {

        $this->encoder = $encoder;
    }

    public function getSubscribedEvents()
    {
        return ['prePersist', 'preUpdate'];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User) {
            $this->encodedPassword($entity);
        } else {
            return;
        }


    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User) {
            $this->encodedPassword($entity);
        } else {
            return;
        }


    }

    private function encodedPassword(User $entity)
    {
        $encoded = $this->encoder->encodePassword($entity, $entity->getPassword());
        $entity->setPassword($encoded);
    }
}