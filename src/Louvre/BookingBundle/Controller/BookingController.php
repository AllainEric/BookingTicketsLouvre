<?php
// src/Louvre/BookingBundle/Controller/BookingController.php

namespace Louvre\BookingBundle\Controller;

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\HttpKernel\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BookingController extends Controller
{
    public function indexAction($page)
    {
        if ($page < 1) {
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        return $this->render('LouvreBookingBundle:Booking:index.html.twig');
    }

    public function bookingAction(Request $request)
    {
            // pas  encore codé !
        if ($request->isMethod('POST')) {

            $request->getSession();
            // Ici, on s'occupera de la création  du formulaire
            return $this->redirectToRoute('louvre_booking_checkout');
        }
            // Envoie vers la page de formulaire si non soumis
        return $this->render('LouvreBookingBundle:Booking:booking.html.twig');
    }

    public function checkoutAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            // Ici, on s'occupera de la gestion du formulaire

            $request->getSession()->getFlashBag()->checkout('notice', "ticket bien enregistré.");

            // on redirige vers la vue du ticket et la confirmation d'achat
            return $this->redirectToRoute('louvre_booking_confirmation');
        }
        else{
            return $this->render('louvre_booking_booking'); 
        }  
    }

    public function confirmationAction()
    {
        return $this->render('LouvreBookingBundle:Booking:confirmation.html.twig');
    }

    public function modifyAction($id, Request $request)
    {
        // on recupere ici le  ticket correspondant à $id
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'ticket bien modifié.');

            // on redirige vers la vue du ticket dont id est 5 !!!!
            return $this->redirectToRoute('louvre_booking_view', array('id' => 5));
        }

        return $this->render('LouvreBookingBundle:Booking:modify.html.twig');
    }

    public function deleteAction($id)
    {
        return $this->render('LouvreBookingBundle:Booking:delete.html.twig');
    }

    public function informationsAction()
    {
        return $this->render('LouvreBookingBundle:Booking:informations.html.twig');
    }

    public function contactAction()
    {
        return $this->render('LouvreBookingBundle:Booking:contact.html.twig');
    }
}