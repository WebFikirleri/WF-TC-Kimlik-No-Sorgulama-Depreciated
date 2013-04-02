WF-TC-Kimlik-No-Sorgulama
=========================

WF TC Kimlik No Sorgulama

tckimlik.php
------------

Girilen TC kimlik numarasının geçerli olup olmadığını kontrol eder. Sunuculara bağlanmaz ve ad soyad ile karşılaştırma yapmaz.
Sadece girilen TC Kimlik Numarasının aşağıdaki koşullara uygun olup olmadığını kontrol eder:

* TC Kimlik numaraları 11 hanelidir ve tamamı rakamsal değerlerden oluşur.
* TC Kimlik numarasının ilk hanesi 0 (sıfır) dan farklıdır.
* TC Kimlik numarasının 1. 3. 5. 7. ve 9. hanelerinin toplamının 7 ile çarpımından 2. 4. 6. ve 8. haneler çıkarıldığında kalan sayının 10 tabanından modu bize 10. haneyi verir.
* 1. 2. 3. 4. 5. 6. 7. 8 .9 ve 10. hanelerinin toplamının 10 tabanından modu bize 11. haneyi verir.

Kullanımı:

```php
require_once('tckimlik.php');

$tc = tckimlik('12345678901');
$tcd = $tc->dogrula();

if ($tcd)
  echo 'Geçerli';
else
  echo 'Geçersiz';
```

tckimlik_soap.php
-----------------

TC Kimlik numarasını http://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx soap/xml sunucusuna bağlanarak kontrol eder.

Kullanımı:

```php
require_once('tckimlik_soap.php');

$tc = tckimlik_soap('12345678901','Ad','Soyad','1982');
$tcd = $tc->dogrula();

if ($tcd == 1)
  echo 'Geçerli';
elseif ($tcd == 0)
  echo 'Geçersiz';
elseif ($tcd == -1)
  echo 'Kimlik No Geçersiz';
elseif ($tcd == -2)
  echo 'Sunucu ile bağlantı kurulamadı';
```

Ya da:

```php
require_once('tckimlik_soap.php');

$tc = tckimlik_soap('12345678901','Ad','Soyad','1982');
$tcd = $tc->dogrula();

if ($tcd == 1)
  echo 'Geçerli';
else
  echo 'TC Kimlik Geçersiz ya da Sorgulanırken bir sorun oluştu.';
```
