namespace App\Component;

use Cake\Controller\Component;
use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Provider\Facebook;

class AuthenticationComponent extends Component
{
    public function socialLogin($provider, $code)
    {
        switch ($provider) {
            case 'google':
                $googleProvider = new Google([
                    'clientId'     => env('GOOGLE_CLIENT_ID'),
                    'clientSecret' => env('GOOGLE_CLIENT_SECRET'),
                    'redirectUri'  => env('APP_URL') . '/oauth/google/callback'
                ]);

                $token = $googleProvider->getAccessToken('authorization_code', [
                    'code' => $code
                ]);

                $userDetails = $googleProvider->getResourceOwner($token);
                break;

            case 'facebook':
                $facebookProvider = new Facebook([
                    'clientId'     => env('FACEBOOK_CLIENT_ID'),
                    'clientSecret' => env('FACEBOOK_CLIENT_SECRET'),
                    'redirectUri'  => env('APP_URL') . '/oauth/facebook/callback'
                ]);

                $token = $facebookProvider->getAccessToken('authorization_code', [
                    'code' => $code
                ]);

                $userDetails = $facebookProvider->getResourceOwner($token);
                break;
        }

        return $this->findOrCreateUser($userDetails);
    }

    private function findOrCreateUser($userDetails)
    {
        $usersTable = $this->getTableLocator()->get('Users');
        $user = $usersTable->findByEmail($userDetails->getEmail())->first();

        if (!$user) {
            $user = $usersTable->newEntity([
                'email' => $userDetails->getEmail(),
                'name' => $userDetails->getName(),
                'password' => uniqid() // Random password for social login
            ]);

            $usersTable->save($user);
        }

        return $user;
    }
}