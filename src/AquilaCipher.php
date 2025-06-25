<?php
namespace Aquila\Cipher;

class AquilaCipher
{
    private static string $apiUrl = "https://api.aquilainnovations.in/cipher/AquilaCipher.php";

    /**
     * Encrypts the given text using remote API.
     *
     * @param string $text
     * @return string|null
     */
    public static function encrypt(string $text): ?string
    {
        return self::callApi('encrypt', $text);
    }

    /**
     * Decrypts the given text using remote API.
     *
     * @param string $text
     * @return string|null
     */
    public static function decrypt(string $text): ?string
    {
        return self::callApi('decrypt', $text);
    }

    /**
     * Internal function to communicate with the remote API.
     *
     * @param string $action
     * @param string $text
     * @return string|null
     */
    private static function callApi(string $action, string $text): ?string
    {
        $url = self::$apiUrl . '?action=' . urlencode($action) . '&text=' . urlencode($text);
        
        $response = @file_get_contents($url);

        if ($response === false) {
            error_log("AquilaCipher: Failed to reach API.");
            return null;
        }

        $data = json_decode($response, true);

        return $data['result'] ?? null;
    }
}
?>
