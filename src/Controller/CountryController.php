<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Country;
use App\Form\CityType;
use App\Form\CountryType;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CountryController extends AbstractController
{
    #[Route('/countries', name: 'countries')]
    public function cities(CountryRepository $countryRepository): Response
    {
        $countries = $countryRepository->findAll();

        return $this->render('country/index.html.twig', [
            'countries' => $countries,
        ]);
    }

    #[Route('/country/new', name: 'new_country')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $country = new Country();
        $form = $this->createForm(CountryType::class, $country);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($country);
            $entityManager->flush();

            return $this->redirectToRoute('countries');
        }

        return $this->render('country/new_country.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/country/update/{id}', name: 'update_country')]
    public function update(Country $country, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CountryType::class, $country);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($country);
            $entityManager->flush();

            return $this->redirectToRoute('country', array('countryName' => $country->getName()));
        }

        return $this->render('country/new_country.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/country/delete/{id}', name: 'delete_country')]
    public function delete(Country $country, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($country);
        $entityManager->flush();

        return $this->redirectToRoute('countries');
    }

    #[Route('/country/{countryName}', name: 'country')]
    public function one(CountryRepository $countryRepository, string $countryName): Response
    {
        $country = $countryRepository->findOneBy(array('name' => $countryName));

        if (!$country) {
            throw $this->createNotFoundException();
        }

        return $this->render('country/detail.html.twig', [
            'country' => $country,
        ]);
    }
}
