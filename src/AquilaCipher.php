<?php
namespace aquilainnovations\aquilacipher;

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

    public static function enc(string $text): ?string
    {
        return self::callApi('encrypt', $text);
    }

    /**
     * Verifies if the encrypted text matches the expected plain text.
     *
     * @param string $encryptedText
     * @param string $plainText
     * @return bool|null Returns true/false if matched, or null on error
     */
    public static function match(string $encryptedText, string $plainText): ?bool
    {
        $url = self::$apiUrl . '?action=match&encrypted=' . urlencode($encryptedText) . '&plain=' . urlencode($plainText);

        $response = @file_get_contents($url);

        if ($response === false) {
            error_log("AquilaCipher: Failed to reach API for match.");
            return null;
        }

        $data = json_decode($response, true);

        return isset($data['match']) ? (bool)$data['match'] : null;
    }

    /**
     * Internal function to communicate with the remote API for encryption.
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
