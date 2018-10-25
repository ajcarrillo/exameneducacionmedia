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
        return $this->buildAuthUrlFromBase(env('JARVIS_AUTHORIZE_URL'), $state);
    }

    /**
     * Get the token URL for the provider.
     *
     * @return string
     */
    protected function getTokenUrl()
    {
        return env('JARVIS_AUTH_URL_TOKEN');
    }

    public function getAccessTokenResponse($code)
    {
        $http = new \GuzzleHttp\Client;

        $response = $http->post(env('JARVIS_AUTH_URL_TOKEN'), [
            'form_params' => [
                'grant_type'    => 'authorization_code',
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'redirect_uri'  => env('CALLBACK_URL'),
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

        $http = new \GuzzleHttp\Client([ 'base_uri' => env('JARVIS_API_URL') ]);

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
