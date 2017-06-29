<?php

namespace NasaApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NeoController extends Controller
{
    /**
     * @Route("/hazardous")
     */
    public function getHazardousAction()
    {
        $neoRepo = $this->getDoctrine()->getRepository('NasaApiBundle:Neo');

        $neoCollection = $neoRepo->findBy(['isHazardous' => true]);

        return $this->json($neoCollection);
    }

    /**
     * @Route("/fastest")
     */
    public function getFastestAction(Request $request)
    {
        $isHazardous = $request->get('hazardous') === 'true' ? true : false;

        $neoRepo = $this->getDoctrine()->getRepository('NasaApiBundle:Neo');

        $neoEntity = $neoRepo->findFastest($isHazardous);

        return $this->json($neoEntity);
    }

    /**
     * @Route("/best-year")
     */
    public function getBestYearAction(Request $request)
    {
        $isHazardous = $request->get('hazardous') === 'true' ? true : false;

        $neoRepo = $this->getDoctrine()->getRepository('NasaApiBundle:Neo');

        $neoEntity = $neoRepo->findBestYear($isHazardous);

        return $this->json($neoEntity);
    }

    /**
     * @Route("/best-month")
     */
    public function getBestMonthAction(Request $request)
    {
        $isHazardous = $request->get('hazardous') === 'true' ? true : false;

        $neoRepo = $this->getDoctrine()->getRepository('NasaApiBundle:Neo');

        $neoEntity = $neoRepo->findBestMonth($isHazardous);

        return $this->json($neoEntity);
    }
}
