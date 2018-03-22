<?php
namespace SocialPro\NetworkBundle\Services;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GetAcce
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function acces($acces)
    {
        $html = $this->container->get('templating')->render('projets/frontOffice/acce.html.twig', array('acce' => $acces));

        $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
        $html2pdf->pdf->SetAuthor('SocialPro');
        $html2pdf->pdf->SetTitle('Aide '.'EBoutique');
        $html2pdf->pdf->SetSubject('Acces SocialPro');
        $html2pdf->pdf->SetKeywords('acces,socialPro');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);

        return $html2pdf;
    }
}