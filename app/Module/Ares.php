<?php

namespace App\Module;

class ARES 
{
   /** @var string */
   private $ares_url = 'https://wwwinfo.mfcr.cz/cgi-bin/ares/darv_bas.cgi?ico=';
   
   /** @var int */
   private $ic;

   
   /**
    *  @param int $ic IČ of subject 
    */
   public function __construct ($ic)
   {
       $this->ic = (int) $ic;
   }
   
   /**
    *  @return array Data
    */
   public function getData () {
       $url = $this->ares_url . $this->ic;
       $xml = $this->getXML($url);
       if ($this->ic == $this->getIcFromXML($xml)) {
           return array (
               'ic' => $this->ic,
               'dic' => $this->getDicFromXML($xml),
               'nazev' => $this->getAddressFromXML(str_replace($this->arrayy(), '', $xml)),
               'ulice' => $this->getStreetFromXML(str_replace('<D:UC>', '', $xml)),
               'mesto' => $this->getCityFromXML(str_replace('<D:N>', '', $xml)),
               'zeme' => $this->getStateFromXML(str_replace('<D:NS>', '', $xml)),
               'psc' => $this->getPSCFromXML($xml),
           );
       }
       return false;
   }

   private function arrayy()
   {
      $replace = array('<D:OF zdroj="OR">', '<D:OF zdroj="RZP">', '<D:OF zdroj="RES">');
      return $replace;
   }
   
   /** 
    * @param string $xml
    * @return string 
    */
   private function getDicFromXML ($xml)
   {
       $pattern = '/([0-9]*)<\/D:DIC>/';
       preg_match($pattern, $xml, $matches);
       return isset($matches[1])?'CZ'.$matches[1]:false;
   }
   
   /** 
    * @param string $xml
    * @return string 
    */
   
   /** 
    * @param string $xml
    * @return string 
    */
   private function getIcFromXML ($xml)
   {
       $pattern = '/([0-9]*)<\/D:ICO>/';
       preg_match($pattern, $xml, $matches);
       return isset($matches[1])?$matches[1]:false;
       
   }
   
   
   /** 
    * @param string $xml
    * @return string 
    */
   private function getAddressFromXML ($xml)
   {
       $pattern = '/(.*)<\/D:OF>/';
       preg_match($pattern, $xml, $matches);
       return isset($matches[1])?$matches[1]:false;
   }
   private function getStreetFromXML ($xml)
   {
       $pattern = '/(.*)<\/D:UC>/';
       preg_match($pattern, $xml, $matches);
       return isset($matches[1])?$matches[1]:false;
   }
   
   private function getCityFromXML ($xml)
   {
       $pattern = '/(.*)<\/D:N>/';
       preg_match($pattern, $xml, $matches);
       return isset($matches[1])?$matches[1]:false;
   }

   private function getPSCFromXML ($xml)
   {
       $pattern ='/([0-9]*)<\/D:PSC>/';
       preg_match($pattern, $xml, $matches);
       return isset($matches[1])?$matches[1]:false;
   }

   private function getStateFromXML ($xml)
   {
       $pattern = '/(.*)<\/D:NS>/';
       preg_match($pattern, $xml, $matches);
       return isset($matches[1])?$matches[1]:false;
   }
  
   
   /** 
    * @param string $url 
    * @return string 
    */
   private function getXML ($url) {
       return file_get_contents($url);
   }
}