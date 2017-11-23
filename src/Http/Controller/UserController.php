<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 20/11/17
 * Time: 18:02
 */

namespace Silex\Api\Http\Controller;


use Cocur\Slugify\Slugify;
use Silex\Api\Domain\Entity\Article;
use Silex\Api\Domain\Entity\Category;
use Silex\Api\Domain\Entity\User;
use Silex\Api\Domain\Form\LoginForm;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController implements ControllerProviderInterface
{

    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->match('/login',[$this, 'loginAction'])
        ->before([$this, 'checkUserRole'])
        ->bind('api_login')
        ->method('GET|POST');

        $controllers->get('/logout',[$this,'logoutAction'])
        ->bind('api_logout');

        $controllers->get('/home',[$this, 'homeAction'])
        ->before([$this, 'checkUserRole'])
        ->bind('api_home');

        $controllers->match('/register',[$this, 'registerAction'])
        ->bind('api_register')
        ->method('GET|POST');

        $controllers->match('/article', [$this, 'articleAction'])
        ->bind('api_article')
        ->method('GET|POST');

        $controllers->get('/list-article',[$this, 'listPostAction'])
        ->bind('api_list_article');

        $controllers->match('/tag',[$this, 'tagAction'])
        ->bind('api_tag')
        ->method('GET|POST');

        $controllers->get('/list-tag',[$this, 'listTagAction'])
        ->bind('api_list_tag');

        return $controllers;
    }
    
    public function loginAction(Request $request)
    {
       $loginForm = new LoginForm();

       $formBuilder = $this->app['form.factory']->create($loginForm,$loginForm);

        if($request->getMethod() === 'GET') {
            return $this->app['twig']->render('login/login.html.twig',['form'=>$formBuilder->createView()]);
        }

        $formBuilder->handleRequest($request);

        if(!$formBuilder->isValid()) {
            return $this->app['twig']->render('login/login.html.twig',['form'=> $formBuilder->createView()]);
        }

        $user = $this->app['user.repository']->findByUsername($loginForm->getUsername());

        if($user == null) {
            $this->app['session']->getFlashBag()->add(
                'message_error',
                'data tidak ditemukan'
            );

            return $this->app['twig']->render('login/login.html.twig',['form'=>$formBuilder->createView()]);
        }

//        if($user->getPassword() !== md5($request->get('password')) ) {
//            $this->app['session']->getFlashBag()->add(
//                'message_error',
//                'username/password salah'
//            );
//
//            return $this->app['twig']->render('login/login.html.twig',['form'=>$formBuilder->createView()]);
//        }

        $this->app['session']->set('uname',['value'=>$user->getUsername()]);

        return $this->app->redirect($this->app['url_generator']->generate('api_home'));
    }

    public function logoutAction()
    {
        $this->app['session']->clear();

        return $this->app->redirect($this->app['url_generator']->generate('api_login'));
    }

    public function checkUserRole(Request $request)
    {
        if($request->getPathInfo() === '/login' && $this->app['session']->has('uname')) {
            return $this->app->redirect($this->app['url_generator']->generate('api_home'));
        }

        if(!$request->getPathInfo() === '/login' && !$this->app['session']->has('uname')) {
            $this->app['session']->getFlashBag()->add(
                'message_error',
                'tolong login terlebih dahulu'
            );

            return $this->app->redirect($this->app['url_generator']->generate('api_login'));
        }
    }

    public function registerAction(Request $request)
    {
        if($request->getMethod() == 'POST')
        {
            $data = new User();
            $data->setUsername($request->get('username'));
            $data->setPassword($request->get('password'));

            $this->app['orm.em']->persist($data);
            $this->app['orm.em']->flush();

            return new JsonResponse([
               'response' => [
                   'error' => 0,
                   'message' => 'berhasil mendaftar'
               ]
            ]);
        }
    }

    public function articleAction(Request $request)
    {
        $tag = $this->app['category.repository']->findAll();

        if($request->getMethod() == 'POST')
        {
            $slugify = new Slugify();
            $data = new Article();
            $data->setTitle($request->get('title'));
            $data->setSlug($slugify->slugify('Bang Yos mencontohkan Anies-Sandi cara tutup lokalisasi Kramat Tunggak'));
            $data->setBody($request->get('body'));
            $data->setStatus(0);

            $name1 = md5(uniqid()). '.' . $request->files->get('gambar')->guessExtension();
            $allowed = array('jpg','png','jpeg');
            $image = $request->files->get('gambar');
            $ext = pathinfo($name1, PATHINFO_EXTENSION);
            if(in_array($ext,$allowed)) {
                if($image instanceof UploadedFile) {
                    if(!($image->getClientSize() > (1024 * 1024 * 1))) {
                        $data->setImage($name1);
                    }else {
                        $this->app['session']->getFlashBag()->add(
                            'message_error',
                            'ukuran gambar tidak boleh lebih dari 1 mb'
                        );

                        return 'data tidak boleh lebih dari 1 mb';
//                        return $this->app->redirect($this->app['url_generator']->generate('api_list_article'));
                    }
                }
            }else {
                $this->app['session']->getFlashBag()->add(
                    'messsage_error',
                    'extension gambar harus .jpg, .png, .jpeg'
                );

                return 'extension gambar harus .jpg, .png, .jpeg';
//                return $this->app->redirect($this->app['url_generator']->generate('api_list_article'));
            }


            $arrNewTag = [];
            foreach ($request->get('tag') as $item) {
                array_push($arrNewTag,$item);
            }

            $data->setTag(serialize($arrNewTag));
            $data->setMetaKeyword($request->get('meta-keyword'));
            $data->setMetaDescription($request->get('meta-description'));

            $this->app['orm.em']->persist($data);
            $this->app['orm.em']->flush();

            $this->app['session']->getFlashBag()->add(
                'message_success',
                'data berhasil disimpan'
            );

            return $this->app->redirect($this->app['url_generator']->generate('api_list_article'));
        }

        return $this->app['twig']->render('post/post.html.twig',[
            'tag' => $tag
        ]);
    }

    public function homeAction()
    {
        return $this->app['twig']->render('home/home.html.twig');
    }

    public function tagAction(Request $request)
    {
        if($request->getMethod() == 'POST') {
            $data = new Category();
            $data->setNameCategory($request->get('category'));

            $this->app['orm.em']->persist($data);
            $this->app['orm.em']->flush();

            $this->app['session']->getFlashBag(
                'message_success',
                'data telah berhasil disimpan'
            );

            return $this->app->redirect($this->app['url_generator']->generate('api_list_tag'));
        }

        return $this->app['twig']->render('tag/tag.html.twig');
    }
    
    public function listTagAction()
    {
        $data = $this->app['category.repository']->findAll();

        return $this->app['twig']->render('tag/list-tag.html.twig',[
            'data' => $data
        ]);
    }
    
    public function listPostAction()
    {
        $data = $this->app['article.repository']->findAll();

        return $this->app['twig']->render('post/list-post.html.twig',['data' => $data]);
    }


}