namespace Aquila\Cipher;

class AquilaCipher {
    public static function encrypt($text) {
        $response = file_get_contents("https://api.aquilainnovations.in/cipher/AquilaCipher.php?action=encrypt&text=" . urlencode($text));
        return json_decode($response, true)['result'];
    }

    public static function decrypt($text) {
        $response = file_get_contents("https://api.aquilainnovations.in/cipher/AquilaCipher.php?action=decrypt&text=" . urlencode($text));
        return json_decode($response, true)['result'];
    }
}
