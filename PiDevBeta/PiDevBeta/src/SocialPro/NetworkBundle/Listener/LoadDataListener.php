<?php
namespace SocialPro\NetworkBundle\Listener;
/**
 * Created by PhpStorm.
 * User: Amal
 * Date: 02/04/2017
 * Time: 08:57
 */
use AncaRebeca\FullCalendarBundle\Event\CalendarEvent;
use AncaRebeca\FullCalendarBundle\Model\Event;
use AncaRebeca\FullCalendarBundle\event\CalendarEvent as MyCustomEvent;
use SocialPro\NetworkBundle\Entity\Events;


class LoadDataListener
{
    /**
     * @param CalendarEvent $calendarEvent
     *
     * @return Event[]
     */

 public function LoadeventsAction() {



     $rows = array();

     $rows[] = array(
         'id' => 11,
         'title' => "yey",
         'start' => '2017-04-04',

         'end' => '2017-04-05',

         'location' => 'no',
         'description' => 'daah',
         //ajoute dees informations concernant levenement

     );

     $response = new Response(json_encode($rows));
     $response->headers->set('Content-Type', 'application/json');
     return $response;
 }
}