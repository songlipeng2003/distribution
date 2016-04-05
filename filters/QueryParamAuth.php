<?php 
namespace app\filters;
class QueryParamAuth extends \yii\filters\auth\QueryParamAuth
{
    public function authenticate($user, $request, $response)
    {
        $accessToken = $request->get($this->tokenParam);

        if(!$accessToken){
            $accessToken = $request->post($this->tokenParam);
        }
        if (is_string($accessToken)) {
            $identity = $user->loginByAccessToken($accessToken, get_class($this));
            if ($identity !== null) {
                return $identity;
            }
        }
        if ($accessToken !== null) {
            $this->handleFailure($response);
        }
        return null;
    }
}