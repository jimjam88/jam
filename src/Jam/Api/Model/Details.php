<?php

namespace Jam\Api\Model;

use Doctrine\ORM\EntityManager;
use Jam\Common\Database\Entity\Contact;
use Jam\Common\Database\Entity\SocialMedia;

class Details
{
    /**
     * Fetch the details.
     *
     * @param  EntityManager $em The entity manager
     * @return array
     */
    static public function get(EntityManager $em)
    {
        $medias = $em->getRepository(SocialMedia::class)->getSocialMedias();
        array_walk($medias, function(&$media) {
            $media = $media->toArray();
        });

        // Fetch the contact details and the social media links
        return [
            'contact'     => $em->getRepository(Contact::class)->getContact()->toArray(),
            'socialMedia' => $medias,
        ];
    }
}
