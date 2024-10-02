<?php
require_once('TranslationService.php');

class TranslateController {
    public function translateTitle($title) {
        $serviceType = FreshRSS_Context::$user_conf->TranslateService ?? 'google';
        $translationService = new TranslationService($serviceType);
        $translatedTitle = '';
        $attempts = 0;
        $sleepTime = 1; // ilk bekleme süresi

        error_log("Service: " . $serviceType . ", Title: " . $title);

        while ($attempts < 2) {
            try {
                $translatedTitle = $translationService->translate($title);
                if (!empty($translatedTitle)) {
                    break;
                }
            } catch (Exception $e) {
                $attempts++;
                sleep($sleepTime);
                $sleepTime *= 2; // Her arızadan sonra bekleme süresini artırın
            }
        }

        //Çeviri başarısız olursa ve mevcut hizmet DeeplX ise Google Translate'i kullanmayı deneyin
        if (empty($translatedTitle) && $serviceType == 'deeplx') {
            $translationService = new TranslationService('google');
            $translatedTitle = $translationService->translate($title);
        }

        // Çeviri yine de başarısız olursa orijinal başlığı kullanın
        if (empty($translatedTitle)) {
            return $title;
        }

        return $translatedTitle;
    }
}
