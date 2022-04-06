<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $country = new Country();
        $country->setName("France");
        $country->setDescription("La France a gagné la pixelwar.");
        $country->setFlag('https://upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Flag_of_France_%281794%E2%80%931815%2C_1830%E2%80%931974%2C_2020%E2%80%93present%29.svg/800px-Flag_of_France_%281794%E2%80%931815%2C_1830%E2%80%931974%2C_2020%E2%80%93present%29.svg.png');
        $manager->persist($country);

        $city = new City();
        $city->setName("Lyon");
        $city->setDescription("Lyon, ville française de la région historique Rhône-Alpes, se trouve à la jonction du Rhône et de la Saône. Son centre témoigne de 2 000 ans d'histoire, avec son amphithéâtre romain des Trois Gaules, l'architecture médiévale et Renaissance du Vieux Lyon et la modernité du quartier de la Confluence sur la Presqu'île. Les Traboules, passages couverts entre les immeubles, relient le Vieux Lyon à la colline de La Croix-Rousse.");
        $city->setLink('https://www.grandlyon.com/');
        $city->setCountry($country);
        $manager->persist($city);

        $city = new City();
        $city->setName("Grenoble");
        $city->setDescription("Grenoble, ville de la région Rhône-Alpes du sud-est de la France, se trouve au pied des montagnes entre le Drac et l'Isère. Entourée de montagnes, elle est le lieu idéal pour les sports d'hiver. Elle compte aussi des musées, des universités et des centres de recherche. Les téléphériques sphériques appelés \"les bulles\" relient la ville au sommet de la colline de La Bastille, qui doit son nom à la forteresse du XVIIIe siècle érigée sur ses versants. ");
        $city->setLink('https://www.grenoblealpesmetropole.fr/');
        $city->setCountry($country);
        $manager->persist($city);

        $city = new City();
        $city->setName("Paris");
        $city->setDescription("Paris, capitale de la France, est une grande ville européenne et un centre mondial de l'art, de la mode, de la gastronomie et de la culture. Son paysage urbain du XIXe siècle est traversé par de larges boulevards et la Seine. Outre les monuments comme la tour Eiffel et la cathédrale gothique Notre-Dame du XIIe siècle, la ville est réputée pour ses cafés et ses boutiques de luxe bordant la rue du Faubourg-Saint-Honoré. ");
        $city->setLink('https://www.paris.fr/');
        $city->setCountry($country);
        $manager->persist($city);

        $manager->flush();

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
