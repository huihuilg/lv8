<?php


namespace App\Service\Common\Rsa;


class Rsa
{
    /**
     * @var string
     */
    private static $publicKey = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCvV9FAyJ2i+aBM+Jtgtq1A0Ra4
17sqEdmPIla6Vq4UO3iqlwRZyAQa+KkuiH57NtexaFgdVC8kXZCJvWl785Ww7ecu
BD2M2yLcCZwbkXTwvLPar0GWHMUuu/NYcfKECHErGNcDUGMjyB6l6ASbpkWoM6qO
iLcCAtK/sQRXVsxlJQIDAQAB
-----END PUBLIC KEY-----';

    private static $privateKey = '-----BEGIN PRIVATE KEY-----
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAK9X0UDInaL5oEz4
m2C2rUDRFrjXuyoR2Y8iVrpWrhQ7eKqXBFnIBBr4qS6Ifns217FoWB1ULyRdkIm9
aXvzlbDt5y4EPYzbItwJnBuRdPC8s9qvQZYcxS6781hx8oQIcSsY1wNQYyPIHqXo
BJumRagzqo6ItwIC0r+xBFdWzGUlAgMBAAECgYBTmG2WEk89XP+00q3ZTR6KkWTg
2VFNPFdZ60gn7J1v3e6offlACKEUbsrR+Zc7jSkGVrXzvagAEW+Qi7JXuwj5GFHI
Ml/tZjEH73twJZiEc+iehwj1skZMoTUj/Tn3PTnSNHzh72RSf4TgtijDUENSwp0L
l2vuUZS6KgaQR/92gQJBANiFAI0xt4B6uvN/T/gPco6mCgoeKTLp8VizOEA+1nOM
LmIDVYxmCBpJEbVXNr0E65zBHeRH9tEtjQkf8JEdTIUCQQDPULi7z8lXfZjDCZXE
1PqXgm1Fb7+S6s7Ql5RdNW6EIWavFV6ItT7YlXsRmvBgoeSMfdgBW6b8TFwh5JAU
CeghAkADloCh1lcSG/aJHmz20Vq2nm3AKSvJmjLTo3SlK+Vl2MbT/PYn83Di7p8K
gD15+GDnIhQauk6OvNB/fDYCUZf5AkA0Bi+1gbkm6W+yUe9xi3ivGJ3PNPHALohj
tAYZNdVb9v3LpfMpH0J8G1bc3iLAPSAbWWEhRhyrZ4YfQzocrTfBAkEA0WOs6CN6
3luUh2rkw48oXWHPgQDg6AdBM2r8nKWTRAxGCLP/kZmDwGsSbvg3f7a7LST6iwBU
djKCXncinwsBfA==
-----END PRIVATE KEY-----';

    protected static $transMap = [
        '+' => '-',
        '/' => '_',
        '=' => '.',
    ];

    //替换符合
    private function getTransMap($revert = false)
    {
        return $revert ? array_flip(self::$transMap) : self::$transMap;
    }
    //base64 加密替换
    protected function urlBase64Encode($data = '')
    {
        $data = base64_encode($data);
        return str_replace(array_keys($this->getTransMap()), array_values($this->getTransMap()), $data);
    }

    //base64 解密替换
    protected function urlBase64Decode($data = '')
    {
        $data = str_replace(array_keys($this->getTransMap(true)), array_values($this->getTransMap(true)), $data);
        return base64_decode($data);
    }

    protected function getPublicKey()
    {
        return openssl_pkey_get_public(self::$publicKey);
    }
    protected function getPrivateKey()
    {
        return openssl_pkey_get_private(self::$privateKey);
    }

    //rsa加密
    public function encode($data = '', $encode = true)
    {
        if (is_array($data)) {
            $data = json_encode($data);
        }
        $key = openssl_get_privatekey($this->getPrivateKey());
        openssl_private_encrypt($data, $crypted, $key);
        return $encode ? $this->urlBase64Encode($crypted) : $crypted;
    }

    //rsa解密
    public function decode($data = '', $encode = true)
    {
        if ($encode) {
            $data = $this->urlBase64Decode($data);
        }
        $key = openssl_get_publickey($this->getPublicKey());
        openssl_public_decrypt($data, $decrypted, $key);
        return json_decode($decrypted, true) ?:$decrypted;
    }



}