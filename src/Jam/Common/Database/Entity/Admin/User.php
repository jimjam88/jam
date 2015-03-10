<?php

namespace Jam\Common\Database\Entity\Admin;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *   name="adminUser",
 *   uniqueConstraints={
 *       @ORM\UniqueConstraint(columns={"email"})
 *   }
 * )
 * @ORM\Entity(
 *     repositoryClass="Jam\Common\Database\Repository\Admin\UserRepository"
 * )
 * @ORM\HasLifecycleCallbacks
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=150, nullable=false)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=150, nullable=false)
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=150, nullable=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    protected $password;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="dateAdded", type="datetime", nullable=false)
     */
    protected $dateAdded;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="dateUpdated", type="datetime", nullable=true)
     */
    protected $dateUpdated;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="lastLogin", type="datetime", nullable=true)
     */
    protected $lastLogin;

    /**
     * @var integer
     *
     * @ORM\Column(name="loginCount", type="integer", nullable=false)
     */
    protected $loginCount;

    /**
     * @var string
     *
     * @ORM\Column(name="authToken", type="string", length=255, nullable=true)
     */
    protected $authToken;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="authTokenExpiry", type="datetime", nullable=true)
     */
    protected $authTokenExpiry;

    /**
     * @var UserRole
     *
     * @ORM\ManyToOne(targetEntity="UserRole", inversedBy="users", fetch="LAZY", cascade="persist")
     * @ORM\JoinColumn(
     *     name="roleId",
     *     referencedColumnName="id"
     * )
     */
    protected $role;

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->dateAdded = new DateTime();
        $this->loginCount = 0;
    }

    /**
     * Gets the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param integer $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Sets the value of firstName.
     *
     * @param string $firstName the first name
     *
     * @return self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Gets the value of lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Sets the value of lastName.
     *
     * @param string $lastName the last name
     *
     * @return self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param string $email the email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the value of password.
     *
     * @param string $password the password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Gets the value of dateAdded.
     *
     * @return DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Sets the value of dateAdded.
     *
     * @param DateTime $dateAdded the date added
     *
     * @return self
     */
    public function setDateAdded(DateTime $dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Gets the value of dateUpdated.
     *
     * @return DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * Sets the value of dateUpdated.
     *
     * @param DateTime $dateUpdated the date updated
     *
     * @return self
     */
    public function setDateUpdated(DateTime $dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Gets the value of lastLogin.
     *
     * @return DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Sets the value of lastLogin.
     *
     * @param DateTime $lastLogin the last login
     *
     * @return self
     */
    public function setLastLogin(DateTime $lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get the number of days since the last login
     *
     * @return string
     */
    public function getDaysSinceLastLogin()
    {
        $last = $this->getLastLogin();

        if (!$last instanceof DateTime) {
            return 'Never';
        }

        $diff = (new DateTime())->diff($last);

        switch ($diff->days) {
            case 0 :
                return 'Today';

            case 1 :
                return 'Yesterday';

            default :
                return $diff->days . ' days ago';
        }
    }

    /**
     * Gets the value of loginCount.
     *
     * @return integer
     */
    public function getLoginCount()
    {
        return $this->loginCount;
    }

    /**
     * Sets the value of loginCount.
     *
     * @param integer $loginCount the login count
     *
     * @return self
     */
    public function incrementLoginCount()
    {
        ++$this->loginCount;

        return $this;
    }

    /**
     * Sets the value of loginCount.
     *
     * @param integer $loginCount the login count
     *
     * @return self
     */
    public function setLoginCount($loginCount)
    {
        $this->loginCount = $loginCount;

        return $this;
    }

    /**
     * Gets the value of authToken.
     *
     * @return string
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * Sets the value of authToken.
     *
     * @param string $authToken the auth token
     *
     * @return self
     */
    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;

        return $this;
    }

    /**
     * Gets the value of authTokenExpiry.
     *
     * @return DateTime
     */
    public function getAuthTokenExpiry()
    {
        return $this->authTokenExpiry;
    }

    /**
     * Sets the value of authTokenExpiry.
     *
     * @param DateTime $authTokenExpiry the auth token expiry
     *
     * @return self
     */
    public function setAuthTokenExpiry(DateTime $authTokenExpiry)
    {
        $this->authTokenExpiry = $authTokenExpiry;

        return $this;
    }

    /**
     * Gets the role
     *
     * @return UserRole
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Sets the role
     *
     * @param UserRole $role the role
     *
     * @return self
     */
    public function setRole(UserRole $role)
    {
        $this->role = $role;

        return $this;
    }
}
