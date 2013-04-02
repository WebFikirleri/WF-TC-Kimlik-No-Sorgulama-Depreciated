<?php

class tckimlik_soap {

  private $tc, $ad, $soyad, $dyili;

	public function __construct($tc,$ad,$soyad,$dyili)
	{
		$this->tc = $tc;
		$this->ad = $ad;
		$this->soyad = $soyad;
		$this->dyili = $dyili;
	}

	public function dogrula()
	{
		return $this->sorgula();
	}

	private function sorgula()
	{
		$curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,'http://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx');
        curl_setopt($curl,CURLOPT_POST,TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/soap+xml'));
        curl_setopt($curl,CURLOPT_POSTFIELDS,'<?xml version="1.0" encoding="latin5"?>
        <soap12:Envelope  xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"  xmlns:xsd="http://www.w3.org/2001/XMLSchema"  xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
          <soap12:Body>
            <TCKimlikNoDogrula xmlns="http://tckimlik.nvi.gov.tr/WS">
              <TCKimlikNo>'.$this->tc_no.'</TCKimlikNo>
              <Ad>'.$this->ad.'</Ad>
              <Soyad>'.$this->soy_ad.'</Soyad>
              <DogumYili>'.$this->dogum_yili.'</DogumYili>
            </TCKimlikNoDogrula>
          </soap12:Body>
        </soap12:Envelope>');
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);
        $out = curl_exec($curl);
        curl_close($curl);
        
        return $this->render($out);
	}

	private function render($out)
	{
		if ($out) {

			preg_match('#<TCKimlikNoDogrulaResult>(.*?)</TCKimlikNoDogrulaResult>#',$out,$result);

			if ($result == 'true') {
				return 1;
			} elsif ($result == 'false') {
				return 0;
			} else {
				return -1;
			}

		} else {
			return -2;
		}
	}

}
