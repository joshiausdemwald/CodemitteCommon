<?php
namespace Codemitte\Common\Randomizer;

use
    Symfony\Component\Security\Core\Util\SecureRandomInterface
;

class Randomizer implements RandomizerInterface
{
    /**
     * @var SecureRandomInterface $secureRandom
     */
    private $secureRandom;

    /**
     * @param \Symfony\Component\Security\Core\Util\SecureRandomInterface $secureRandom
     */
    public function __construct(SecureRandomInterface $secureRandom)
    {
        $this->secureRandom = $secureRandom;
    }

    /**
     * Returns a generated, unique Id that is encoded
     * base64, if argument isset to true.
     *
     * @param bool $encode_base_64
     * @param int $length
     * @return mixed
     */
    public function getUniqueId($encode_base_64 = true, $length= 23)
    {
        $id = $this->secureRandom->nextBytes($length);

        return $encode_base_64 ? base64_encode($id) : $id;
    }

    /**
     * Creates a random code consisting of digits only
     * (like a pin number)
     *
     * @param int $length
     * @return string
     */
    public function createRandomCode($length = 4)
    {
        $digits = range(0,9);

        $pin = '';

        $funcname = 'mt_rand';

        if( ! function_exists($funcname))
        {
            $funcname = 'rand';
        }

        for($i = 0; $i < $length; $i++)
        {
            $pin .= (string) $digits[$funcname(0,9)];
        }
        return $pin;
    }
}
