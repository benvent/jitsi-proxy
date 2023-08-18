<?php

namespace App\Controller;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/events/{type}/{action}', name: 'app_event', methods: [Request::METHOD_POST])]
    public function save(string $type, string $action, Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $event->setType($type);
        $event->setAction($action);
        $event->setData(json_decode($request->getContent(), true));

        $entityManager->persist($event);
        $entityManager->flush();

        return new Response('Event created.', Response::HTTP_CREATED);
    }
}
