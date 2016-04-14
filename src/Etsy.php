<?php
namespace Y0lk\OAuth1\Client\Server;

use League\OAuth1\Client\Credentials\TokenCredentials;
use League\OAuth1\Client\Server\Server;
use League\OAuth1\Client\Server\User;

class Etsy extends Server
{
    const API_URL = 'https://openapi.etsy.com/v2/';

    /**
     * Application scope.
     *
     * @var string
     */
    protected $applicationScope;


    /**
     * {@inheritDoc}
     */
    public function __construct($clientCredentials, SignatureInterface $signature = null)
    {
        parent::__construct($clientCredentials, $signature);
        if (is_array($clientCredentials)) {
            $this->parseConfiguration($clientCredentials);
        }
    }

    /**
     * Set the application scope.
     *
     * @param string $applicationScope
     *
     * @return Etsy
     */
    public function setApplicationScope($applicationScope)
    {
        $this->applicationScope = $applicationScope;
        return $this;
    }

    /**
     * Get application scope.
     *
     * @return string
     */
    public function getApplicationScope()
    {
        return $this->applicationScope;
    }

    /**
     * {@inheritDoc}
     */
    public function urlTemporaryCredentials()
    {
        return self::API_URL.'oauth/request_token?scope='.$this->applicationScope;
    }
    /**
     * {@inheritDoc}
     */
    public function urlAuthorization()
    {
        return self::API_URL.'oauth/authenticate';
    }
    /**
     * {@inheritDoc}
     */
    public function urlTokenCredentials()
    {
        return self::API_URL.'oauth/access_token';
    }
    /**
     * {@inheritDoc}
     */
    public function urlUserDetails()
    {
        return self::API_URL.'users';
    }
    /**
     * {@inheritDoc}
     */
    public function userDetails($data, TokenCredentials $tokenCredentials)
    {
        $data = $data['user'];

        $user = new User();
        $user->uid = $data['user_id'];
        $user->nickname = $data['login_name'];
        $user->email = $data['primary_email'];

        $used = array('user_id', 'login_name', 'primary_email');

        // Save all extra data
        $user->extra = array_diff_key($data, array_flip($used));
        return $user;
    }
    /**
     * {@inheritDoc}
     */
    public function userUid($data, TokenCredentials $tokenCredentials)
    {
        return $data['user']['user_id'];
    }
    /**
     * {@inheritDoc}
     */
    public function userEmail($data, TokenCredentials $tokenCredentials)
    {
        return $data['user']['primary_email'];
    }
    /**
     * {@inheritDoc}
     */
    public function userScreenName($data, TokenCredentials $tokenCredentials)
    {
        return $data['user']['login_name'];
    }

    /**
     * Parse configuration array to set attributes.
     *
     * @param array $configuration
     */
    private function parseConfiguration(array $configuration = array())
    {
        $configToPropertyMap = array(
            'scope' => 'applicationScope'
        );
        foreach ($configToPropertyMap as $config => $property) {
            if (isset($configuration[$config])) {
                $this->$property = $configuration[$config];
            }
        }
    }
}