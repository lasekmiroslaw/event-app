<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Form\EventType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    /**
     * @Route("/", name="event")
     */
    public function index(Request $request, SessionInterface $session)
    {
        $event = new Event();

        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $event->setStart(new \DateTime($event->getStart(), new \DateTimezone($event->getTimezone())));
            $event->setEnd(new \DateTime($event->getEnd(), new \DateTimezone($event->getTimezone())));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
            $session->getFlashBag()->add('notice', 'Event saved');
        }

        return $this->render('event/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
