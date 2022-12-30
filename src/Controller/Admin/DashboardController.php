<?php

namespace App\Controller\Admin;
use App\Entity\Formateur;
use App\Entity\Formation;
use App\Entity\User1;
use App\Repository\CondidatRepository;
use App\Repository\FormateurRepository;
use App\Repository\FormationRepository;
use App\Repository\User1Repository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use phpDocumentor\Reflection\Types\Parent_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    private $User1Repository;

    public function __construct(User1Repository $User1Repository,
                                FormationRepository $FormationRepository,
                                FormateurRepository $FormateurRepository)
    {

        $this->User1Repository = $User1Repository;
        $this->FormationRepository = $FormationRepository;
        $this->FormateurRepository = $FormateurRepository;
    }
    /**
     * @Route("/admin", name="admin")
     * @Security ("is_granted('ROLE_ADMIN')")
     */
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig',[
            'countuser' => $this->User1Repository->countAllUser(),
            'countformation' => $this->FormationRepository->countAllFormation(),
            'countformateur' => $this->FormateurRepository->countAllFormateur(),
            'User' => $this ->User1Repository->findAll()
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Leaders');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('User', 'fas fa-users', User1::class);
        yield MenuItem::linkToCrud('Formation', 'fas fa-map', Formation::class);
        yield MenuItem::linkToCrud('Formateur', 'fas fa-users', Formateur::class);

    }
    public function configureUserMenu(UserInterface $user): UserMenu {
        return parent::configureUserMenu($user)
            ->setName($user->getUsername())
            ->setAvatarUrl('https://th.bing.com/th/id/R.b865975b8c914dc73862c58c610bd1ea?rik=VzmIYwgyULDE9A&pid=ImgRaw&r=0')
            //->setGravatarEmail($user->getUsername())
            ->displayUserAvatar(true)
            ;
    }
}
