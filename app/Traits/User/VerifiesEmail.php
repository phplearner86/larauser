<?php  

namespace App\Traits\User;

trait VerifiesEmail
{
    public function verifyEmail()
    {
        $this->verified = true;
        $this->save();

        $this->activationToken->delete();
    }

    public function isVerified()
    {
        return $this->verified;
    }
}