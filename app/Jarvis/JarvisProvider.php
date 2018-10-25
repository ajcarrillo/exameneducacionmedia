<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 24/10/18
 * Time: 01:19
 */

namespace ExamenEducacionMedia\Jarvis;


use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class JarvisProvider extends AbstractProvider implements ProviderInterface
{

    /**
     * Get the authentication URL for the provider.
     *
     * @param  string $state
     * @return string
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('http://siie.test/oauth/authorize', $state);
    }

    /**
     * Get the token URL for the provider.
     *
     * @return string
     */
    protected function getTokenUrl()
    {
        return 'http://siie.test/oauth/token';
    }

    public function getAccessTokenResponse($code)
    {
        $http = new \GuzzleHttp\Client;

        $response = $http->post(env('JARVIS_AUTH_URL_TOKEN'), [
            'form_params' => [
                'grant_type'    => 'authorization_code',
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'redirect_uri'  => 'http://exameneducacionmedia.test/handle-callback',
                'code'          => $code,
            ],
        ]);

        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Get the raw user for the given access token.
     *
     * @param  string $token
     * @return array
     */
    protected function getUserByToken($token)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];

        $http = new \GuzzleHttp\Client([ 'base_uri' => 'http://jarvis.test/api/' ]);

        $response = $http->get('me', [
            'headers' => $headers,
        ]);

        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Map the raw user array to a Socialite User instance.
     *
     * @param  array $user
     * @return \Laravel\Socialite\Two\User
     */
    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id'       => $user['uuid'],
            'nickname' => $user['username'],
            'name'     => $user['persona']['nombre_completo'],
            'email'    => $user['email'],
        ]);
    }
}
