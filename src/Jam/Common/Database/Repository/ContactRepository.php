<?php

namespace Jam\Common\Database\Repository;

use InvalidArgumentException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\EntityRepository;
use Jam\Common\Database\Entity\Contact;

class ContactRepository extends EntityRepository
{
    /**
     * Persist a contact entity
     *
     * @param Contact $contact The entity
     */
    public function persist(Contact $contact)
    {
        $this->_em->persist($contact);
        $this->_em->flush();
        $this->_em->clear();
    }

    /**
     * Save a contact entity
     *
     * @param Contact $contact The entity
     */
    public function save(Contact $contact)
    {
        $this->_em->merge($contact);
        $this->_em->flush();
        $this->_em->clear();
    }

    /**
     * Update the contact details
     *
     * @param  array  $data The data
     * @return Contact
     */
    public function update(array $data)
    {
        $contact = $this->getContact();

        if (array_key_exists('name', $data) && $data['name'] != $contact->getName()) {
            $contact->setName($data['name']);
        }

        if (array_key_exists('email', $data) && $data['email'] != $contact->getEmail()) {
            $contact->setEmail($data['email']);
        }

        if (array_key_exists('phone', $data) && $data['phone'] != $contact->getPhone()) {
            $contact->setPhone($data['phone']);
        }

        if (array_key_exists('mobile', $data) && $data['mobile'] != $contact->getMobile()) {
            $contact->setMobile($data['mobile']);
        }

        if (array_key_exists('fax', $data) && $data['fax'] != $contact->getFax()) {
            $contact->setFax($data['fax']);
        }

        if (array_key_exists('addressLine1', $data) && $data['addressLine1'] != $contact->getAddressLine1()) {
            $contact->setAddressLine1($data['addressLine1']);
        }

        if (array_key_exists('addressLine2', $data) && $data['addressLine2'] != $contact->getAddressLine2()) {
            $contact->setAddressLine2($data['addressLine2']);
        }

        if (array_key_exists('addressLine3', $data) && $data['addressLine3'] != $contact->getAddressLine3()) {
            $contact->setAddressLine3($data['addressLine3']);
        }

        if (array_key_exists('city', $data) && $data['city'] != $contact->getCity()) {
            $contact->setCity($data['city']);
        }

        if (array_key_exists('county', $data) && $data['county'] != $contact->getCounty()) {
            $contact->setCounty($data['county']);
        }

        if (array_key_exists('postcode', $data) && $data['postcode'] != $contact->getPostcode()) {
            $contact->setPostcode($data['postcode']);
        }

        $this->save($contact);

        return $contact;
    }

    /**
     * Contact getter.
     *
     * If a row was not found then a new entity is returned
     *
     * @return Contact
     */
    public function getContact()
    {
        try {
            return $this->createQueryBuilder('c')->getQuery()->getSingleResult();

        } catch (NoResultException $e) {
            return new Contact();
        }
    }
}
