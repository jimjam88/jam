<?php

namespace Jam\Common\Database\Repository;

use InvalidArgumentException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\EntityRepository;
use Jam\Common\Database\Entity\SocialMedia;

class SocialMediaRepository extends EntityRepository
{
    /**
     * Map the name to the icons
     *
     * @var string
     */
    protected $icons = [
        'facebook'   => 'facebook2',
        'twitter'    => 'twitter',
        'youtube'    => 'youtube3',
        'google'     => 'google-plus2',
        'instagram'  => 'instagram',
        'pinterest'  => 'pinterest2',
        'soundcloud' => 'soundcloud',
        'github'     => 'github4',
        'tumblr'     => 'tumblr',
        'blogger'    => 'blogger',
        'wordpress'  => 'wordpress2',
    ];

    /**
     * Map the input name to human readable name
     *
     * @var string[]
     */
    protected $map = [
        'facebook'   => 'Facebook',
        'twitter'    => 'Twitter',
        'youtube'    => 'YouTube',
        'google'     => 'Google+',
        'instagram'  => 'Instagram',
        'pinterest'  => 'Pinterest',
        'soundcloud' => 'Soundcloud',
        'github'     => 'Github',
        'tumblr'     => 'Tumblr',
        'blogger'    => 'Blogger',
        'wordpress'  => 'WordPress',
    ];

    /**
     * Persist a social media entity
     *
     * @param SocialMedia $social media The entity
     */
    public function persist(SocialMedia $sm)
    {
        $this->_em->persist($sm);
        $this->_em->flush();
        $this->_em->clear();
    }

    /**
     * Save a social media entity
     *
     * @param SocialMedia $sm The entity
     */
    public function save(SocialMedia $sm)
    {
        $this->_em->merge($sm);
        $this->_em->flush();
        $this->_em->clear();
    }

    /**
     * Update the social media details
     *
     * @param  array        $data The data
     * @return SocialMedia[]
     */
    public function update(array $data)
    {
        $medias = $this->getSocialMedias(true);

        foreach ($this->map as $formName => $humanName) {
            if (array_key_exists($formName, $data)) {
                $this->updateMedia($formName, $data[$formName], $medias);
            }
        }

        $this->_em->flush();
        $this->_em->clear();

        return $this->getSocialMedias();
    }

    /**
     * Update a media
     *
     * @param  string         $formName The form name
     * @param  string         $value    The value (URL)
     * @param  SocialMedia[]  $medias   The current medias
     * @return SocialMedia[]
     */
    public function updateMedia($formName, $value, array $medias)
    {
        foreach ($medias as $media) {
            if ($media instanceof SocialMedia && array_search($media->getName(), $this->map) === $formName) {
                if (!strlen($value)) {
                    $value = null;
                }

                $media->setUrl($value);
                return $this->_em->merge($media);
            }
        }

        $media = new SocialMedia();
        $media->setName($this->map[$formName]);
        $media->setIcon($this->icons[$formName]);
        $media->setUrl($value);
        $this->_em->persist($media);

        return $media;
    }

    /**
     * Social medias getter.
     *
     * @return SocialMedia[]
     */
    public function getSocialMedias($entities = false)
    {
        $entities = $this->createQueryBuilder('c')->getQuery()->getResult();

        if (!$entities) return $entities;

        $medias = $this->map;

        foreach ($medias as $key => &$value) {
            foreach ($entities as $entity) {
                if ($entity->getName() === $value) {
                    $value = $entity;
                    break;
                }
            }

            if (is_string($value)) {
                $value = null;
            }
        }

        return $medias;
    }

    public function getUrls()
    {
        $medias = $this->getSocialMedias();

        foreach ($medias as &$media) {
            if ($media instanceof SocialMedia) {
                $media = $media->getUrl();
            }
        }

        return $medias;
    }
}
