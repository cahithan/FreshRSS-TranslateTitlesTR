<?php
class TranslationService {
    private $serviceType;
    private $deeplxBaseUrl;
    private $googleBaseUrl;

    public function __construct($serviceType) {
        $this->serviceType = $serviceType;
        $this->deeplxBaseUrl = FreshRSS_Context::$user_conf->DeeplxApiUrl; // DeeplX API URL
        $this->googleBaseUrl = 'https://translate.googleapis.com/translate_a/single'; // Google Çeviri API'si URL'si
    }

    public function translate($text) {
        if ($this->serviceType == 'deeplx') {
            return $this->translateWithDeeplx($text);
        } else {
            return $this->translateWithGoogle($text);
        }
    }

    private function translateWithGoogle($text) {
        // Google Çeviri Mantığı
        $translatedText = '';

        //Google Translate API'sı için sorgu parametreleri oluşturma
        $queryParams = http_build_query([
            'client' => 'gtx',
            'sl' => 'auto',     // Kaynak dili otomatik algılamaya ayarlandı
            'tl' => 'tr',       // Hedef dil Türkçe olarak ayarlandı
            'dt' => 't',
            'q' => $text,
        ]);

        $url = $this->googleBaseUrl . '?' . $queryParams;

        $options = [
            'http' => [
                'method' => 'GET',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'timeout' => 3,
            ],
        ];

        $context = stream_context_create($options);

        try {
            $result = @file_get_contents($url, false, $context);
            if ($result === FALSE) {
                throw new Exception("Failed to get content from Google Translate API.");
            }

            // Google Çeviri yanıtını ayrıştır
            $response = json_decode($result, true);
            if (!empty($response[0][0][0])) {
                $translatedText = $response[0][0][0];
            } else {
                throw new Exception("Google Translate API returned an empty translation.");
            }

            // Başarılı çevirileri kaydedin
            // error_log("Translation successful for text: " . $text . "; Translated: " . $translatedText);
        } catch (Exception $e) {
            // Günlük hata mesajı
            error_log("Error in translation: " . $e->getMessage());
        }

        return $translatedText;
    }

    private function translateWithDeeplx($text) {
        // DeeplX çeviri mantığı
        $translatedText = '';

        // 1-3 saniyelik rastgele bir zaman aralığı ekleyin
        sleep(rand(1, 3));

        // POST verilerini oluşturun
        $postData = json_encode([
            'text' => $text,
            'source_lang' => 'auto',
            'target_lang' => 'TR' // Hedef dil Türkçe olarak ayarlandı
        ]);

        $options = [
            'http' => [
                'header' => "Content-Type: application/json\r\n",
                'method' => 'POST',
                'content' => $postData,
                'timeout' => 3, // Zaman aşımını ayarla
            ]
        ];

        $context = stream_context_create($options);

        try {
            // DeeplX API'sine istek gönder
            $result = file_get_contents($this->deeplxBaseUrl, false, $context);
            if ($result === FALSE) {
                throw new Exception("Failed to get content from DeeplX API.");
            }

            // Yanıtı ayrıştır
            $response = json_decode($result, true);
            if (isset($response['data']) && !empty($response['data'])) {
                $translatedText = $response['data'];
            } else {
                throw new Exception("DeeplX API returned an empty translation. Response code: " . $response['code']);
            }

            // Başarılı çevirileri kaydedin
            // error_log("Translation successful for text: " . $text . "; Translated: " . $translatedText);
        } catch (Exception $e) {
            // Hata koşullarını ele alın
            error_log("Error in DeeplX translation: " . $e->getMessage());
        }

        return $translatedText;
    }
}
