# TranslateTitlesTr

'TranslateTitlesTR' FreshRSS için geliştirilmiş , belirli yayınlardaki makale başlıklarını Türkçe’ye çevirebilen bir eklentidir . Kullanıcılar çeviriyi tamamlamak için DeeplX veya Google Translate hizmetlerini kullanmayı seçebilir.

> **Açıklama** : Bu proje, geliştirme sürecinde ChatGPT'yi yoğun bir şekilde kullandı ve OpenAI'ye şükranlarımı sunmak isterim .

## Ekran resimleri



<img src="https://github.com/jacob2826/FreshRSS-TranslateTitlesCN/blob/main/screenshot-20231219-142233.png" width="300px"/>

<img src="https://github.com/jacob2826/FreshRSS-TranslateTitlesCN/blob/main/screenshot-20231219-142310.png" width="300px"/>

## Kurulum yöntemi

1.	TranslateTitlesCNEklentiyi indirin .
2.	TranslateTitlesCNKlasörü FreshRSS örneğinizin dizininin altına yerleştirin ./extensions.
3.	FreshRSS örneğinizde oturum açın.
4.	Yönetici paneline gidin ve Uzantılar bölümüne gidin.
5.	Eklenti listesinde bulun TranslateTitlesCNve "Etkinleştir"e tıklayın.


## Nasıl kullanılır
  Eklentiyi kurup etkinleştirdikten sonra ilgili ayarları yapmak için eklentinin yapılandırma sayfasına girin. Burada şunları yapabilirsiniz:
•	Çeviri hizmetini seçin : Çeviri hizmeti sağlayıcısı olarak DeeplX veya Google Translate'i seçebilirsiniz.
o	DeeplX : Çeviri için DeeplX hizmetini kullanırken,
	DeeplX projesini dağıtmayı ve eklenti yapılandırmasında DeeplX API adresini sağlamayı seçebilirsiniz . Varsayılan adres http://localhost:1188/translate.
	Veya başkaları tarafından dağıtılan bir DeeplX hizmetinin API adresini kullanabilirsiniz https://api.deeplx.fun/translate.

## Google Çeviri : Google Çeviri hizmetini seçmek için ek yapılandırmaya gerek yoktur.

•	Her yayın için çeviriyi ayrı ayrı etkinleştirin veya devre dışı bırakın : Hangi yayınların başlıklarının çevrilmesi gerektiğini kontrol edebilirsiniz.
Dikkat edilmesi gerekenler
•	DeeplX hizmetini kullanırken lütfen DeeplX projesinin doğru şekilde dağıtıldığından ve API adresinin doğru ayarlandığından emin olun.
•	DeeplX'e sık sık yapılan istekler nedeniyle IP'nin yasaklanmasını önlemek için lütfen dikkatli kullanın.
•	Bu eklenti yalnızca FreshRSS ile çalışır; FreshRSS sürümünüzün eklentiyle uyumlu olduğundan emin olun.



## lisans
Proje, GNU Genel Kamu Lisansı v3.0 kapsamında açık kaynaktır .


