<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Directory\Setup\Data;

use Doctrine\Common\Persistence\ObjectManager;
use WellCart\Directory\Entity\Country;
use WellCart\Directory\Entity\Currency;
use WellCart\Directory\Entity\Zone;
use WellCart\Setup\DataFixture\AbstractFixture;
use WellCart\Setup\DataFixture\PermissionsProviderInterface;

/**
 * @codeCoverageIgnore
 */
class Install
    extends AbstractFixture
    implements PermissionsProviderInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadCurrencies($manager);
        $this->loadCountries($manager);
    }

    public function getPermissionsDefinition(): array
    {
        return [
            ['name' => 'directory/currencies/group-action-handler',],
            ['name' => 'directory/currencies/list',],
            ['name' => 'directory/currencies/view',],
            ['name' => 'directory/currencies/create',],
            ['name' => 'directory/currencies/update',],
            ['name' => 'directory/currencies/delete',],

            ['name' => 'directory/countries/group-action-handler',],
            ['name' => 'directory/countries/list',],
            ['name' => 'directory/countries/view',],
            ['name' => 'directory/countries/create',],
            ['name' => 'directory/countries/update',],
            ['name' => 'directory/countries/delete',],

            ['name' => 'directory/zones/group-action-handler',],
            ['name' => 'directory/zones/list',],
            ['name' => 'directory/zones/view',],
            ['name' => 'directory/zones/create',],
            ['name' => 'directory/zones/update',],
            ['name' => 'directory/zones/delete',],
            ['name' => 'directory/zones/get-zone-options',],

            ['name' => 'directory/geo-zones/group-action-handler',],
            ['name' => 'directory/geo-zones/list',],
            ['name' => 'directory/geo-zones/view',],
            ['name' => 'directory/geo-zones/create',],
            ['name' => 'directory/geo-zones/update',],
            ['name' => 'directory/geo-zones/delete',],

        ];
    }

    private function loadCurrencies(ObjectManager $manager)
    {
        $currency = new Currency();
        $currency
            ->setTitle('US Dollars')
            ->setCode('USD')
            ->setSymbol('$')
            ->setSymbolPosition(Currency::POSITION_LEFT)
            ->setExchangeRate(1.00)
            ->setDecimals(2)
            ->setDecimalsSeparator('.')
            ->setThousandsSeparator(',')
            ->setStatus(Currency::STATUS_ENABLED)
            ->setIsPrimary(true);

        $manager->persist($currency);
        $manager->flush();
        $manager->clear();
    }

    private function loadCountries(ObjectManager $manager)
    {
        $rows = include __DIR__ . '/../../../config/resources/countries.php';
        $date = new \DateTime();
        foreach ($rows as $row) {
            $country = new Country();
            $country
                ->setName($row['name'])
                ->setIsoCode2($row['iso_code_2'])
                ->setIsoCode3($row['iso_code_3'])
                ->setAddressFormat($row['address_format'])
                ->setPostcodeRequired($row['postcode_required'])
                ->setStatus($row['status'])
                ->setCreatedAt($date);

            if (!empty($row['zones'])) {
                $zones = $row['zones'];
                foreach ($zones as $zone) {
                    $object = new Zone();
                    $object->setCountry($country)
                        ->setName($zone['name'])
                        ->setCode($zone['code'])
                        ->setStatus((int)$zone['status'])
                        ->setCreatedAt($date);
                    $manager->persist($object);
                }
            }

            $manager->persist($country);
            $manager->flush();
            $manager->clear();
        }
    }
}
