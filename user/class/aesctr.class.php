<?php
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/*  mengimplementasi aes counter(CTR) menggunakan link copyright                                  */
/*    (c) Chris Veness 2005-2014 www.movable-type.co.uk/scripts                                   */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */

Class AesCtr extends Aes
{

    /**
     * Menenkripsi teks yang dienkripsi oleh AES dalam mode operasi counter
     * @param plaintext source text to be encrypted
     * @param password  the password to use to generate a key
     * @param nBits     number of bits to be used in the key (128, 192, or 256)
     * @return          encrypted text
     */
    public static function encrypt($plaintext, $password, $nBits)
    {
        $blockSize = 16; 
        if (!($nBits == 128 || $nBits == 192 || $nBits == 256)) return ''; 
        $nBytes = $nBits / 8; 
        $pwBytes = array();
        for ($i = 0; $i < $nBytes; $i++) $pwBytes[$i] = ord(substr($password, $i, 1)) & 0xff;
        $key = Aes::cipher($pwBytes, Aes::keyExpansion($pwBytes));
        $key = array_merge($key, array_slice($key, 0, $nBytes - 16));

        $counterBlock = array();
        $nonce = floor(microtime(true) * 1000); 
        $nonceMs = $nonce % 1000;
        $nonceSec = floor($nonce / 1000);
        $nonceRnd = floor(rand(0, 0xffff));

        for ($i = 0; $i < 2; $i++) $counterBlock[$i] = self::urs($nonceMs, $i * 8) & 0xff;
        for ($i = 0; $i < 2; $i++) $counterBlock[$i + 2] = self::urs($nonceRnd, $i * 8) & 0xff;
        for ($i = 0; $i < 4; $i++) $counterBlock[$i + 4] = self::urs($nonceSec, $i * 8) & 0xff;

        // dan mengubahnya menjadi string untuk ditempatkan di bagian depan ciphertext
        $ctrTxt = '';
        for ($i = 0; $i < 8; $i++) $ctrTxt .= chr($counterBlock[$i]);

        // generate key schedule - perluasan key menjadi Putaran Key yang berbeda untuk setiap putaran
        $keySchedule = Aes::keyExpansion($key);
       

        $blockCount = ceil(strlen($plaintext) / $blockSize);
        $ciphertxt = array(); 

        for ($b = 0; $b < $blockCount; $b++) {
            for ($c = 0; $c < 4; $c++) $counterBlock[15 - $c] = self::urs($b, $c * 8) & 0xff;
            for ($c = 0; $c < 4; $c++) $counterBlock[15 - $c - 4] = self::urs($b / 0x100000000, $c * 8);

            $cipherCntr = Aes::cipher($counterBlock, $keySchedule); 
            $blockLength = $b < $blockCount - 1 ? $blockSize : (strlen($plaintext) - 1) % $blockSize + 1;
            $cipherByte = array();

            for ($i = 0; $i < $blockLength; $i++) { 
                $cipherByte[$i] = $cipherCntr[$i] ^ ord(substr($plaintext, $b * $blockSize + $i, 1));
                $cipherByte[$i] = chr($cipherByte[$i]);
            }
            $ciphertxt[$b] = implode('', $cipherByte); 
        }

        // implode lebih efisien daripada penggabungan string berulang
        $ciphertext = $ctrTxt . implode('', $ciphertxt);
        $ciphertext = base64_encode($ciphertext);
        return $ciphertext;
    }


    /**
     * Mendekripsi teks yang dienkripsi oleh AES dalam mode operasi counter
     *
     * @param ciphertext source text to be decrypted
     * @param password   the password to use to generate a key
     * @param nBits      number of bits to be used in the key (128, 192, or 256)
     * @return           decrypted text
     */
    public static function decrypt($ciphertext, $password, $nBits)
    {
        $blockSize = 16; 
        if (!($nBits == 128 || $nBits == 192 || $nBits == 256)) return ''; 
        $ciphertext = base64_decode($ciphertext);

        // gunakan AES untuk mengenkripsi kata sandi (mirroring encrypt routine)
        $nBytes = $nBits / 8; 
        $pwBytes = array();
        for ($i = 0; $i < $nBytes; $i++) $pwBytes[$i] = ord(substr($password, $i, 1)) & 0xff;
        $key = Aes::cipher($pwBytes, Aes::keyExpansion($pwBytes));
        $key = array_merge($key, array_slice($key, 0, $nBytes - 16)); 

        // memulihkan nonce dari elemen pertama ciphertext
        $counterBlock = array();
        $ctrTxt = substr($ciphertext, 0, 8);
        for ($i = 0; $i < 8; $i++) $counterBlock[$i] = ord(substr($ctrTxt, $i, 1));

        // generate key schedule
        $keySchedule = Aes::keyExpansion($key);
        $nBlocks = ceil((strlen($ciphertext) - 8) / $blockSize);
        $ct = array();
        for ($b = 0; $b < $nBlocks; $b++) $ct[$b] = substr($ciphertext, 8 + $b * $blockSize, 16);
        $ciphertext = $ct; 

        $plaintxt = array();

        for ($b = 0; $b < $nBlocks; $b++) {
            for ($c = 0; $c < 4; $c++) $counterBlock[15 - $c] = self::urs($b, $c * 8) & 0xff;
            for ($c = 0; $c < 4; $c++) $counterBlock[15 - $c - 4] = self::urs(($b + 1) / 0x100000000 - 1, $c * 8) & 0xff;

            $cipherCntr = Aes::cipher($counterBlock, $keySchedule);

            $plaintxtByte = array();
            for ($i = 0; $i < strlen($ciphertext[$b]); $i++) {
                $plaintxtByte[$i] = $cipherCntr[$i] ^ ord(substr($ciphertext[$b], $i, 1));
                $plaintxtByte[$i] = chr($plaintxtByte[$i]);

            }
            $plaintxt[$b] = implode('', $plaintxtByte);
        }

        // menggabungkan array blok menjadi string plaintext tunggal
        $plaintext = implode('', $plaintxt);

        return $plaintext;
    }


    /*
     * Fungsi shift kanan yang tidak ditandatangani, karena PHP tidak memiliki >>> operator atau int yang tidak ditandatangani
     *
     * @param a  number to be shifted (32-bit integer)
     * @param b  number of bits to shift a to the right (0..31)
     * @return   a right-shifted and zero-filled by b bits
     */
    private static function urs($a, $b)
    {
        $a &= 0xffffffff;
        $b &= 0x1f; 
        if ($a & 0x80000000 && $b > 0) { 
            $a = ($a >> 1) & 0x7fffffff; 
            $a = $a >> ($b - 1); 
        } else { 
            $a = ($a >> $b); 
        }
        return $a;
    }

}

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */