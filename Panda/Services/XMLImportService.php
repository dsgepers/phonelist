<?php


namespace Panda\Services;


use Panda\Model\Feature;
use Panda\Model\Phone;
use XmlIterator\XmlIterator;

class XMLImportService {
    use ServiceTrait;

    public function import($url)
    {
        echo '<pre>';

        $phones = [];

        $iterator = new XmlIterator($url, 'toestel');
        foreach ($iterator as $key => $value) {
            $phone = $this->makePhone($value);

            $features = [];
            foreach($value['specs'] as $category => $s) {
                foreach($s['kenmerk'] as $f) {
                    if($f && is_array($f)) {
                        $name = $f['naam'];
                        $feature = Feature::findByCategoryAndName($category,$name);
                        if(!$feature) {
                            $feature = new Feature();
                            $feature->setCategoryName($category);
                            $feature->setName($name);
                            $feature->save();
                        }
                        $features[] = $feature;
                    }
                }
            }
            $phone->setFeatures($features);
            $phones[] = $phone;
        }

        var_dump($phones);
    }

    private function makePhone(array $value)
    {
        $phone = new Phone();
        $phone->setId($value['uniqid']);
        $phone->setInternalId($value['internalid']);
        $phone->setPrice($value['prijs']);
        $phone->setBrand($value['product_merk']);
        $phone->setTitle($value['product_naam']);
        $phone->setColor($value['product_kleur']);
        $phone->setEan($value['ean']);

        return $phone;
    }
} 