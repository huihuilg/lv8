<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $a = '=/fsd/';
        dump(str_replace(['/','s'],['1', '2'], $a));

        /**
         * 公钥加密
         */
//        $data = 'rsa加密解密';
//
////解析公钥
//        $res = openssl_pkey_get_public('-----BEGIN PUBLIC KEY-----
//MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCvV9FAyJ2i+aBM+Jtgtq1A0Ra4
//17sqEdmPIla6Vq4UO3iqlwRZyAQa+KkuiH57NtexaFgdVC8kXZCJvWl785Ww7ecu
//BD2M2yLcCZwbkXTwvLPar0GWHMUuu/NYcfKECHErGNcDUGMjyB6l6ASbpkWoM6qO
//iLcCAtK/sQRXVsxlJQIDAQAB
//-----END PUBLIC KEY-----');
//
////使用公钥加密数据
//        openssl_public_encrypt($data, $crypted, $res);
////        echo $crypted;
//
//        /**
//         * 私钥解密
//         */
//
////解析私钥
//        $res = openssl_pkey_get_private('-----BEGIN PRIVATE KEY-----
//MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAK9X0UDInaL5oEz4
//m2C2rUDRFrjXuyoR2Y8iVrpWrhQ7eKqXBFnIBBr4qS6Ifns217FoWB1ULyRdkIm9
//aXvzlbDt5y4EPYzbItwJnBuRdPC8s9qvQZYcxS6781hx8oQIcSsY1wNQYyPIHqXo
//BJumRagzqo6ItwIC0r+xBFdWzGUlAgMBAAECgYBTmG2WEk89XP+00q3ZTR6KkWTg
//2VFNPFdZ60gn7J1v3e6offlACKEUbsrR+Zc7jSkGVrXzvagAEW+Qi7JXuwj5GFHI
//Ml/tZjEH73twJZiEc+iehwj1skZMoTUj/Tn3PTnSNHzh72RSf4TgtijDUENSwp0L
//l2vuUZS6KgaQR/92gQJBANiFAI0xt4B6uvN/T/gPco6mCgoeKTLp8VizOEA+1nOM
//LmIDVYxmCBpJEbVXNr0E65zBHeRH9tEtjQkf8JEdTIUCQQDPULi7z8lXfZjDCZXE
//1PqXgm1Fb7+S6s7Ql5RdNW6EIWavFV6ItT7YlXsRmvBgoeSMfdgBW6b8TFwh5JAU
//CeghAkADloCh1lcSG/aJHmz20Vq2nm3AKSvJmjLTo3SlK+Vl2MbT/PYn83Di7p8K
//gD15+GDnIhQauk6OvNB/fDYCUZf5AkA0Bi+1gbkm6W+yUe9xi3ivGJ3PNPHALohj
//tAYZNdVb9v3LpfMpH0J8G1bc3iLAPSAbWWEhRhyrZ4YfQzocrTfBAkEA0WOs6CN6
//3luUh2rkw48oXWHPgQDg6AdBM2r8nKWTRAxGCLP/kZmDwGsSbvg3f7a7LST6iwBU
//djKCXncinwsBfA==
//-----END PRIVATE KEY-----');
//
////使用私钥解密数据
//        openssl_private_decrypt($crypted, $decrypted, $res);
////        dd($decrypted);
//$data = 'fdsa\\fsdarew-fsd+ewno+efw';
//        $data = str_replace(["\\",'+','-'], ['%','_','.'], $data);
//        echo $data;
        echo 1;

    }
}
