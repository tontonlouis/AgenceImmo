<?php 

namespace App\Controller\Admin;

use App\Entity\Picture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/picture")
 */
class AdminPictureController extends AbstractController
{
        /**
        * @Route("/{id}", name="admin.picture.delete", methods="DELETE")
        */
        public function delete(Request $request, Picture $picture)
        {
            $data = json_decode($request->getContent(), true);

        
            if ($this->isCsrfTokenValid('delete' . $picture->getId(), $data['_token'])) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($picture);
                $em->flush();

                return new JsonResponse(['success' => 1]);
            }
            else
            {
                return new JsonResponse(['success' => 'Token invalid'], 400);
            }

            //return $this->redirectToRoute('admin.property.edit', ['id' => $propertyId]);
            
        }
}
