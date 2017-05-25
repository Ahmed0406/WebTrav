<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CandidatController extends Controller
{
    public function showCVAction(){
        $user = $this->getUser();
        return $this->render(':profile/candidat_Fn/cv:cv.html.twig', array(
            'user' => $user,
        ));
    }
    public function showCVExperienceAction()
    {
        $user = $this->getUser();
        $experience = array();
        foreach ($user->getCV()->getExperience() as $ex){
            array_push($experience, $ex);
        }
        return $this->render(':profile/candidat_Fn/cv/experiences:show.html.twig', array(
            'user' => $user,
            'experience' =>$experience,
        ));
    }

    public function showCVFormationAction()
    {
        $user = $this->getUser();
        $formation = array();
        foreach ($user->getCV()->getFormation() as $ex){
            array_push($formation, $ex);
        }
        return $this->render(':profile/candidat_Fn/cv/formations:show.html.twig', array(
            'user' => $user,
            'formation' =>$formation,
        ));
    }

    public function showCVProjetAction()
    {
        $user = $this->getUser();
        $projet = array();
        foreach ($user->getCV()->getProjet() as $ex){
            array_push($projet, $ex);
        }
        return $this->render(':profile/candidat_Fn/cv/projets:show.html.twig', array(
            'user' => $user,
            'projet' =>$projet,
        ));
    }
}
